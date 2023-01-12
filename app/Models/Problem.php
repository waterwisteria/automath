<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Problem extends Model implements TranslatableContract
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
