<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SecondReportAchivement;
use App\SecondReportCourses;
use App\SecondReportInternships;
use App\ReportCourses;
use App\ReportInternships;
use App\ReportActivity;
use App\ReportAchivement;
use App\SecondReportsStruc;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\Response;

//Courses

class SecondReportController extends Controller
{
    public function view_courses(){
        $courses = SecondReportCourses::all();
        return view('second_reports_courses', [
            'courses' => $courses
        ]);
    }

    public function delete_courses(Request $request){
        SecondReportCourses::where('id',$request->course_id)->delete();
        return redirect()->back();
    }
    public function insert_view_courses(Request $request){
        return view('second_reports_courses_insert');
    }
    public function store_courses(Request $request){
        // Validation

         $request->validate([
            'name' => 'required',
            'place' => 'required',
            'programm' => 'required',
            'subject' => 'required',
            'type' => 'required',
            'lang' => 'required',
            'date' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'year' => 'required',
            'certificate_no' => 'required',
            'certificate_picture' => 'required|mimes:png,jpg,jpeg|max:2048'
  
         ]); 
  

        if ($request->hasfile('certificate_picture')) {
            $image = $request->file('certificate_picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);

            Session::flash('message','Upload Successfully.');
            Session::flash('alert-class', 'alert-success');
        }else{
            Session::flash('message','File not uploaded.');
            Session::flash('alert-class', 'alert-danger');
        }

       $data = array(
        "name" => $request->name,
        "place" => $request->place,
        "programm" => $request->programm,
        "subject" => $request->subject,
        "type" => $request->type,
        "lang" => $request->lang,
        "date" => $request->date,
        "start_date" => $request->start_date,
        "end_date" => $request->end_date,
        "year" => $request->year,
        "certificate_no" => $request->certificate_no,
        "certificate_picture" => $filename

        );
        SecondReportCourses::insert($data);
  
        return redirect()->back();
    } 

    public function downloadSecondCourseslist(Request $request)
    {
        $reports = SecondReportCourses::where('year', $request->year)
                            ->get();
        // dd($students);
        $filename = 'курстар.csv';
        $handle = fopen('курстар.csv', 'w+');
        $columns = array('Оқытушының аты жөні', 'Тақырып атауы', 'Байқау атауы', 'Өткен жері', 'Байқау деңгейі', 'Алған орны', 'Өтілген уақыты', 'Жылы', 'Куәлік номері');
        fputcsv($handle, $columns);
        foreach ($reports as $report){    
            fputcsv($handle, array(
                                $report->name,
                                $report->place, 
                                $report->programm,
                                $report->subject,
                                $report->type,
                                $report->lang,
                                $report->date,
                                $report->start_date,
                                $report->end_date,
                                $report->year,
                                $report->certificate_no
                            )
                    );
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'курстар.csv', $headers);
    }

//Structure

    public function view_structure(){
        $reports = SecondReportsStruc::all();
        return view('second_reports_structure', [
            'reports' => $reports
        ]);
    }
    public function delete_structure(Request $request){
        SecondReportsStruc::where('id',$request->report_id)->delete();
        return redirect()->back();
    }
    public function insert_view_structure(Request $request){
        return view('second_reports_structure_insert');
    }
    public function store_reports_structure(Request $request){
        // Validation

        $request->validate([
            'name' => 'required',
            'sanat' => 'required',
            'sanat_start_date' => 'required',
            'sanat_end_date' => 'required',
            'certificate_no' => 'required',
            'certificate_picture' => 'required|mimes:png,jpg,jpeg|max:2048'

        ]); 


        if ($request->hasfile('certificate_picture')) {
            $image = $request->file('certificate_picture');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);

            Session::flash('message','Upload Successfully.');
            Session::flash('alert-class', 'alert-success');
        }else{
            Session::flash('message','File not uploaded.');
            Session::flash('alert-class', 'alert-danger');
        }

    $data = array(
        "name" => $request->name,
        "sanat" => $request->sanat,
        "sanat_start_date" => $request->sanat_start_date,
        "sanat_end_date" => $request->sanat_end_date,
        "certificate_no" => $request->certificate_no,
        "certificate_picture" => $filename,

    );
    SecondReportsStruc::insert($data);

    return redirect()->back();
    }
    
    public function downloadSecondStruclist(Request $request)
    {
        $strucs = SecondReportsStruc::where('sanat', $request->sanat)
                            ->get();
        // dd($students);
        $filename = 'санат.csv';
        $handle = fopen('санат.csv', 'w+');
        $columns = array('Оқытушының аты жөні', 'Санаты', 'Санаты берілген мерзімі', 'Санаты аяқталған мерзімі', 'Сертификат номері №');
        fputcsv($handle, $columns);
        foreach ($strucs as $struc){    
            fputcsv($handle, array(
                                $struc->name,
                                $struc->sanat, 
                                $struc->sanat_start_date,
                                $struc->sanat_end_date,
                                $struc->certificate_no
                            )
                    );
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'санат.csv', $headers);
    }

//Internship

