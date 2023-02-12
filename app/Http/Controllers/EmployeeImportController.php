<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeImportController extends Controller
{
    function Page(){
        $data['activePage'] = 'add-employee';
        $data['activeMenu'] = 'employee';
        $data['title'] = 'Import Employee | School Management App';
        return view('pages.Employee.import' , $data);
    }


    function Save(Request $request){
        $data = [
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
        ];
        $fileName = $request->file('file')->getClientOriginalName();

        $url = "/employee/bulk-import";
        $response = Http::sms()->attach('file', $request->file('file'), $fileName )->post($url, $data);
        if ($response->status() === 200){
            return redirect('/employee/import')->with('message', $response->object()->message);
        }else{
            return redirect('/employee/import') ->with('message', $response->object()->message);
        }
    }
}
