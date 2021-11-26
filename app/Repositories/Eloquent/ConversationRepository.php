<?php

namespace App\Repositories\Eloquent;

use App\Models\Message;
use App\Helpers\APIResponse;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ConversationRepositoryInterface;

class ConversationRepository extends BaseRepository implements ConversationRepositoryInterface
{
   /**
    * ConversationRepository constructor.
    *
    * @param Conversation $model
    */
    public function __construct(Conversation $model)
    {
       parent::__construct($model);
    }

    public function showMyConversation()
    {
        $data = Conversation::where(
            'user_id_1', Auth::user()->id
        )->orWhere(
            'user_id_2', Auth::user()->id
        )->get();

        return APIResponse::success($data);
    }

    public function store(int $receiver_id, string $content)
    {
        $conversation = Conversation::where(['user_id_1' => Auth::user()->id, 'user_id_2' => $receiver_id])->first();
        if (!$conversation) {
            $conversation = Conversation::where(['user_id_1' => $receiver_id, 'user_id_2' => Auth::user()->id])->first();
        }

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_id_1' => Auth::user()->id,
                'user_id_2' => $receiver_id,
            ]);
        }

        $conversation->messages()->create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $receiver_id,
            'type' => Message::TYPE_TEXT,
            'content' => $content
        ]);

        return APIResponse::success($this->show($conversation));
    }

    /**
    * @param Model $conversation
    */
    public function show(Conversation $conversation)
    {
        return $conversation->load('messages');
    }

    public function showAllConversation()
    {
        $data = Conversation::with('messages')->get();

        return APIResponse::success($data);

    }
}