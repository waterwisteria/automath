<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Problem extends Model
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = [ 'description' ];
    
    protected $casts = [ 'instigator_params' => 'array' ];

    public function problemDefinition()
    {
        return $this->belongsTo(ProblemDefinition::class);
    }
}
