<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Group;


class GroupController extends Controller
{
    public function index(){
        $groups = Group::all();

        return view('groups', [
            'groups'=>$groups
        ]);
    }
    public function get_insert_view(){
        return view('insert_group');
    }

    public function delete(Request $request){
        Group::where('id',$request->group_id)->delete();
        return redirect()->back();
    }

    public function insert(Request $request){  
        $this->validate($request, [
            "group" => 'required',
            "date" => 'required',
            "order" => 'required',
            "advisor" => 'required'
        ]);
        $data = array(
            "group" => $request->group,
            "date" => $request->date,
            "order" => $request->order,
            "advisor" => $request->advisor
        );
        Group::insert($data);
        return redirect()->back()->with('message', 'Енгізілді!');
    }
}
