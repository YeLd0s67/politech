<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::post('/logout', 'Auth\LogoutController@store') -> name('logout');
Route::get('/login', 'Auth\LoginController@index') -> name('login');
Route::post('/login', 'Auth\LoginController@store');
Route::get('/register', 'Auth\RegisterController@index') -> name('register');
Route::post('/register', 'Auth\RegisterController@store');

Route::middleware(['zhuldyz'])->group(function () {

    Route::get('/teacher', 'TeacherController@index') -> name('teacher');
    Route::get('/teacher/insert_teacher', 'TeacherController@get_insert_view') -> name('insert_teacher');
    Route::post('/teacher/insert_teacher/send', 'TeacherController@insert') -> name('insert.send');

    Route::get('/teacher/view/{id}', 'TeacherController@view') -> name('view.teacher');
    Route::get('/teacher/edit/{id}', 'TeacherController@view_update') -> name('edit.teacher');
    Route::post('/teacher/update', 'TeacherController@update') -> name('update.teacher');
    Route::post('/teacher/delete', 'TeacherController@delete');

    Route::get('/plans', 'PlanController@view') -> name('plans');
    Route::get('/plans/insert', 'PlanController@insert') -> name('plans.insert');
    Route::post('/plans/store', 'PlanController@store') -> name('plans.store');
    Route::get('/plans/get_name', 'PlanController@get_name') -> name('plans.get.name');
    Route::get('/plans/get_prof', 'PlanController@get_prof') -> name('plans.get.prof');
    Route::get('/plans/download', 'PlanController@download') -> name('plans.download');
    Route::get('/plans/{file}', 'PlanController@downloadFinally');

    Route::get('/subjects', 'SubjectController@view') -> name('subjects');
    Route::get('/subjects/insert', 'SubjectController@insert') -> name('subjects.insert');
    Route::get('/subjects/get_list', 'SubjectController@downloadSubjectslist') -> name('subject.list');
    Route::post('/subjects/store', 'SubjectController@store') -> name('subjects.store');
    Route::post('/subjects/delete', 'SubjectController@delete');

    Route::get('/profs', 'ProfController@view') -> name('profs');
    Route::get('/profs/insert', 'ProfController@insert') -> name('profs.insert');
    Route::post('/profs/store', 'ProfController@store') -> name('profs.store');
    Route::get('/profs/get_name', 'ProfController@get_desc') -> name('profs.get.desc');
    Route::get('/profs/get_short', 'ProfController@get_short') -> name('profs.get.short');
    Route::get('/profs/get_group', 'ProfController@get_group') -> name('profs.get.group');
    Route::get('/profs/download', 'ProfController@download') -> name('profs.download');
    Route::get('/profs/{file}', 'ProfController@downloadFinally');

    Route::get('/groups', 'GroupController@index') -> name('groups');
    Route::get('/groups/insert_group', 'GroupController@get_insert_view') -> name('group.insert');
    Route::post('/groups/insert_group/send', 'GroupController@insert') -> name('group.store');
    Route::post('/groups/delete', 'GroupController@delete');

    Route::get('/students', 'StudentController@index') -> name('students');
    Route::get('/students/insert_student', 'StudentController@get_insert_view') -> name('student.insert');
    Route::get('/students/get_list', 'StudentController@downloadStudentslist') -> name('student.list');
    Route::get('/students/student_achives', 'StudentController@get_achive_view') -> name('student.achives');
    Route::get('/students/student_achives/insert', 'StudentController@get_achive_insert_view') -> name('student.achives.insert');
    Route::post('/students/student_achives/store', 'StudentController@achive_store') -> name('student.achives.store');
    Route::post('/students/insert_student/send', 'StudentController@insert') -> name('student.store');
    Route::post('/students/delete', 'StudentController@delete');
    Route::post('/achives/delete', 'StudentController@achive_delete');

    Route::get('/reports', 'ReportController@index') -> name('reports');

    Route::get('/reports/structure', 'ReportController@view_structure') -> name('reports.structure');
    Route::post('/reports/structure/delete', 'ReportController@delete_structure');
    Route::get('/reports/structure/insert', 'ReportController@insert_view_structure') -> name('reports.structure.insert');
    Route::post('/reports/structure/store', 'ReportController@store_reports_structure') -> name('reports.structure.store');
    Route::get('/reports/structure/get_list', 'ReportController@downloadstructurelist') -> name('reports.structure.list');

    Route::get('/reports/courses', 'ReportController@view_courses') -> name('reports.courses');
    Route::post('/reports/courses/delete', 'ReportController@delete_courses');
    Route::get('/reports/courses/insert', 'ReportController@insert_view_courses') -> name('reports.courses.insert');
    Route::post('/reports/courses/store', 'ReportController@store_reports_courses') -> name('reports.courses.store');
    Route::get('/reports/courses/get_list', 'ReportController@downloadCourselist') -> name('reports.courses.list');

    Route::get('/reports/internships', 'ReportController@view_internships') -> name('reports.internships');
    Route::post('/reports/internships/delete', 'ReportController@delete_internships');
    Route::get('/reports/internships/insert', 'ReportController@insert_view_internships') -> name('reports.internships.insert');
    Route::post('/reports/internships/store', 'ReportController@store_reports_internships') -> name('reports.internships.store');
    Route::get('/reports/internships/get_list', 'ReportController@downloadInternshipslist') -> name('reports.internships.list');

    Route::get('/reports/activity', 'ReportController@view_activity') -> name('reports.activity');
    Route::post('/reports/activity/delete', 'ReportController@delete_activity');
    Route::get('/reports/activity/insert', 'ReportController@insert_view_activity') -> name('reports.activity.insert');
    Route::post('/reports/activity/store', 'ReportController@store_reports_activity') -> name('reports.activity.store');

    Route::get('/reports/achivements', 'ReportController@view_achivements') -> name('reports.achivements');
    Route::post('/reports/achivements/delete', 'ReportController@delete_achivements');
    Route::get('/reports/achivements/insert', 'ReportController@insert_view_achivements') -> name('reports.achivements.insert');
    Route::post('/reports/achivements/store', 'ReportController@store_reports_achivements') -> name('reports.achivements.store');
    Route::get('/reports/achivements/get_list', 'ReportController@downloadAchivementslist') -> name('reports.achivements.list');
    
});


