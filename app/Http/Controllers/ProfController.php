<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Prof;
use App\Group;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\Response;

class ProfController extends Controller
{
    public function view(){
        $profs = Prof::all();
        return view('profs', [
            'profs' => $profs
        ]);
    }

    public function insert(){
        $groups = Group::all();
        return view('profs_insert', [
            'groups' => $groups
        ]);
    }
    
    public function get_desc(Request $request){
        $names = Prof::select('description')->where('code', $request->code)->get();
        $output="";
        foreach ($names as $name) {
            $output.='<option>'.$name->description.'</option>';
        }
        return $output;
    }
    public function get_short(Request $request){
        $profs = Prof::select('short_name')->where('description', $request->description)->get();
        $output="";
        $output.='<option>'.'-'.'</option>';
        foreach ($profs as $prof) {
            $output.='<option>'.$prof->short_name.'</option>';
        }
        return $output;
    }
    public function get_group(Request $request){
        $profs = Prof::select('groups')->where('short_name', $request->short)->get();
        $output="";
        $output.='<option>'.'-'.'</option>';
        foreach ($profs as $prof) {
            $output.='<option>'.$prof->groups.'</option>';
        }
        return $output;
    }

    public function download(Request $request){
        $file = Prof::select('file')
                ->where('code', $request->code)
                ->where('description', $request->description)
                ->where('short_name', $request->short)
                ->where('groups', $request->group)
                ->get();
        $filename = '';

        foreach ($file as $f){
            $filename.=$f->file; 
        }
        return $filename;
    }   
    public function downloadFinally($key){
        $arrayString= explode('.' ,$key);
        return Storage::disk('public')->download($key, "Кесте".$arrayString[1]);
    }  
    public function store(Request $request){
        // Validation
        $request->validate([
            'code' => 'required',
            'description' => 'required',
            'short_name' => 'required',
            'groups' => 'required',
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
            "code" => $request->code,
            "description" => $request->description,
            "short_name" => $request->short_name,
            "groups" => $request->groups,
            "file" => $filename
        );
       Prof::insert($data);
  
       return redirect()->back();
     } 
}
