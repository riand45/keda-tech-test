<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportStoreRequest;
use App\Repositories\ReportRepositoryInterface;
use App\Repositories\ConversationRepositoryInterface;

class CustomerController extends Controller
{
    private $conversationRepository;
    private $reportRepository;

    public function __construct(
        ConversationRepositoryInterface $conversationRepository,
        ReportRepositoryInterface $reportRepository
    )
    {
       $this->conversationRepository = $conversationRepository;
       $this->reportRepository = $reportRepository;
    }

    public function chatHistory()
    {
        return $this->conversationRepository->showMyConversation();
    }


    public function createReport(ReportStoreRequest $request)
    {
        return $this->reportRepository->store(request()->all());
    }

}
