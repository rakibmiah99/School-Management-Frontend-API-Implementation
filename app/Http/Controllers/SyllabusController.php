<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SyllabusController extends Controller
{
    function Page(Request $request){

        $classUrl = "/admin/class-list";
        $examTypeUlr = "/admin/exam";
        $classes = Http::sms()->get($classUrl);
        $exam_types = Http::sms()->get($examTypeUlr);

        if($classes->status() === 200 && $exam_types->status() === 200){
            $data["activeMenu"] = "study-material";
            $data ['activePage'] = 'syllabus';
            $data ['title'] = 'Upload Syllabus | School Management App';
            $data['classes'] = $classes->object();
            $data['exam_types'] = $exam_types->object();
            return view('pages.StudyMaterial.syllabus', $data);
        }else if($classes->status() === 401 || $exam_types->status() === 401){
            return redirect('/login');
        }
    }


    function GetSyllabus(Request $request){

        $url = "/admin/syllabus?class={$request->class_id}&exam={$request->exam_id}";
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }


    function Save(Request $request){
        $data = [
            'create_date' => $this->convertDate($request->submission_date),
            'title' => $request->title,
            'details' => $request->details,
            'class' => $request->class,
            'exam' => $request->exam,
            'file' => $request->file('file'),
        ];

        $fileName = $request->file->getClientOriginalName();

        $image = $request->file('file')->getRealPath();
        $url = "/admin/syllabus/create";
        $response = Http::sms()->attach('file', file_get_contents($image), $fileName)->post($url, $data);

        if($response->status() === 200){
            return $response->object();
        }
        else{
            return $response->object();
        }
    }

    function Edit(Request $request){
        $data = [
            'create_date' => $this->convertDate($request->submission_date),
            'title' => $request->title,
            'details' => $request->details,
            'class' => $request->class,
            'exam' => $request->exam,
            'file' => $request->file('file'),
        ];

        if($request->file('file') == null){
            $url = "/admin/syllabus/update/".$request->id;
            $response = Http::sms()->post($url, $data);
            if($response->status() === 200){
                return $response->object();
            }
            else{
                return $response->object();
            }
        }else{
            $fileName = $request->file->getClientOriginalName();

            $image = $request->file('file')->getRealPath();
            $url = "/admin/syllabus/update/".$request->id;
            $response = Http::sms()->attach('file', file_get_contents($image), $fileName)->post($url, $data);
            if($response->status() === 200){
                return $response->object();
            }
            else{
                return $response->object();
            }
        }
    }


    function Delete(Request $request){
        $url = '/admin/syllabus/delete/'.$request->id;
        $response = Http::sms()->delete($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }

    }

   function GetSingle(Request $request){

       $url = '/admin/syllabus/'.$request->id;
       $response = Http::sms()->get($url);
       if($response->status() === 200){
           return $response->object();
       }else{
           return $response->object();
       }
   }

    function convertDate($date){
        $d = explode("/", $date);
        return $d[2]."-".$d[1]."-".$d[0];
    }
}
