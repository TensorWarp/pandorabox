<?php


 namespace Modules\OpenAI\Services;


use Illuminate\Support\Str;
use Modules\OpenAI\Entities\{
    Code,
    ContentType,
};

use App\Models\{
    User,
    Team,
    TeamMemberMeta
};

 class CodeService
 {
    protected $formData;

    protected $promt;

    public function __construct($formData = null, $promt = null)
    {
        $this->formData = $formData;
        $this->promt = $promt;
    }

    public function getUrl()
    {
        return config('openAI.chatUrl');
    }

    public function getModel()
    {
        return config('openAI.chatModel');
    }

    public function getToken()
    {
        return preference('max_token_length');
    }

    public function aiKey()
    {
        return preference('openai');
    }

    public function client()
    {
        return \OpenAI::client($this->aiKey());
    }

    public function createCode($data)
    {
        $this->formData = $data;
        $this->formData['promt'] = filteringBadWords($this->formData['promt']);
        return $this->validate();
    }

    public function preparePromt()
    {
        $this->promt = ([
            'model' => $this->getModel(),
            'messages' => [
                [
                    "role" => "system",
                    "content" => "You are a great helpful assistant that writes code."
                ],
                [
                    "role" => "user",
                    "content" => "Generate code about". $this->formData['promt'] . "In" . $this->formData['language'] . "and the code level is" . $this->formData['codeLabel'],
                ],
            ],
            'temperature' => 1,
            'max_tokens' => (int) $this->getToken(),
        ]);

        return $this->getResponse();
    }

    private function getResponse()
    {
        return $this->client()->chat()->create($this->promt)->toArray();
    }

    public function validate()
    {
        app('Modules\OpenAI\Http\Requests\CodeStoreRequest')->safe();
        return $this->preparePromt();
    }

    public function makeCurlRequest()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->getUrl(),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host'),
        CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer'),
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($this->promt),
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->aiKey(),
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $response = !empty($response) ? $response : $err;
        return json_decode($response, true);
    }


    public function save($data)
    {
        $this->formData = $data;
            $code[] = [
                'user_id' => auth('api')->user()->id,
                'model' => $data['model'],
                'slug' => $this->createSlug(request('promt')),
                'promt' => request('promt'),
                'code' => $data['choices'][0]['message']['content'],
                'tokens' => $data['usage']['total_tokens'],
                'words' =>  preference('word_count_method') == 'token' ? subscription('tokenToWord', $data['usage']['total_tokens']) : countWords($data['choices'][0]['message']['content']),
                'characters' => strlen($data['choices'][0]['message']['content']),
                'language' => request('language'),
                'code_label' => request('codeLabel'),

            ];
            

       return $this->storeData($code);
    }

    protected function storeData($code)
    {
       return Code::insert($code) ? $this->formData : false;
    }

    public function storeTeamMeta($words)
    {
        $memberData = Team::getMember(auth()->user()->id);
        if (!empty($memberData)) {
            $usage = TeamMemberMeta::getMemberMeta($memberData->id, 'word_used');
            if (!empty($usage)) {
                return $usage && $usage->increment('value', $words); 
            }
        }
        return false;
    }

    public function createName($name = null)
    {
        return !empty($name) ? substr($name, 0, 100) : Str::random(100);
    }


    protected function createSlug($name)
    {
        if (!empty($name)) {

            $slug = cleanedUrl($name);

            if (Code::whereSlug($slug)->exists()) {
                $slug = $slug . '-' . time();
            }

            return $slug;
        }
    }

    public static function model()
    {
        return Code::with(['user:id,name']);
    }

    public static function getAll()
    {
        $result = self::model()->with(['user']);

        $userRole = auth()->user()->roles()->first();
        if ($userRole->type == 'user') {
            $result = $result->where('user_id', auth()->user()->id);
        }
        return $result->latest();
    }

    public function codeBySlug($slug)
    {
        return self::model()->whereSlug($slug)->firstOrFail();
    }

    public function codeById($slug)
    {
        return self::model()->whereId($slug)->firstOrFail();
    }

    public function delete($id)
    {
        $data = $this->codeById($id);
        return !empty($data) ? $this->codeById($id)->delete() : false;
    }

    public function getMeta($slug = null)
    {
        return ContentType::getData($slug);
    }

    public static function users()
    {
        return User::get();
    }

 }
