<?php

namespace Modules\OpenAI\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Modules\OpenAI\Entities\ChatBot;
use Modules\OpenAI\Services\{
    ContentService,
    CodeService,
    ChatService
};
use Modules\OpenAI\Transformers\Api\V1\{
    PreferenceResource,
    ChatResource
};

class OpenAIPreferenceController extends Controller
{
    /**
    * Content Preferences
    * @param ContentService $contentService
    * @return [type]
    */
    public function contentPreferences(ContentService $contentService)
    {
        $document = $contentService->getMeta('document');
        return $this->successResponse(new PreferenceResource($document));
    }

    /**
    * Image Maker Preferences
    * @param ContentService $contentService
    * @return [type]
    */
    public function imagePreferences(ContentService $contentService)
    {
        $imageMaker = $contentService->getMeta('image_maker');
        return $this->successResponse(new PreferenceResource($imageMaker));
    }

    /**
    * Code Writer Preferences
    * @param CodeService $codeService
    * @return [type]
    */
    public function codePreferences(CodeService $codeService)
    {
        $codeWriter = $codeService->getMeta('code_writer');
        return $this->successResponse(new PreferenceResource($codeWriter));
    }

    /**
    * Chat Preferences
    * @return [type]
    */
    public function chatPreferences(ChatService $chatService)
    {
        $chatBot = $chatService->getBotName();
        return $this->successResponse(new ChatResource($chatBot));
    }
}
