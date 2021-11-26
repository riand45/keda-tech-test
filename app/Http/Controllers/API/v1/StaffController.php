<?php

namespace App\Http\Controllers\API\v1;

use Exception;
use App\Models\User;
use App\Helpers\APIResponse;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\ConversationRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class StaffController extends Controller
{
    private $userRepository;
    private $conversationRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ConversationRepositoryInterface $conversationRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->conversationRepository = $conversationRepository;
    }

    public function allChatHistory()
    {
        if (!Gate::allows('all-chat')) {
            return APIResponse::error(new HttpException(403, 'You are not allowed'));
        }
        return $this->conversationRepository->showAllConversation();
    }

    public function allCustumers()
    {
        if (!Gate::allows('all-customer')) {
            return APIResponse::error(new HttpException(403, 'You are not allowed'));
        }
        return $this->userRepository->allCustomer(User::CUSTOMER, true);
    }

    public function deleteCustumer($id)
    {
        try {
            if (!Gate::allows('delete-customer')) {
                return APIResponse::error(new HttpException(403, 'You are not allowed'));
            }
            return $this->userRepository->deleteCustumer($id);
        } catch (Exception $e) {
            return APIResponse::error($e);
        }
    }
}
