<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class StudentController extends Controller
{
    function Page(Request $request){

        $response = Http::sms()->get(env('API_URL').'/admin/class-list');
        $parents = Http::sms()->get('/parent-list');
        if($response->status() === 200){
            $data['classes'] = $response->object();
            $data['parents'] = $parents->object();
            $data['activeMenu'] = 'student';
            $data ['activePage'] = 'add-student';
            $data ['title'] = 'Add Student | School Management App';
            return view('pages.AddStudentPage', $data);
        }else if($response->status() === 401){
            return redirect('/login');
        }
    }


    function AddStudent(Request $request){
        $formData = [];
        foreach($request->all() as $key => $value){
            if($key != "_token"){
                if($key == "date_of_birth" && $value != null && $value != ""){
                    $date = explode("/", $value);
                    $formData[$key] = $date[2]."-".$date[1]."-".$date[0];
                }else{
                    $formData[$key] = $value;
                }
            }
        }



        $response = Http::sms()->asForm()->post('/register/student', $formData);
        if($response->status() === 201 || $response->status() === 200 ){
            return redirect('/student/add')->with("message", $response->object()->message);
        }else{
            return redirect('/student/add')->withInput()->with("message", "❌ Failed to add student");
        }
    }
}