    public function view_internships(){
        $internships = SecondReportInternships::all();
        return view('second_reports_internships', [
            'internships' => $internships
        ]);
    }

    public function delete_internships(Request $request){
        SecondReportInternships::where('id',$request->internship_id)->delete();
        return redirect()->back();
    }
    public function insert_view_internships(Request $request){
        return view('second_reports_internships_insert');
    }
    public function store_reports_internships(Request $request){
        // Validation

        $request->validate([
            'name' => 'required',
            'prof' => 'required',
            'place' => 'required',
            'employement' => 'required',
            'date' => 'required',
            'end_date' => 'required',
            'message' => 'required',
            'pic' => 'required|mimes:png,jpg,jpeg|max:2048',
            'year' => 'required',

        ]); 


        if ($request->hasfile('pic')) {
            $image = $request->file('pic');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);

            Session::flash('message','Upload Successfully.');
            Session::flash('alert-class', 'alert-success');
        }else{
            Session::flash('message','File not uploaded.');
            Session::flash('alert-class', 'alert-danger');
        }

    $data = array(
        "name" => $request->name,
        "prof" => $request->prof,
        "place" => $request->place,
        "employement" => $request->employement,
        "date" => $request->date,
        "end_date" => $request->end_date,
        "message" => $request->message,
        "pic" => $filename,
        "year" => $request->year

        );
        SecondReportInternships::insert($data);

        return redirect()->back();
    } 
    public function downloadSecondInternlist(Request $request)
    {
        $internships = SecondReportInternships::where('year', $request->year)
                            ->get();
        // dd($students);
        $filename = 'тағлымдама.csv';
        $handle = fopen('тағлымдама.csv', 'w+');
        $columns = array('Педагогтің тегі, аты, әкесінің аты', 'Тағылымдама өтілу мамандығы', 'Тағылымдама өтілу орны', 'Тағылымдама өтілу лауазымы', 'Тағылымдама өтілу мерзімі', 'Аяқталу мерзімі', 'Хаттама №', 'Жылы');
        fputcsv($handle, $columns);
        foreach ($internships as $internship){    
            fputcsv($handle, array(
                                $internship->name,
                                $internship->prof, 
                                $internship->place,
                                $internship->employement,
                                $internship->date,
                                $internship->end_date,
                                $internship->message, 
                                $internship->year
                            )
                    );
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'тағлымдама.csv', $headers);
    }
    
//Achivements

    public function view_achivements(){
        $achivements = SecondReportAchivement::all();
        return view('second_reports_achivements', [
            'achivements' => $achivements
        ]);
    }

    public function delete_achivements(Request $request){
        SecondReportAchivement::where('id',$request->achivement_id)->delete();
        return redirect()->back();
    }
    public function insert_view_achivements(Request $request){
        return view('second_reports_achivements_insert');
    }
    public function store_reports_achivements(Request $request){
        // Validation

        $request->validate([
            'name' => 'required',
            'topic' => 'required',
            'contest' => 'required',
            'place' => 'required',
            'year' => 'required',
            'level' => 'required',
            'date' => 'required',
            'win' => 'required',
            'id_no' => 'required',
            'diplom' => 'required|mimes:png,jpg,jpeg|max:2048'

        ]); 


        if ($request->hasfile('diplom')) {
            $image = $request->file('diplom');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);

            Session::flash('message','Upload Successfully.');
            Session::flash('alert-class', 'alert-success');
        }else{
            Session::flash('message','File not uploaded.');
            Session::flash('alert-class', 'alert-danger');
        }

        $data = array(
            "name" => $request->name,
            "topic" => $request->topic,
            "contest" => $request->contest,
            "place" => $request->place,
            "year" => $request->year,
            "level" => $request->level,
            "date" => $request->date,
            "win" => $request->win,
            "id_no" => $request->id_no,
            "diplom" => $filename

            );
            SecondReportAchivement::insert($data);

        return redirect()->back();
    }

    public function downloadSecondAchivelist(Request $request)
    {
        $achives = SecondReportAchivement::where('year', $request->year)
                            ->get();
        // dd($students);
        $filename = 'жетістіктер.csv';
        $handle = fopen('жетістіктер.csv', 'w+');
        $columns = array('Оқытушының аты жөні', 'Тақырып атауы', 'Байқау атауы', 'Өткен жері', 'Жылы', 'Байқау деңгейі', 'Алған орны', 'Өтілген уақыты', 'Куәлік');
        fputcsv($handle, $columns);
        foreach ($achives as $achive){    
            fputcsv($handle, array(
                                $achive->name,
                                $achive->topic, 
                                $achive->contest,
                                $achive->place,
                                $achive->year,
                                $achive->level,
                                $achive->date, 
                                $achive->win,
                                $achive->id_no
                            )
                    );
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'жетістіктер.csv', $headers);
    }
}
