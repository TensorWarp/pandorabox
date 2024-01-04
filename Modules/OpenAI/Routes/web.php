<?php

use Illuminate\Support\Facades\Route;
use Modules\OpenAI\Entities\Chat;
use Modules\OpenAI\Http\Controllers\Admin\{
    UseCasesController,
    UseCaseCategoriesController,
    OpenAIController,
    ImageController,
    CodeController,
    TextToSpeechController as AdminTextToSpeechController,
    ChatCategoriesController,
    ChatAssistantsController,
    SpeechToTextController
};
use Modules\OpenAI\Http\Controllers\Customer\{
    OpenAIController as UserAIController,
    SpeechToTextController as UserSpeechToTextController,
    ImageController as UserImageController,
    UseCasesController as CustomerUseCasesController,
    DocumentsController as CustomerDocumentsController,
    CodeController as CustomerCodeController,
    ChatController,
    TextToSpeechController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('image-share/{slug}', [UserImageController::class, 'imageShare'])->name('imageShare');

//template
Route::middleware(['middleware' => 'userPermission:hide_template'])->group(function () {
    Route::get('/user/templates/', [UserAIController::class, 'templates'])->name('openai')->middleware(['auth', 'locale','teamAccess:template']);
});
Route::prefix('user')->middleware(['auth', 'locale'])->name('user.')->group(function () {
    //template
    Route::middleware(['middleware' => 'userPermission:hide_template'])->group(function () {
        Route::get('documents', [UserAIController::class, 'documents'])->name('documents');
        Route::get('favourite-documents', [UserAIController::class, 'favouriteDocuments'])->name('favouriteDocuments');
        Route::get('templates/{slug}', [UserAIController::class, 'template'])->name('template')->middleware('teamAccess:template');
        Route::get('formfiled-usecase/{slug}', [UserAIController::class, 'getFormFiledByUsecase'])->name('formField');
        Route::get('get-content', [UserAIController::class, 'getContent']);
        Route::get('deleteContent', [UserAIController::class, 'deleteContent'])->name('deleteContent');
        Route::get('content/edit/{slug}', [UserAIController::class, 'editContent'])->name('editContent');
        Route::post('update-content', [UserAIController::class, 'updateContent'])->name('updateContent');
    });
    
    // Text To Speech
    Route::middleware(['middleware' => 'userPermission:hide_text_to_speech'])->group(function () {
        Route::get('text-to-speech', [TextToSpeechController::class, 'textToSpeechTemplate'])->name('textToSpeechTemplate')->middleware('teamAccess:voiceover');
        Route::get('text-to-speech-list', [TextToSpeechController::class, 'textToSpeechList'])->name('textToSpeechList');
        Route::get('text-to-speech/view/{id}', [TextToSpeechController::class, 'show'])->name('textToSpeechView');
        Route::post('text-to-speech/delete', [TextToSpeechController::class, 'delete'])->name('textToSpeechDelete');
        Route::post('text-to-speech/destroy', [TextToSpeechController::class, 'destroy'])->name('textToSpeechDestroy');

    });

    Route::middleware(['middleware' => 'userPermission:hide_image'])->group(function () {
        Route::get('image', [UserAIController::class, 'imageTemplate'])->name('imageTemplate')->middleware('teamAccess:image');
        Route::post('delete-image', [UserImageController::class, 'deleteImage'])->name('deleteImage');
        Route::post('save-image', [UserImageController::class, 'saveImage'])->name('saveImage');
        Route::get('image-list', [UserImageController::class, 'list'])->name('imageList');
        Route::get('image/view/{slug}', [UserImageController::class, 'view'])->name('image.view');
        Route::get('image-gallery', [UserImageController::class, 'imageGallery'])->name('imageGallery');
        Route::get('image-view/{slug}', [UserImageController::class, 'imageView'])->name('imageView');
    });
    
    //Code
    Route::middleware(['middleware' => 'userPermission:hide_code'])->group(function () {
        Route::get('code', [UserAIController::class, 'codeTemplate'])->name('codeTemplate')->middleware('teamAccess:code');
        Route::get('code-list', [CustomerCodeController::class, 'index'])->name('codeList');
        Route::get('code/view/{slug}', [CustomerCodeController::class, 'view'])->name('codeView');
        Route::post('code/delete/', [CustomerCodeController::class, 'delete'])->name('deleteCode');
    });
    
    // Speech To Text
    Route::middleware(['middleware' => 'userPermission:hide_speech_to_text'])->group(function () {
        Route::get('speech-to-text', [UserSpeechToTextController::class, 'speechTemplate'])->name('speechTemplate')->middleware('teamAccess:speech_to_text');
        Route::get('speech-list', [UserSpeechToTextController::class, 'speechLists'])->name('speechLists');
        Route::get('speech/edit/{id}', [UserSpeechToTextController::class, 'editSpeech'])->name('editSpeech');
        Route::post('update-speech', [UserSpeechToTextController::class, 'updateSpeech'])->name('updateSpeech');
        Route::post('delete-speech', [UserSpeechToTextController::class, 'deleteSpeech'])->name('deleteSpeech');
    });

    // Chat
    Route::get('chat-history/{id}', [ChatController::class, 'history'])->name('chat');
    Route::post('delete-chat', [ChatController::class, 'delete'])->name('deleteChat');
    Route::post('update-chat', [ChatController::class, 'update'])->name('updateChat');

    Route::get('chat/bot', [ChatController::class, 'chatBot']);
    Route::get('chat-conversation', [ChatController::class, 'conversation']);
    
    Route::post('download/file', [UserAIController::class, 'downloadFile']);
});

Route::middleware(['auth', 'locale'])->prefix('admin')->group(function () {
    Route::name('admin.use_case.')->group(function() {
        // use case
        Route::get('/use-cases', [UseCasesController::class, 'index'])->name('list');
        Route::match(['get', 'post'], '/use-case/create', [UseCasesController::class, 'create'])->name('create');
        Route::match(['get', 'post'], '/use-case/{id}/edit', [UseCasesController::class, 'edit'])->name('edit');
        Route::post('/use-case/{id}/delete', [UseCasesController::class, 'destroy'])->middleware(['checkForDemoMode'])->name('destroy');

        // use case category
        Route::get('/use-case/categories', [UseCaseCategoriesController::class, 'index'])->name('category.list');
        Route::match(['get', 'post'], '/use-case/category/create', [UseCaseCategoriesController::class, 'create'])->name('category.create');
        Route::match(['get', 'post'], '/use-case/category/{id}/edit', [UseCaseCategoriesController::class, 'edit'])->name('category.edit');
        Route::post('/use-case/category/{id}/delete', [UseCaseCategoriesController::class, 'destroy'])->middleware(['checkForDemoMode'])->name('category.destroy');
        Route::get('/use-case/category/search', [UseCaseCategoriesController::class, 'searchCategory'])->name('category.search');
    });

    Route::name('admin.chat.')->group(function() {
        
        // Chat category
        Route::get('/chat/categories', [ChatCategoriesController::class, 'index'])->name('category.list');
        Route::match(['get', 'post'], '/chat/category/create', [ChatCategoriesController::class, 'create'])->name('category.create');
        Route::match(['get', 'post'], '/chat/category/{id}/edit', [ChatCategoriesController::class, 'edit'])->name('category.edit');
        Route::post('/chat/category/{id}/delete', [ChatCategoriesController::class, 'destroy'])->middleware(['checkForDemoMode'])->name('category.destroy');

        // Chat Assistants
        Route::get('/chat/assistants', [ChatAssistantsController::class, 'index'])->name('assistant.list');
        Route::match(['get', 'post'], '/chat/assistant/create', [ChatAssistantsController::class, 'create'])->name('assistant.create');
        Route::match(['get', 'post'], '/chat/assistant/{id}/edit', [ChatAssistantsController::class, 'edit'])->name('assistant.edit');
        Route::get('/chat/assistant/delete', [ChatAssistantsController::class, 'destroy'])->middleware(['checkForDemoMode'])->name('assistant.destroy');
    });

    Route::name('admin.features.')->group(function() {
        // Content
        Route::get('content/list', [OpenAIController::class, 'index'])->name('contents');
        Route::get('content/edit/{slug}', [OpenAIController::class, 'edit'])->name('content.edit');
        Route::post('content/update/{id}', [OpenAIController::class, 'update'])->middleware(['checkForDemoMode'])->name('content.update');
        Route::get('content/delete', [OpenAIController::class, 'delete'])->middleware(['checkForDemoMode'])->name('content.delete');

        // Image
        Route::post('delete-images', [ImageController::class, 'deleteImages'])->middleware(['checkForDemoMode'])->name('deleteImage');
        Route::post('save-image', [ImageController::class, 'saveImage'])->name('saveImage');
        Route::get('image/list', [ImageController::class, 'list'])->name('imageList');
        Route::get('image/view/{slug}', [ImageController::class, 'view'])->name('image.view');

        // Code
        Route::get('code/list', [CodeController::class, 'index'])->name('code.list');
        Route::get('code/view/{slug}', [CodeController::class, 'view'])->name('code.view');
        Route::post('code/delete', [CodeController::class, 'delete'])->middleware(['checkForDemoMode'])->name('code.delete');

        // Content Preferences
        Route::get('features/preferences', [OpenAIController::class, 'contentPreferences'])->name('preferences');
        Route::post('features/preferences/create', [OpenAIController::class, 'createContentPreferences'])->middleware(['checkForDemoMode'])->name('preferences.create');

        // Text To Speech
        Route::get('text-to-speech/list', [AdminTextToSpeechController::class, 'index'])->name('textToSpeech.lists');
        Route::get('text-to-speech/view/{slug}', [AdminTextToSpeechController::class, 'show'])->name('textToSpeech.view');
        Route::post('text-to-speech/delete', [AdminTextToSpeechController::class, 'delete'])->middleware(['checkForDemoMode'])->name('textToSpeech.delete');

        // All Voices
        Route::get('text-to-speech/voice/list', [AdminTextToSpeechController::class, 'allVoices'])->name('textToSpeech.voice.lists');
        Route::match(['get', 'post'], 'text-to-speech/voice/create', [AdminTextToSpeechController::class, 'voiceCreate'])->name('textToSpeech.voice.create');
        Route::match(['get', 'post'],'text-to-speech/voice/edit/{id}', [AdminTextToSpeechController::class, 'voiceEdit'])->name('textToSpeech.voice.edit');
        
        // Speech
        Route::get('speech/list', [SpeechToTextController::class, 'index'])->name('speeches');
        Route::get('speech/edit/{id}', [SpeechToTextController::class, 'edit'])->name('speech.edit');
        Route::post('speech/update/{id}', [SpeechToTextController::class, 'update'])->middleware(['checkForDemoMode'])->name('speech.update');
        Route::post('speech/delete', [SpeechToTextController::class, 'delete'])->middleware(['checkForDemoMode'])->name('speech.delete');
    });
});

Route::middleware(['auth', 'locale'])->prefix('user/openai')->name('user.')->group(function () {
    Route::get('/use-case/search', [CustomerUseCasesController::class, 'searchTabData'])->name('use_case.search');
    Route::post('/use-case/toggle/favorite', [CustomerUseCasesController::class, 'toggleFavorite'])->name('use_case.toggle.favorite');
    Route::get('/documents/fetch', [CustomerDocumentsController::class, 'fetchAndFilter'])->name('document.fetch');
    Route::post('/documents/toggle/bookmark', [CustomerDocumentsController::class, 'toggleBookmark'])->name('document.toggle.bookmark');

    Route::post('/image/toggle/favorite', [UserImageController::class, 'toggleFavoriteImage'])->name('image.toggle.favorite');
});
