<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function home():View
    {
      return view('home');
    }
    public function generateExercises(Request $request):View
    {
      $operationsInputNames = [
          'check_sum'            => 'check_sum',
          'check_subtraction'    => 'check_subtraction',
          'check_multiplication' => 'check_multiplication',
          'check_division'       => 'check_division',
      ];

      function returnInputsNamesExcept($operationsInputNames, $inputName) {
          unset($operationsInputNames[$inputName]);
          return implode(',', $operationsInputNames);
      }

      $request->validate([
          'check_sum' => 'required_without_all:' .            returnInputsNamesExcept($operationsInputNames, 'check_sum'),
          'check_subtraction' => 'required_without_all:' .    returnInputsNamesExcept($operationsInputNames, 'check_subtraction'),
          'check_multiplication' => 'required_without_all:' . returnInputsNamesExcept($operationsInputNames, 'check_multiplication'),
          'check_division' => 'required_without_all:' .       returnInputsNamesExcept($operationsInputNames, 'check_division'),
          'number_one' => 'required|integer|min:0|max:999',
          'number_two' => 'required|integer|min:0|max:999',
          'number_exercises'=> 'required|integer|min:5|max:50'
      ]);

      $operations = [];
      if($request->check_sum )            $operations[] = 'sum';
      if($request->check_subtraction )    $operations[] = 'subtraction';
      if($request->check_multiplication ) $operations[] = 'multiplication';
      if($request->check_division )       $operations[] = 'division';

      $min = $request->number_one;
      $max = $request->number_two;

      $numberExercises = $request->number_exercises;

      $exercises = [];
      for($index = 0; $index <= $numberExercises; $index++){
        $operation = $operations[array_rand($operations)];
        $number1 = rand($min, $max);
        $number2 = rand($min, $max);

        $exercise = '';
        $solution = 0;

        if($operation === 'sum'){
          $exercise = "$number1 + $number2";
          $solution =  $number1 + $number2;
        }
        if($operation === 'subtraction'){
          $exercise = "$number1 - $number2";
          $solution =  $number1 - $number2;
        }
        if($operation === 'multiplication'){
          $exercise = "$number1 * $number2";
          $solution =  $number1 * $number2;
        }
        if($operation === 'division'){
          if($number2 <= 0) $number2 = 1;
          $exercise = "$number1 / $number2";
          $solution =  $number1 / $number2;
        }

        if(is_float($solution)) $solution = round($solution, 2);

        $exercises[] = [
          'exercise_number' => $index,
          'exercise' => $exercise,
          'solution' => $solution
        ];
      }
      session(['exercises' => $exercises]);
      return view('operations', ['exercises' => $exercises]);
    }
    public function printExercises(){
      if(!session()->has('exercises')){
        return redirect()->route('home');
      }

      $exercises = session('exercises');
      echo '<pre>';
      echo '<h1>Exercícios de matemática('.env('APP_NAME').')</h1>';
      echo '<hr/>';
      foreach($exercises as $exercise){
        echo '<h2><small>'.str_pad($exercise['exercise_number'], 2, '0', STR_PAD_LEFT).' - </small>'.$exercise['exercise'].'</h2>';
      }
      echo '<hr/>';
      echo '<h2><small>Soluções</small></h2>';
      foreach($exercises as $exercise){
        echo '<small>'.str_pad($exercise['exercise_number'], 2, '0', STR_PAD_LEFT).' - '.$exercise['exercise'].' = '.$exercise['solution'].'</small> <br/>';
      }
      echo '</pre>';
    }
    public function exportExercises(){
      echo 'export';
    }
}
