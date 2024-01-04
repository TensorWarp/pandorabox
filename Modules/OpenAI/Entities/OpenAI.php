<?php

namespace Modules\OpenAI\Entities;

class OpenAI
{
    /**
     * Get Client
     *
     * @return client
     */
    public static function getClient()
    {
        return \OpenAI::client(self::aiKey());
    }

    /**
     * Completions
     *
     * @var array $args
     * @return client
     */
    public static function completions(...$args)
    {
        $completionsArgs = array_merge([
            'model' => request('model') ? request('model') : self::aiModel(),
            'prompt' => null,
            "temperature" => null,
            "n" => null,
            "max_tokens" => request('max_tokens') ? (int) request('max_tokens') : (int) self::aiMaxToken(),
            "frequency_penalty" => 0.2,
            "presence_penalty" => 0
        ], func_get_args()[0]);
        return self::requiredStremedData() ? 
        self::getClient()->completions()->createStreamed($completionsArgs) :
        self::getClient()->completions()->create($completionsArgs);
    }

    /**
     * Completions
     *
     * @var array $args
     * @return client
     */
    public static function contentCreate(...$args)
    {
        $completionsArgs = array_merge([
            'model' => request('model') ? request('model') : self::aiModel(),
            "temperature" => null,
            "n" => null,
            "max_tokens" => request('max_tokens') ? (int) request('max_tokens') : (int) self::aiMaxToken(),
            "frequency_penalty" => 0.2,
            "presence_penalty" => 0
        ], func_get_args()[0]);

        return self::getClient()->chat()->create($completionsArgs);
    }

    /**
     * Get AI Model
     *
     * @return string
     */
    public static function aiModel()
    {
        return preference('ai_model');
    }

    /**
     * Max Token for create data
     *
     * @return int
     */
    public static function aiMaxToken()
    {
        return preference('max_token_length');
    }

    /**
     * AI keys
     *
     * @return string
     */
    public static function aiKey()
    {
        return preference('openai');
    }

    public static function requiredStremedData()
    {
        return request()->hasHeader('stream-data') ? true : false;
    }
}
