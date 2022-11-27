<?php
namespace App\Http\Controllers;
use App\Models\Plans;
use Automath\LearnUnits;

class PracticeController extends Controller
{
    public function learnUnitNow($slug)
    {
        $name = strtoupper(str_replace('-', '_', $slug));
        
        if(!isset(LearnUnits::PROBLEMS[$name]))
        {
            return abort(404);
        }

        $integerInstigator = new \Automath\Equations\IntegerInstigator([ 0, 10 ], [ 0, 10 ]);
        $integerProblem = $integerInstigator->create();
        $integerSolver = new \Automath\Equations\Addition\Solver($integerProblem);
        
        dump($integerProblem);
        dump($integerSolver->solve());
        
        return view('agency/learn/unit');
    }

    public function showLearnUnits()
    {
        $units = [ ];

        foreach(LearnUnits::PROBLEMS as $k => $unit)
        {
            $unit['url'] = route('learn.unit', \Illuminate\Support\Str::slug($k));
            $unit['title'] = ucwords(strtolower(str_replace('_', ' ', $k)));
            $unit['description'] = 'Pellentesque dapibus mi sit amet ultricies tincidunt.';
            $units[$k] = $unit;
        }

        return view('agency/learn/units', [ 
            'units' => $units
        ]);
    }
}
