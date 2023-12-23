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

    /** @var string Represents the GPT-4 model. */
    const GPT_4 = "gpt-4";

    /** @var string Represents the GPT-4 0613 model. */
    const GPT_4_0613 = "gpt-4-0613";

    /** @var string Represents the GPT-4 32K model. */
    const GPT_4_32K = "gpt-4-32k";

    /** @var string Represents the GPT-4 32K 0613 model. */
    const GPT_4_32K_0613 = "gpt-4-32k-0613";

    /** @var string Represents the GPT-3.5 Turbo model. */
    const GPT_35_TURBO = "gpt-3.5-turbo";

    /** @var string Represents the GPT-3.5 Turbo 0613 model. */
    const GPT_35_TURBO_0613 = "gpt-3.5-turbo-0613";

    /** @var string Represents the GPT-3.5 Turbo 16K model. */
    const GPT_35_TURBO_16K = "gpt-3.5-turbo-16k";

    /** @var string Represents the GPT-3.5 Turbo 16K 0613 model. */
    const GPT_35_TURBO_16K_0613 = "gpt-3.5-turbo-16k-0613";

    // /v1/completions ENDPOINT

    /** @var string Represents the Text Davinci 003 model. */
    const TEXT_DAVINCI_003 = "text-davinci-003";

    /** @var string Represents the Text Davinci 002 model. */
    const TEXT_DAVINCI_002 = "text-davinci-002";

    /** @var string Represents the Text Davinci 001 model. */
    const TEXT_DAVINCI_001 = "text-davinci-001";

    /** @var string Represents the Text Curie 001 model. */
    const TEXT_CURIE_001 = "text-curie-001";

    /** @var string Represents the Text Babbage 001 model. */
    const TEXT_BABBAGE_001 = "text-babbage-001";

    /** @var string Represents the Text Ada 001 model. */
    const TEXT_ADA_001 = "text-ada-001";

    /** @var string Represents the Davinci model. */
    const DAVINCI = "davinci";

    /** @var string Represents the Curie model. */
    const CURIE = "curie";

    /** @var string Represents the Babbage model. */
    const BABBAGE = "babbage";

    /** @var string Represents the Ada model. */
    const ADA = "ada";

    /**
     * An array of AI model types.
     *
     * @var array
     */
    const types = [
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
     *
     * @var array
     */
    const chatCompletionsEndpoint = [
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
     *
     * @var array
     */
    const completionsEndpoint = [
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
