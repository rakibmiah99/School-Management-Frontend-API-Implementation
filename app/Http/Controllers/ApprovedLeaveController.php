<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ApprovedLeaveController extends Controller
{
    function Page(){
        $data['activePage'] = 'leave-approved';
        $data['activeMenu'] = 'leave';
        $data['title'] = 'Approve Leave Request | School Management App';
        return view('pages.Leave.Approved', $data);
    }

    function Get(Request $request){
        $criteria = $request->criteria;
        $url = "/admin/approved-leave?criteria=".$criteria;
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }

    function Deny(Request $request){
        $criteria = $request->criteria;
        $id = $request->id;
        $url = "/admin/leave-deny?criteria={$criteria}&id={$id}";
        $response = Http::sms()->post($url);
        if($response->status() === 200){
            return $response->object();
        }
    }
}
