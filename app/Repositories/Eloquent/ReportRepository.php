<?php

namespace App\Repositories\Eloquent;

use App\Helpers\APIResponse;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ReportRepositoryInterface;

class ReportRepository extends BaseRepository implements ReportRepositoryInterface
{
   /**
    * ReportRepository constructor.
    *
    * @param Report $model
    */
    public function __construct(Report $model)
    {
       parent::__construct($model);
    }

    public function store(array $request)
    {
        $report = Report::create([
            'user_id' => Auth::user()->id
            ]+$request
        );

        return APIResponse::success($report);
    }
}