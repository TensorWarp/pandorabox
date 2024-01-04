<?php

namespace Modules\OpenAI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TextToSpeechResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => optional($this->user)->id,
            'prompt' => $this->prompt,
            'voice' => $this->voice,
            'characters' => $this->characters,
            'slug' => $this->slug,
            'language' => $this->language,
            'audio' => $this->googleAudioUrl(),
            'volume' => volume($this->volume, true),
            'gender' => $this->gender,
            'pitch' => pitch($this->pitch, true),
            'speed' => speed($this->speed, true),
            'pause' => $this->pause,
            'audio_effect' => audioEffect($this->audio_effect, true),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
