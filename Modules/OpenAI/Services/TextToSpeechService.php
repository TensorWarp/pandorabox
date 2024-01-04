<?php


 namespace Modules\OpenAI\Services;


use Illuminate\Support\Str;
use Modules\OpenAI\Entities\{
    Audio,
    Voice
};

use App\Models\{
    User,
    Language,
    Team,
    TeamMemberMeta
};

 class TextToSpeechService
 {
    protected $formData;

    protected $prompt;

    public function __construct($formData = null, $prompt = null)
    {
        $this->formData = $formData;
        $this->prompt = $prompt;
    }

    public function getUrl()
    {
        return config('openAI.textToSpeechUrl');
    }

    public function getToken()
    {
        return preference('max_token_length');
    }

    public function googleKey()
    {
        return preference('google_api');
    }

    public function createAudio($data)
    {
        $this->formData = $data;
        return $this->validate();
    }

    public function preparePrompt()
    {
        $this->prompt = ([
            'input' => [
                "ssml" => "<speak>" . $this->formData['prompt'] . "</speak>",
            ],
            'voice' => [
                "languageCode" => $this->formData['language'],
                "name" => $this->formData['voice_name'],
                "ssmlGender" => $this->formData['gender']
            ],
            'audioConfig' => [
                "audioEncoding" => "MP3",
                "speakingRate" => $this->formData['speed'],
                "pitch" => $this->formData['pitch'],
                "volumeGainDb" => $this->formData['volume'],
                "effectsProfileId" => $this->formData['audio_effect']
            ],
        ]);

        return $this->makeCurlRequest();
    }

    public function validate()
    {
        app('Modules\OpenAI\Http\Requests\TextStoreRequest')->safe();
        return $this->preparePrompt();
        
    }

    public function makeCurlRequest()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->getUrl() . "?key=" . $this->googleKey(),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host'),
        CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer'),
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($this->prompt),
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $response = !empty($response) ? $response : $err;
        return json_decode($response, true);
    }


    public function save($data, $text)
    {
        $audioPath = $this->prepareFile($data);
        preg_match_all("/./u", $text, $matches);
        $charactersCount = count($matches[0]);

        $text = [
            'user_id' => auth('api')->user()->id,
            'file_name' => $audioPath,
            'characters' => $charactersCount,
            'prompt' => $text,
            'slug' => $this->createSlug($text),
            'language' => $this->processLanguageData(request('language')),
            'volume' => request('volume'),
            'gender' => request('gender'),
            'pitch' => request('pitch'),
            'speed' => request('speed'),
            'pause' => request('pause'),
            'voice' => request('voice'),
            'audio_effect' => request('audio_effect'),
        ];

        return $this->storeData($text);
    }

    protected function storeData($text)
    {
        $id = Audio::insertGetId($text);

        if ( $audio = Audio::where('id', $id)->first()) {

            $currentValue = app()->make('all-image');

            $newValue = 'public/uploads/googleAudios/'. str_replace('\\', '/', $audio->file_name);

            if (is_array($currentValue)) {
                $currentValue[] = $newValue;
            } 

            app()->instance('all-image', $currentValue);

            $data = [
                'id' => $id,
                'view_route' => route('user.textToSpeechView', ['id' => $id]),
                'file_name' => $audio->file_name,
                'audio_url' => $audio->googleAudioUrl(),
                'characters' => $audio->characters,
                'prompt' => trimWords($audio->prompt, 80) ,
                'slug' => $audio->slug,
                'language' => $audio->language,
                'volume' => volume($audio->volume, true),
                'gender' => $audio->gender,
                'pitch' => pitch($audio->pitch, true),
                'speed' => speed($audio->speed, true),
                'audio_effect' => audioEffect($audio->audio_effect, true),
                'voice' => $audio->voice,
                'created_at' => timeToGo($audio->created_at, false, 'ago')
            ];
            return $data;
        }

        return false;
    }


     public function prepareFile($data)
     {  
        $this->uploadPath();

        $clientExtention = strtolower($this->formData['target_format']);
        $fileName = md5(uniqid()) . "." . $clientExtention;
        $destinationFolder = 'public' . DIRECTORY_SEPARATOR . 'uploads'. DIRECTORY_SEPARATOR . 'googleAudios'. DIRECTORY_SEPARATOR . date('Ymd') . DIRECTORY_SEPARATOR;
        
        if (!isExistFile($destinationFolder)) {
            createDirectory($destinationFolder);
        }

        $filePath = $destinationFolder . $fileName;
        $audioData = base64_decode($data);
        objectStorage()->put($filePath, $audioData);

        $path = date('Ymd') . DIRECTORY_SEPARATOR . $fileName;
        return $path;
     }

    protected function uploadPath()
	{
		return createDirectory(join(DIRECTORY_SEPARATOR, ['public', 'uploads','googleAudios']));
	}


    protected function createSlug($name)
    {
        if (!empty($name)) {

            if (strlen($name) > 120) {
                $name = substr($name, 0, 120);
            }

            $slug = cleanedUrl($name);

            if (Audio::whereSlug($slug)->exists()) {
                $slug = $slug . '-' . time();
            }

            return $slug;
        }
    }

    public static function model()
    {
        return Audio::with(['user:id,name', 'user.metas']);
    }

    public static function getAll()
    {
        $result = self::model();

        $userRole = auth()->user()->roles()->first();
        if ($userRole->type == 'user') {
            $result = $result->where('user_id', auth()->user()->id);
        }
        return $result->orderBy('id', 'DESC');
    }

    public function audioById($id)
    {
        return self::model()->whereId($id)->firstOrFail();
    }

    public function audioBySlug($slug)
    {
        return self::model()->whereSlug($slug)->firstOrFail();
    }


    public function delete($id)
    {
        $data = $this->audioById($id);

        if (!empty($data)) {
            $this->unlinkFile($data->file_name);
            return $data->delete();
           
        }

        return false;
    }

    protected function unlinkFile($name)
    {
        if (isExistFile($this->audioPath($name))) {
            objectStorage()->delete($this->audioPath($name));
        }
        return true;  
    }

    public static function audioPath($name)
    {
        return 'public' . DIRECTORY_SEPARATOR .'uploads' . DIRECTORY_SEPARATOR . 'googleAudios'. DIRECTORY_SEPARATOR . $name;
    }

    public static function users()
    {
        return User::get();
    }

    public static function languages($shortName = null)
    {
        if ($shortName) {
            return Language::where('short_name', $shortName)->value('name');
        }
        return Language::where(['status' => 'Active'])->get();
    }

    public function updateVoice($data = [], $id = null)
    {
        $result = Voice::where('id', $id);
        if ($result->exists()) {
            if ($result->update($data)) {
                if (request()->file_id) {
                    $result->first()->updateFiles(['isUploaded' => false, 'isOriginalNameRequired' => true, 'thumbnail' => true]);
                    return true;
                } else {
                    return $result->first()->deleteFromMediaManager();
                }
            }
        }

        return false;
    }


    public function processLanguage($languages = [])
    {
        $newLang = [];
        foreach ($languages as $language) {
            $shortName = Language::where('name', $language)->value('short_name');
            $newLang[$shortName] = $language;
        }
        
        return $newLang;
    }


    public function processLanguageData($language = [])
    {
        $lang = explode('-', $language);
        $shortName = ($language == 'yue-HK') ? $this->languages('zh') : ($lang ? $this->languages($lang[0]) : $language);
        return $shortName;
    }

    public function allVoice()
    {
        return Voice::where('status', 'Active')->get();
    }

    public function checkActiveActor($data)
    {

        if (Voice::where('voice_name', $data['voice_name'])->where('status', 'Active')->exists()) {
            return true;
        }

        return false;
    }

    public function storeTeamMeta($minutes)
    {
        $memberData = Team::getMember(auth()->user()->id);
        if (!empty($memberData)) {
            $usage = TeamMemberMeta::getMemberMeta($memberData->id, 'character_used');
            if (!empty($usage)) {
                return $usage && $usage->increment('value', $minutes); 
            }
        }
        return false;
    }

 }
