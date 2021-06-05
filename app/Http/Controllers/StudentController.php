<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Student;
use App\Group;
use App\Achivement;


class StudentController extends Controller
{
    public function index(){
        $students = Student::paginate(20);
        $groups = Group::all();

        return view('students', [
            'students'=>$students,
            'groups'=>$groups
        ]);
    }
    public function get_insert_view(){
        $groups = Group::all();

        return view('insert_student', [
            'groups'=>$groups
        ]);
    }
    public function get_achive_view(){
        $achives = Achivement::all();

        return view('achive_students', [
            'achives'=>$achives
        ]);
    }

    public function get_achive_insert_view(){
        $groups = Group::all();

        return view('achive_student_insert', [
            'groups'=>$groups
        ]);
    }

    public function delete(Request $request){
        Student::where('id',$request->student_id)->delete();
        return redirect()->back();
    }
    public function achive_delete(Request $request){
        Achivement::where('id',$request->achive_id)->delete();
        return redirect()->back();
    }

    public function insert(Request $request){  
        $this->validate($request, [
            "name" => 'required',
            "date" => 'required',
            "group" => 'required',
            "course" => 'required'
        ]);
        $data = array(
            "name" => $request->name,
            "date_birth" => $request->date,
            "groups" => $request->group,
            "course" => $request->course
        );
        Student::insert($data);
        return redirect()->back()->with('message', 'Енгізілді!');
    }

    public function achive_store(Request $request){  
        $this->validate($request, [
            "name" => 'required',
            "groups" => 'required',
            "advisor" => 'required',
            "shara" => 'required',
            "level" => 'required',
            "shara_name" => 'required',
            "period" => 'required',
            "achivement" => 'required'
        ]);
        $data = array(
            "name" => $request->name,
            "groups" => $request->groups,
            "advisor" => $request->advisor,
            "shara" => $request->shara,
            "level" => $request->level,
            "shara_name" => $request->shara_name,
            "period" => $request->period,
            "achivement" => $request->achivement
        );
        Achivement::insert($data);
        return redirect()->back()->with('message', 'Енгізілді!');
    }
    public function downloadStudentslist(Request $request)
    {
        $students = Student::where('groups', $request->group)
                            ->where('course', $request->course)
                            ->get();
        // dd($students);
        $filename = 'студенттер.csv';
        $handle = fopen('студенттер.csv', 'w+');
        $columns = array('Аты жөні', 'Туған күні', 'Тобы', 'Курс');
        fputcsv($handle, $columns);
        foreach ($students as $student){    
            fputcsv($handle, array(
                                $student->name,
                                $student->date_birth, 
                                $student->groups,
                                $student->course,
                            )
                    );
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'студенттер.csv', $headers);
    }
}
