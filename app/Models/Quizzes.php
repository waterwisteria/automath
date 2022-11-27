<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\QuizzStatus;

class Quizzes extends Model
{
    use HasFactory;

    protected $casts = [ 'status' => QuizzStatus::class ];
}
