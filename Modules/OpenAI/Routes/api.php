<?php

use Illuminate\Support\Facades\Route;
use Modules\OpenAI\Http\Controllers\Api\V1\Admin\{
    UseCasesController as adminUsecaseApi,
    UseCaseCategoriesController as adminUseCaseCategoryApi,
    OpenAIController as adminApi,
    ImageController as adminImageApi,
    CodeController as adminCodeApi,
};
use Modules\OpenAI\Http\Controllers\Api\V1\User\{
    OpenAIController,
    ImageController,
    UseCasesController,
    UseCaseCategoriesController,
    CodeController,
    OpenAIPreferenceController,
    ChatController,
    UserController,
    SpeechToTextController,
    TextToSpeechController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/V1/user/openai', 'middleware' => ['auth:api', 'locale', 'permission-api']], function() {
    Route::post('chat', [OpenAIController::class, 'chat']);
    Route::get('chat/conversation', [OpenAIController::class, 'chatConversation']);
    Route::get('chat/history/{id}', [OpenAIController::class, 'history']);

    Route::post('chat/delete', [ChatController::class, 'delete']);
    Route::post('chat/update', [ChatController::class, 'update']);

    Route::get('chat/assistant/list', [ChatController::class, 'allChatAssistants']);
});

Route::group(['prefix' => '/V1/user/openai', 'middleware' => ['auth:api', 'locale', 'permission-api']], function() {
    // Content
    Route::get('content/list', [OpenAIController::class, 'index']);
    Route::get('content/view/{slug}', [OpenAIController::class, 'view']);
    Route::post('content/edit/{slug}', [OpenAIController::class, 'update']);
    Route::delete('content/delete/{id}', [OpenAIController::class, 'delete']);
    Route::post('content/toggle/bookmark', [OpenAIController::class, 'contentTogglebookmark']);

    // Image
    Route::get('image/list', [ImageController::class, 'index']);
    Route::delete('image/delete', [ImageController::class, 'delete']);
    Route::get('image/view/{id}', [ImageController::class, 'view']);


    // Create content, image, code, Speech to Text and Text to Speech
    Route::post('ask', [OpenAIController::class, 'ask'])->middleware(['userPermission:hide_template', 'teamAccess:template,api']);
    Route::post('image', [OpenAIController::class, 'image'])->middleware(['userPermission:hide_image', 'teamAccess:image,api']);
    Route::post('code', [OpenAIController::class, 'code'])->middleware(['userPermission:hide_code', 'teamAccess:code,api']);
    Route::post('speech', [OpenAIController::class, 'speechToText'])->middleware(['userPermission:hide_speech_to_text', 'teamAccess:speech_to_text,api']);
    Route::post('text-to-speech', [TextToSpeechController::class, 'textToSpeech'])->middleware(['userPermission:hide_text_to_speech', 'teamAccess:voiceover,api']);

    // use case
    Route::get('/use-cases', [UseCasesController::class, 'index']);
    Route::post('/use-case/create', [UseCasesController::class, 'create']);
    Route::get('/use-case/{id}/show', [UseCasesController::class, 'show']);
    Route::put('/use-case/{id}/edit', [UseCasesController::class, 'edit']);
    Route::delete('/use-case/{id}/delete', [UseCasesController::class, 'destroy']);
    Route::post('/use-case/toggle/favorite', [UseCasesController::class, 'useCaseToggleFavorite']);

     // use case category
    Route::get('/use-case/categories', [UseCaseCategoriesController::class, 'index']);
    Route::post('/use-case/category/create', [UseCaseCategoriesController::class, 'create']);
    Route::get('/use-case/category/{id}/show', [UseCaseCategoriesController::class, 'show']);
    Route::put('/use-case/category/{id}/edit', [UseCaseCategoriesController::class, 'edit']);
    Route::delete('/use-case/category/{id}/delete', [UseCaseCategoriesController::class, 'destroy']);

    // Code
    Route::get('code/list', [CodeController::class, 'index']);
    Route::get('code/view/{slug}', [CodeController::class, 'view']);
    Route::delete('code/delete/{id}', [CodeController::class, 'delete']);

    // Speech
    Route::get('speech/list', [SpeechToTextController::class, 'index']);
    Route::get('speech/view/{id}', [SpeechToTextController::class, 'show']);
    Route::post('speech/edit/{id}', [SpeechToTextController::class, 'edit']);
    Route::delete('speech/delete/{id}', [SpeechToTextController::class, 'destroy']);

    //Content Preferences
    Route::get('preferences/content', [OpenAIPreferenceController::class, 'contentPreferences']);
    Route::get('preferences/image', [OpenAIPreferenceController::class, 'imagePreferences']);
    Route::get('preferences/code', [OpenAIPreferenceController::class, 'codePreferences']);
    Route::get('preferences/chat', [OpenAIPreferenceController::class, 'chatPreferences']);

    // Text To Speech
    Route::get('text-to-speech/list', [TextToSpeechController::class, 'index']);
    Route::get('text-to-speech/view/{id}', [TextToSpeechController::class, 'show']);
    Route::delete('text-to-speech/delete/{id}', [TextToSpeechController::class, 'destroy']);

    //Update Profile
    Route::post('/profile', [UserController::class, 'update']);
    Route::post('/profile/delete', [UserController::class, 'destroy']);

    //Subscription Package Info
    Route::get('/package-info', [UserController::class, 'index']);

});

Route::group(['prefix' => '/V1/admin/openai', 'middleware' => ['auth:api', 'locale', 'permission']], function() {
    // Content
    Route::get('content/list', [adminApi::class, 'index']);
    Route::get('content/view/{slug}', [adminApi::class, 'view']);
    Route::post('content/edit/{slug}', [adminApi::class, 'update']);
    Route::delete('content/delete/{id}', [adminApi::class, 'delete']);

    // Image
    Route::get('image/list', [adminImageApi::class, 'index']);
    Route::delete('image/delete', [adminImageApi::class, 'delete']);
    Route::get('image/view/{id}', [adminImageApi::class, 'view']);

    // Create content and image
    Route::post('ask', [adminApi::class, 'ask']);
    Route::post('image', [adminApi::class, 'image']);
    Route::post('code', [adminApi::class, 'code']);

    // use case
    Route::get('/use-cases', [adminUsecaseApi::class, 'index']);
    Route::post('/use-case/create', [adminUsecaseApi::class, 'create']);
    Route::get('/use-case/{id}/show', [adminUsecaseApi::class, 'show']);
    Route::put('/use-case/{id}/edit', [adminUsecaseApi::class, 'edit']);
    Route::delete('/use-case/{id}/delete', [adminUsecaseApi::class, 'destroy']);

    // use case category
    Route::get('/use-case/categories', [adminUseCaseCategoryApi::class, 'index']);
    Route::post('/use-case/category/create', [adminUseCaseCategoryApi::class, 'create']);
    Route::get('/use-case/category/{id}/show', [adminUseCaseCategoryApi::class, 'show']);
    Route::put('/use-case/category/{id}/edit', [adminUseCaseCategoryApi::class, 'edit']);
    Route::delete('/use-case/category/{id}/delete', [adminUseCaseCategoryApi::class, 'destroy']);

    // Code
    Route::get('code/list', [adminCodeApi::class, 'index']);
    Route::get('code/view/{slug}', [adminCodeApi::class, 'view']);
    Route::delete('code/delete/{id}', [adminCodeApi::class, 'delete']);

});
