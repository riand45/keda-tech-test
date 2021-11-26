<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public const TYPE_FEEDBACK = "feedback";

    public const TYPE_BUG = "bug";

    protected $guarded = [];
}
