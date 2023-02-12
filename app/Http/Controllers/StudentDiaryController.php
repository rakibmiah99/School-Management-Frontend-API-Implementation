<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class StudentDiaryController extends Controller
{
    function Page(Request $request){
        $response = Http::sms()->get('/admin/class-list');
        $subjects = Http::sms()->get('/admin/subject');
        if($response->status() === 200 && $subjects->status() === 200){
            $data['classes'] = $response->object();
            $data["activeMenu"] = "student";
            $data ['activePage'] = 'student-diary';
            $data ['title'] = 'Student Diary | School Management App';
            return view('pages.StudyMaterial.StudentDiary', $data);
        }
        else if($response->status() === 401 || $subjects->status() === 401){
            return redirect('/login');
        }
    }


    function GetAll(Request $request){
        $url = "/admin/student-diary?class_id={$request->class_id}&section_id={$request->section_id}&student_id={$request->student_id}";

        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
    }


    function Save(Request $request)
    {
        $response = Http::sms()->asForm()->post("/admin/student-diary/create" , $request->all());
        if($response->status() === 200){
            return [
                'status' => true,
                'message' => 'successfully added'
            ];
        }
        exit();
    }


    function Update(Request $request){
        $response = Http::sms()->asForm()->post("/admin/student-diary/update/".$request->id , $request->all());
        if($response->status() === 200){
            return [
                'status' => true,
                'message' => 'successfully Updated'
            ];
        }
        exit();

    }


    function Delete(Request $request){
        $url = "/admin/student-diary/delete/".$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }


    function GetSingle(Request $request){
        $id = $request->id;
        $url = "admin/student-diary/".$id;
        $response =  Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function GetStudents(Request $request){
        $url = "/student/SectionWiseStudentList?class={$request->class_id}&section={$request->section_id}";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }
}
