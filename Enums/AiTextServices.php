<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Class AiTextServices
 * Enumeration class for AI text services.
 */
class AiTextServices
{
    // /v1/chat/completions ENDPOINT

    public const GPT_4 = 'gpt-4';
    public const GPT_4_0613 = 'gpt-4-0613';
    public const GPT_4_32K = 'gpt-4-32k';
    public const GPT_4_32K_0613 = 'gpt-4-32k-0613';
    public const GPT_35_TURBO = 'gpt-3.5-turbo';
    public const GPT_35_TURBO_0613 = 'gpt-3.5-turbo-0613';
    public const GPT_35_TURBO_16K = 'gpt-3.5-turbo-16k';
    public const GPT_35_TURBO_16K_0613 = 'gpt-3.5-turbo-16k-0613';

    // /v1/completions ENDPOINT

    public const TEXT_DAVINCI_003 = 'text-davinci-003';
    public const TEXT_DAVINCI_002 = 'text-davinci-002';
    public const TEXT_DAVINCI_001 = 'text-davinci-001';
    public const TEXT_CURIE_001 = 'text-curie-001';
    public const TEXT_BABBAGE_001 = 'text-babbage-001';
    public const TEXT_ADA_001 = 'text-ada-001';
    public const DAVINCI = 'davinci';
    public const CURIE = 'curie';
    public const BABBAGE = 'babbage';
    public const ADA = 'ada';

    /**
     * An array of AI model types.
     */
    public const TYPES = [
        self::ADA,
        self::BABBAGE,
        self::CURIE,
        self::DAVINCI,
        self::GPT_35_TURBO,
        self::GPT_35_TURBO_16K,
        self::GPT_4,
        self::GPT_4_32K,
    ];

    /**
     * An array of AI models used for chat completions.
     */
    public const CHAT_COMPLETIONS_ENDPOINT = [
        self::GPT_4,
        self::GPT_4_0613,
        self::GPT_4_32K,
        self::GPT_4_32K_0613,
        self::GPT_35_TURBO,
        self::GPT_35_TURBO_0613,
        self::GPT_35_TURBO_16K,
        self::GPT_35_TURBO_16K_0613,
    ];

    /**
     * An array of AI models used for general completions.
     */
    public const COMPLETIONS_ENDPOINT = [
        self::TEXT_DAVINCI_003,
        self::TEXT_DAVINCI_002,
        self::TEXT_DAVINCI_001,
        self::TEXT_CURIE_001,
        self::TEXT_BABBAGE_001,
        self::TEXT_ADA_001,
        self::DAVINCI,
        self::CURIE,
        self::BABBAGE,
        self::ADA,
    ];
}
