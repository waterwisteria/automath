<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    protected $casts = [ 'instigator_params' => 'array' ];

    public function problemDefinition()
    {
        return $this->belongsTo(ProblemDefinition::class);
    }
}
