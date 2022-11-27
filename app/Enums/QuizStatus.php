<?php
namespace App\Enums;

enum QuizStatus : string
{
	case 'pending';
	case 'inprogress';
	case 'completed';
}