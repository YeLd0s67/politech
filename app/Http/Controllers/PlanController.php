<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\Response;

class PlanController extends Controller
{
    public function view(){
        $plans = Plan::all();
        return view('plan_view', [
            'plans' => $plans
        ]);
    }
   
    public function insert(){
        return view('plan_insert');
    }

    public function get_name(Request $request){
        $names = Plan::select('spec_name')->where('spec_code', $request->spec_code)->get();
        $output="";
        foreach ($names as $name) {
            $output.='<option>'.$name->spec_name.'</option>';
        }
        return $output;
    }
    public function get_prof(Request $request){
        $profs = Plan::select('prof')->where('spec_name', $request->spec_name)->get();
        $output="";
        $output.='<option>'.'-'.'</option>';
        foreach ($profs as $prof) {
            $output.='<option>'.$prof->prof.'</option>';
        }
        return $output;
    }

    public function download(Request $request){
        $file = Plan::select('file')
                ->where('spec_code', $request->spec_code)
                ->where('spec_name', $request->spec_name)
                ->where('prof', $request->prof)
                ->get();
        $filename = '';

        foreach ($file as $f){
            $filename.=$f->file; 
        }
        return $filename;
    }   
    public function downloadFinally($key){
        $arrayString= explode('.' ,$key);
        return Storage::disk('public')->download($key, "План".$arrayString[1]);
    }   

    public function store(Request $request){
   
         // Validation
        $request->validate([
           'spec_code' => 'required',
           'spec_name' => 'required',
           'prof' => 'required',
           'file' => 'required|mimes:png,jpg,jpeg,csv,txt,pdf,docx|max:2048',
        ]); 
   
        if($request->file('file')) {
            $file = $request->file('file');        
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('public', $filename);

            Session::flash('message','Upload Successfully.');
            Session::flash('alert-class', 'alert-success');
         
        }else{
            Session::flash('message','File not uploaded.');
            Session::flash('alert-class', 'alert-danger');
        }
        $data = array(
            "spec_code" => $request->spec_code,
            "spec_name" => $request->spec_name,
            "prof" => $request->prof,
            "file" => $filename
        );
        Plan::insert($data);
   
        return redirect()->back();
    }
}
