<?php

namespace App\Http\Requests;

use App\Models\Report;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ReportStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reported_user_id' => 'required|exists:users,id',
            'type' => [ 'required', Rule::in(Report::TYPE_BUG, Report::TYPE_FEEDBACK)],
            'description' => 'required'
        ];
    }
}
