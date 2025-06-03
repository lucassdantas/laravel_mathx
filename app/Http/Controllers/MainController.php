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
    public function generateExercises(Request $request)
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
          'check_sum' => 'required_without_all:' . returnInputsNamesExcept($operationsInputNames, 'check_sum'),
          'check_subtraction' => 'required_without_all:' . returnInputsNamesExcept($operationsInputNames, 'check_subtraction'),
          'check_multiplication' => 'required_without_all:' . returnInputsNamesExcept($operationsInputNames, 'check_multiplication'),
          'check_division' => 'required_without_all:' . returnInputsNamesExcept($operationsInputNames, 'check_division'),
          'number_one'=>'required|integer|min:0|max:999',
          'number_two'=>'required|integer|min:0|max:999',
          'number_exercises'=> 'required|integer|min:5|max:50'
      ]);


      dd($request->all());
    }
    public function printExercises(){
      echo 'print';
    }
    public function exportExercises(){
      echo 'export';
    }
}
