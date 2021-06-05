<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Teacher;
use App\Prof;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    public function view(){
        $subjects = Subject::all();
        $profs = Prof::all();
        return view('subject', [
            'subjects' => $subjects,
            'profs' => $profs
        ]);
    }

    public function insert(){
        $teachers = Teacher::all();
        $profs = Prof::all();
        return view('subject_insert', [
            'teachers' => $teachers,
            'profs' => $profs
        ]);
    }

    public function store(Request $request){
   
        // Validation
       $request->validate([
          'course' => 'required',
          'speciality' => 'required',
          'subject' => 'required',
          'teacher' => 'required',
          'hours' => 'required',
          'semester' => 'required',
          'exam' => 'required'

       ]); 

       $data = array(
           "course" => $request->course,
           "speciality" => $request->speciality,
           "subject" => $request->subject,
           "teacher" => $request->teacher,
           "hours" => $request->hours,
           "semester" => $request->semester,
           "exam" => $request->exam

       );
       Subject::insert($data);
  
       return redirect()->back()->with('message', 'Енгізілді!');     
    }
    
    public function delete(Request $request){
        Subject::where('id', $request->subject_id)->delete();
        return redirect()->back();
    }

    public function downloadSubjectslist(Request $request)
    {
        $subjects = Subject::where('speciality', $request->speciality)
                            ->get();
        // dd($students);
        $filename = 'пәндер.csv';
        $handle = fopen('пәндер.csv', 'w+');
        $columns = array('Курс', 'Мамандық', 'Пән', 'Оқытушы', 'Сағат', 'Семестр', 'Экзамен түрі');
        fputcsv($handle, $columns);
        foreach ($subjects as $subject){    
            fputcsv($handle, array(
                                $subject->course,
                                $subject->speciality, 
                                $subject->subject,
                                $subject->teacher,
                                $subject->hours,
                                $subject->semester, 
                                $subject->exam,
                            )
                    );
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'пәндер.csv', $headers);
    }
   
}
