<?php


namespace Modules\OpenAI\Libraries;

 class Stablediffusion
 {
    protected $url;
    protected $Imageurl;
    protected $promtText;

    protected $imageToImagePromt;

    protected $imageService;

    public function __construct($imageService)
    {
        $this->imageService = $imageService;
        $this->url = "https:
        $this->Imageurl = "https:
    }

    public function imageToImage($data)
    {
        $this->imageToImagePromt = ([
            "text_prompts[0][text]" => 'Please generate image of ' . $data['promt'] . ' in a ' . $data['lightingStyle'] . ' mode and the art style is ' . $data['artStyle'],
            "text_prompts[0][weight]" => 0.7,
            "init_image_mode" => "IMAGE_STRENGTH",
            "image_strength" => 0.8,
            "cfg_scale" => 7,
            "clip_guidance_preset" => 'FAST_BLUE',
            "samples" => (int) $data['variant'],
            "steps" => 30,
            "init_image" => file_get_contents(request('file')),
        ]);

        return $this->makeCurlRequest();
    }


    public function generalPromt($data)
    {
        $imgHeightWidth = $this->imageService->explodedData(request('resulation'));

        $this->promtText = [
            "text_prompts" => [
                    [
                        "text" => 'Please generate image of ' . $data['promt'] . ' in a ' . $data['lightingStyle'] . ' mode and the art style is ' . $data['artStyle']
                    ]
            ],
            "cfg_scale" => 7,
            "clip_guidance_preset" => 'FAST_BLUE',
            "height" => (int) $imgHeightWidth[1],
            "width" => (int) $imgHeightWidth[0],
            "samples" => (int) $data['variant'],
            "steps" => 30,
        ];

        return $this->makeCurlRequest();
    }

    public function promt($data)
    {
        return request('file') != 'undefined' ? $this->imageToImage($data) : $this->generalPromt($data);
    }

    public function response($response)
    {
        if (isset($response['artifacts'])) {
            return $this->save($response);
        } else {
            return [
                'response' => $response['message'],
                'status' => 'failed'
            ];
        }

    }

    public function makeCurlRequest()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->options()['url'],
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => config('openAI.ssl_verify_host'),
            CURLOPT_SSL_VERIFYPEER => config('openAI.ssl_verify_peer'),
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            
            CURLOPT_POSTFIELDS => $this->options()['data'],
            CURLOPT_HTTPHEADER => array(
                "Content-Type: " . $this->options()['type'],
                "Authorization: Bearer " . apiKey('stablediffusion')
            ),
        ));
        
        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        return $this->response($response);
    }

    public function options()
    {
        if (request('file') != 'undefined') {
            return [
                'url' => $this->Imageurl,
                'type' => 'multipart/form-data',
                'data' => $this->imageToImagePromt,
            ];
        } else {
            return [
                'url' => $this->url,
                'type' => 'application/json',
                'data' => json_encode($this->promtText)
            ];
        }
    }

    public function save($data)
    {
        $totalImages = count($data['artifacts'][0]);
        foreach ($data['artifacts'] as $key => $value) {
            $image = base64_decode($value['base64']);
            $this->upload($image);
            $slug = $totalImages > 0 ? $this->imageService->createSlug(request('promt') . $key) : $this->imageService->createSlug(request('promt'));
            $name = $this->imageService->createName(request('promt'));
            $images[] = [
                'user_id' => auth('api')->user()->id,
                'name' => $name,
                'original_name' => $this->imageService->imageName,
                'promt' => request('promt'),
                'slug' => $slug,
                'size' => request('resulation'),
                'art_style' => request('artStyle'),
                'lighting_style' => request('lightingStyle'),
                'libraries' => 'Stablediffusion',
            ];

            $urlWithParams = objectStorage()->url('user/image-gallery?slug=' . $slug);
            $imageNames[] = [
                'url' => $this->imageService->storagePath() . DIRECTORY_SEPARATOR . $this->imageService->imageName,
                'slug_url' => $urlWithParams,
                'name' => $name,
                'size' => request('resulation'),
                'art_style' => request('artStyle'),
                'lighting_style' => request('lightingStyle'),
                'created_at' => now()
            ];
        }
       return $this->imageService->storeData($images, $imageNames);
    }

    public function upload($url)
    {
        $filename = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(" ", "_",  $this->imageService->createName(request('promt'))));
        $filename = md5(uniqid()) . "." . "jpg";
        $this->imageService->imageName = $filename;
        $image = objectStorage()->put($this->imageService->uploadPath() . DIRECTORY_SEPARATOR . $filename, $url);
        $this->imageService->makeThumbnail($this->imageService->imageName);
        return $image;
    }

 }
