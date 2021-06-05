<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reports;
use App\ReportCourses;
use App\ReportInternships;
use App\ReportActivity;
use App\ReportAchivement;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function index(){
        return view('reports');
    }

//Teacher Structures

    public function view_structure(){
        $reports = Reports::all();
        return view('reports_structure', [
            'reports' => $reports
        ]);
    }
    public function delete_structure(Request $request){
        Reports::where('id',$request->report_id)->delete();
        return redirect()->back();
    }
    public function insert_view_structure(Request $request){
        return view('reports_structure_insert');
    }
    public function store_reports_structure(Request $request){
        // Validation

         $request->validate([
            'name' => 'required',
            'sanat' => 'required',
            'sanat_start_date' => 'required',
            'sanat_end_date' => 'required',
            'certificate_no' => 'required',
            'certificate_picture' => 'required|mimes:png,jpg,jpeg|max:2048',
            'dareje' => 'required'
  
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
        "dareje" => $request->dareje

    );
        Reports::insert($data);
  
       return redirect()->back();
    } 
    public function downloadstructurelist(Request $request)
    {
        $reports = Reports::where('sanat', $request->sanat)
                            ->get();
        // dd($students);
        $filename = 'құрамы.csv';
        $handle = fopen('құрамы.csv', 'w+');
        $columns = array('Оқытушының аты жөні', 'Санаты', 'Санаты берілген уақыты', 'Санаты аяқталған уақыты', 'Куәлік номері № ', 'Ғылыми дәрежесі');
        fputcsv($handle, $columns);
        foreach ($reports as $report){    
            fputcsv($handle, array(
                                $report->name,
                                $report->sanat, 
                                $report->sanat_start_date,
                                $report->sanat_end_date,
                                $report->certificate_no,
                                $report->dareje,
                            )
                    );
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'құрамы.csv', $headers);
    }
     
//Teacher  Courses

    public function view_courses(){
        $courses = ReportCourses::all();
        return view('reports_courses', [
            'courses' => $courses
        ]);
    }

    public function delete_courses(Request $request){
        ReportCourses::where('id',$request->course_id)->delete();
        return redirect()->back();
    }
    public function insert_view_courses(Request $request){
        return view('reports_courses_insert');
    }
    public function store_reports_courses(Request $request){
        // Validation

         $request->validate([
            'name' => 'required',
            'place' => 'required',
            'programm' => 'required',
            'subject' => 'required',
            'type' => 'required',
            'lang' => 'required',
            'date' => 'required',
            'certificate_no' => 'required',
            'certificate_picture' => 'required|mimes:png,jpg,jpeg|max:2048',
            'year' => 'required'
  
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
        "certificate_no" => $request->certificate_no,
        "certificate_picture" => $filename,
        "year" => $request->year,

        );
        ReportCourses::insert($data);
  
        return redirect()->back();
    } 
    
    public function downloadCourselist(Request $request)
    {
        $reports = ReportCourses::where('year', $request->year)
                            ->get();
        // dd($students);
        $filename = 'Курстар.csv';
        $handle = fopen('Курстар.csv', 'w+');
        $columns = array('Оқытушының аты жөні', 'Өткен орны', 'Оқыту бағдарламасы', 'Пәні', 'Өтілу түрі', 'Оқыту түрі', 'Курстың өтілу уақыты, сағаты', 'Сертификат (грамота, диплом) номері №', 'Жылы');
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
                                $report->certificate_no,
                                $report->year,
                            )
                    );
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'Курстар.csv', $headers);
    }
    
//Teacher internships
    public function view_internships(){
        $internships = ReportInternships::all();
        return view('reports_internships', [
            'internships' => $internships
        ]);
    }

    public function delete_internships(Request $request){
        ReportInternships::where('id',$request->internships_id)->delete();
        return redirect()->back();
    }
    public function insert_view_internships(Request $request){
        return view('reports_internships_insert');
    }
    public function store_reports_internships(Request $request){
        // Validation

         $request->validate([
            'name' => 'required',
            'service' => 'required',
            'post' => 'required',
            'edu_received' => 'required',
            'message' => 'required',
            'date' => 'required',
            'place' => 'required'
         ]); 

       $data = array(
        "name" => $request->name,
        "service" => $request->service,
        "post" => $request->post,
        "edu_received" => $request->edu_received,
        "message" => $request->message,
        "date" => $request->date,
        "place" => $request->place

        );
        ReportInternships::insert($data);
  
        return redirect()->back()->with('message', 'Енгізілді!');
    } 
    public function downloadInternshipslist(Request $request)
    {
        $reports = ReportInternships::where('date', $request->year)
                            ->get();
        // dd($students);
        $filename = 'Тағылымдамалар .csv';
        $handle = fopen('Тағылымдамалар .csv', 'w+');
        $columns = array('Педагогтің тегі, аты, әкесінің аты', 'Қызметі', 'Тағылымдамадан өткен лауазымы', 'Алған біліктілігі', 'Хаттама', 'Жылы', 'Тағылымдама өтілу орны');
        fputcsv($handle, $columns);
        foreach ($reports as $report){    
            fputcsv($handle, array(
                                $report->name,
                                $report->service, 
                                $report->post,
                                $report->edu_received,
                                $report->message,
                                $report->date,
                                $report->place,
                            )
                    );
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'Тағылымдамалар .csv', $headers);
    }

//Teacher Activity
    
    public function view_activity(){
        $activity = ReportActivity::all();
        return view('reports_activity', [
            'activities' => $activity
        ]);
    }

    public function delete_activity(Request $request){
        ReportActivity::where('id',$request->activity_id)->delete();
        return redirect()->back();
    }
    public function insert_view_activity(Request $request){
        return view('reports_activity_insert');
    }
    public function store_reports_activity(Request $request){
        // Validation

        $request->validate([
            'name' => 'required',
            'topic' => 'required',
            'date' => 'required',
            'status' => 'required',
            'edition' => 'required'
        ]); 

    $data = array(
        "name" => $request->name,
        "topic" => $request->topic,
        "date" => $request->date,
        "status" => $request->status,
        "edition" => $request->edition

        );
        ReportActivity::insert($data);

        return redirect()->back()->with('message', 'Енгізілді!');
    } 
    
//Teacher Achivement

    public function view_achivements(){
        $achivements = ReportAchivement::all();
        return view('reports_achivements', [
            'achivements' => $achivements
        ]);
    }

    public function delete_achivements(Request $request){
        ReportAchivement::where('id',$request->achivement_id)->delete();
        return redirect()->back();
    }
    public function insert_view_achivements(Request $request){
        return view('reports_achivements_insert');
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
        ReportAchivement::insert($data);

        return redirect()->back();
    }
    public function downloadAchivementslist(Request $request)
    {
        $reports = ReportAchivement::where('year', $request->year)
                            ->get();
        // dd($students);
        $filename = 'жетістіктер.csv';
        $handle = fopen('жетістіктер.csv', 'w+');
        $columns = array('Оқытушының аты жөні', 'Тақырып атауы', 'Байқау атауы', 'Өткен жері', 'Байқау деңгейі', 'Алған орны', 'Өтілген уақыты', 'Жылы', 'Куәлік номері');
        fputcsv($handle, $columns);
        foreach ($reports as $report){    
            fputcsv($handle, array(
                                $report->name,
                                $report->topic, 
                                $report->contest,
                                $report->place,
                                $report->level,
                                $report->date,
                                $report->year,
                                $report->win,
                                $report->id_no,
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
