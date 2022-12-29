<?php
namespace App\Enums;

enum QuizStatus : string
{
	case Pending = 'pending';
	case Inprogress = 'inprogress';
	case Completed = 'completed';
}