Route::middleware(['raushan'])->prefix('second')->group(function () {

    Route::get('/teacher', 'SecondTeacherController@index') -> name('second.teacher');
    Route::get('/teacher/insert_teacher', 'SecondTeacherController@get_insert_view') -> name('second.insert_teacher');
    Route::post('/teacher/insert_teacher/send', 'SecondTeacherController@insert') -> name('second.insert.send');

    Route::get('/teacher/view/{id}', 'SecondTeacherController@view') -> name('second.view.teacher');
    Route::get('/teacher/edit/{id}', 'SecondTeacherController@view_update') -> name('second.edit.teacher');
    Route::post('/teacher/update', 'SecondTeacherController@update') -> name('second.update.teacher');
    Route::post('/teacher/delete', 'SecondTeacherController@delete');

    Route::get('/employment', 'EmploymentController@index') -> name('employment');
    Route::get('/employment/insert', 'EmploymentController@get_insert_view') -> name('employment.insert');
    Route::post('/employment/store', 'EmploymentController@store') -> name('employment.store');
    Route::post('/employment/delete', 'EmploymentController@delete');

    Route::get('/courses', 'SecondReportController@view_courses') -> name('courses');
    Route::post('/courses/delete', 'SecondReportController@delete_courses');
    Route::get('/courses/insert', 'SecondReportController@insert_view_courses') -> name('courses.insert');
    Route::post('/courses/store', 'SecondReportController@store_courses') -> name('courses.store');
    Route::get('/courses/get_list', 'SecondReportController@downloadSecondCourseslist') -> name('courses.list');
    
    Route::get('/structure', 'SecondReportController@view_structure') -> name('structure');
    Route::post('/structure/delete', 'SecondReportController@delete_structure');
    Route::get('/structure/insert', 'SecondReportController@insert_view_structure') -> name('structure.insert');
    Route::post('/structure/store', 'SecondReportController@store_reports_structure') -> name('structure.store');
    Route::get('/structure/get_list', 'SecondReportController@downloadSecondStruclist') -> name('structure.list');

    Route::get('/internships', 'SecondReportController@view_internships') -> name('internships');
    Route::post('/internships/delete', 'SecondReportController@delete_internships');
    Route::get('/internships/insert', 'SecondReportController@insert_view_internships') -> name('internships.insert');
    Route::post('/internships/store', 'SecondReportController@store_reports_internships') -> name('internships.store');
    Route::get('/internships/get_list', 'SecondReportController@downloadSecondInternlist') -> name('internships.list');

    Route::get('/achivements', 'SecondReportController@view_achivements') -> name('achivements');
    Route::post('/achivements/delete', 'SecondReportController@delete_achivements');
    Route::get('/achivements/insert', 'SecondReportController@insert_view_achivements') -> name('achivements.insert');
    Route::post('/achivements/store', 'SecondReportController@store_reports_achivements') -> name('achivements.store');
    Route::get('/achivements/get_list', 'SecondReportController@downloadSecondAchivelist') -> name('achivements.list');
});