<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\SecondTeacher;


class SecondTeacherController extends Controller
{
    public function index(){
        $teachers = SecondTeacher::all();

        return view('second_teacher', [
            'teachers'=>$teachers
        ]);
    }
    public function get_insert_view(){
        return view('second_insert_teacher');
    }

    public function view($key){
        $teacher = SecondTeacher::where('id', '=', $key)->get();
        return view('second_view_teacher', [
            'teacher'=>$teacher
        ]);
    }

    public function view_update($key){
        $teacher = SecondTeacher::where('id', '=', $key)->get();
        return view('second_edit_teacher', [
            'teacher'=>$teacher
        ]);
    }

    public function update(Request $request){
        $this->validate($request, [
            "iin" => 'required',
            "surename" => 'required',
            "name" => 'required',
            "middle" => 'required',
            "birthday" => 'required',
            "gender" => 'required',
            "citizen" => 'required',
            "nation" => 'required',
            "responsibility" => 'required',
            "rank" => 'required',
            "work_type" => 'required',
            "academic_degree" => 'required',
            "educ" => 'required',
            "study" => 'required',
            "pre_work_history" => 'required',
            "curr_overall_history" => 'required',
            "curr_ped_history" => 'required',
            "overall_work_history" => 'required',
            "address" => 'required',
            "email" => 'required',
            "phone" => 'required',
            "sanat" => 'required',
            "edu_lang" => 'required',
            "english" => 'required'
        ]);

        SecondTeacher::where('iin', $request->iin)->update([
            'iin' => $request->iin,
            'last_name' => $request->surename,
            'first_name' => $request->name,
            'middle_name' => $request->middle,
            'date_birth' => $request->birthday,
            'gender' => $request->gender,
            'citizen' => $request->citizen,
            'other_citizen' => $request->other_citizen,
            'nation' => $request->nation,
            "other_nation" => $request->other_nation,
            'current_status' => $request->responsibility,
            'rank' => $request->rank,
            'type_of_busy' => $request->work_type,
            'academic_degree' => $request->academic_degree,
            'degree' => $request->educ,
            'studying' => $request->study,
            'pre_work_history' => $request->pre_work_history,
            'curr_overall_work_history' => $request->curr_overall_history,
            'curr_ped_work_history' => $request->curr_ped_history,
            'company_work_history' => $request->overall_work_history,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'sanat' => $request->sanat,
            'lang' => $request->edu_lang,
            'english_level' => $request->english
            ]);
        
        return redirect()->back()->with('message', 'Өзгертілді!');
    }
    
    public function delete(Request $request){
        SecondTeacher::where('id',$request->teacher_id)->delete();
        return redirect()->back();
    }

    public function insert(Request $request){  
        $this->validate($request, [
            "iin" => 'required',
            "surename" => 'required',
            "name" => 'required',
            "middle" => 'required',
            "birthday" => 'required',
            "gender" => 'required',
            "citizen" => 'required',
            "nation" => 'required',
            "responsibility" => 'required',
            "rank" => 'required',
            "work_type" => 'required',
            "academic_degree" => 'required',
            "educ" => 'required',
            "study" => 'required',
            "pre_work_history" => 'required',
            "curr_overall_history" => 'required',
            "curr_ped_history" => 'required',
            "overall_work_history" => 'required',
            "address" => 'required',
            "email" => 'required',
            "phone" => 'required',
            "sanat" => 'required',
            "edu_lang" => 'required',
            "english" => 'required'
        ]);
        $data = array(
            "iin" => $request->iin,
            "last_name" => $request->surename,
            "first_name" => $request->name,
            "middle_name" => $request->middle,
            "date_birth" => $request->birthday,
            "gender" => $request->gender,
            "citizen" => $request->citizen,
            "other_citizen" => $request->other_citizen,
            "nation" => $request->nation,
            "other_nation" => $request->other_nation,
            "current_status" => $request->responsibility,
            "rank" => $request->rank,
            "type_of_busy" => $request->work_type,
            "academic_degree" => $request->academic_degree,
            "degree" => $request->educ,
            "studying" => $request->study,
            "pre_work_history" => $request->pre_work_history,
            "curr_overall_work_history" => $request->curr_overall_history,
            "curr_ped_work_history" => $request->curr_ped_history,
            "company_work_history" => $request->overall_work_history,
            "address" => $request->address,
            "email" => $request->email,
            "phone" => $request->phone,
            "sanat" => $request->sanat,
            "lang" => $request->edu_lang,
            "english_level" => $request->english
        );
        SecondTeacher::insert($data);
        return redirect()->back()->with('message', 'Енгізілді!');
    }
}
