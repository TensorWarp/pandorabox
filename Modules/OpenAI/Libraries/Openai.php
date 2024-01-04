<?php


namespace Modules\OpenAI\Libraries;

 class Openai
 {
    protected $url = 'https://api.openai.com/v1/images/generations';
    protected $promt;
    protected $imageService;
    protected $model = 'dall-e-3';

    public function __construct($imageService)
    {
        $this->imageService = $imageService;
    }

    public function promt($data)
    {
        $this->promt = [
            "prompt" => 'Please generate images of' . $data['promt']. 'in a ' . $data['lightingStyle'] . 'with the art of ' . $data['artStyle'],
            "n" => (int) $data['variant'],
            "size" => $data['resulation'],
            "model" => $this->model
        ];

        return $this->response($this->getResponse());
    }

    public function getResponse() {
        $client = \OpenAI::client(apiKey('openai'));

        return $client->images()->create($this->promt);
    }

    public function response($response)
    {
        if (isset($response['created'])) {
            return $this->save($response);
        } else if(isset($response['error'])) {
            return [
                'response' => $response['error']['message'],
                'status' => 'error',
            ];
        }

    }

    public function save($data)
    {
        $totalImages = count($data['data']);

        for ($i = 0; $i < $totalImages; $i++) {
            $this->imageService->upload($data['data'][$i]['url']);
            $slug = $totalImages > 1 ? $this->imageService->createSlug(request('promt') . $i) : $this->imageService->createSlug(request('promt'));
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
                'libraries' => 'Openai',
                'meta' => json_encode($data),
            ];

            $urlWithParams = url('user/image-gallery?slug=' . $slug);
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

 }
