<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employment;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\Response;

class EmploymentController extends Controller
{
    public function index(){
        $employments = Employment::all();
        return view('employment', [
            'employments' => $employments
        ]);
    }
   
    public function get_insert_view(){
        return view('employment_insert');
    }

    public function store(Request $request){
   
         // Validation
        $request->validate([
           'name' => 'required',
           'employment' => 'required',
           'molsher' => 'required',
        ]); 
   
        $data = array(
            "name" => $request->name,
            "employment" => $request->employment,
            "molsher" => $request->molsher
        );
        Employment::insert($data);
   
        return redirect()->back()->with('message', 'Енгізілді!');
    }

    public function delete(Request $request){
        Employment::where('id',$request->employment_id)->delete();
        return redirect()->back();
    }
}
