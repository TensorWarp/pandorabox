<?php

namespace Modules\OpenAI\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\OpenAI\Services\{
    ChatService
};

class ChatController extends Controller
{
    protected $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }
    public function saveChat($chat)
    {
        return $this->chatService->save($chat);
    }

    public function history($id)
    {
       return $this->chatService->chatById($id);
    }

    public function delete(Request $request)
    {
        $response = ['status' => 'error', 'message' => __('The :x does not exist.', ['x' => __('Chat Conversation')])];

        if ($this->chatService->delete($request->chatId)) {
            $response = ['status' => 'success', 'message' => __('The :x has been successfully deleted.', ['x' => __('Chat')])];
        }

        return response()->json($response);
    }

    public function update(Request $request)
    {
        return $this->chatService->update($request->all());
    }

    public function chatBot(Request $request)
    {
        $data['bot'] = $this->chatService->chatBotById($request->id);
        $data['contacts'] = $this->chatService->getMyContactListWithLastMessage($data['bot']->id);
        $data['assistants'] = $this->chatService->getAssistants();
        
        $data['subscriptionBots'] = $this->chatService->getAccessibleBots();
        
        $data['botPlan'] = $this->chatService->getBotPlan();
        
        $data['chatConversation'] = $this->chatService->chatConversationWithBot();
        $chat = count($data['contacts']) != 0 ? $this->chatService->chatById($data['contacts'][0]->chat_conversation_id) : [];
        
        $html = view('site.chat.message', $data)->render();

        return response()->json([
            'html' => $html,
            'chat' => $chat,
            'id' => $data['contacts'][0]->chat_conversation_id ?? []
        ]);
        
    }

    public function conversation(Request $request)
    {
        $bot = $this->chatService->chatBotById($request->id);
        $contacts = $this->chatService->getMyContactListWithLastMessage($bot->id);

        return response()->json([
            'html' => $contacts,
        ]);
        
    }

}


