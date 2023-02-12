<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PendingLeaveController extends Controller
{
    function Page(){
        $data['activePage'] = 'leave-pending';
        $data['activeMenu'] = 'leave';
        $data['title'] = 'Pending Leave Request | School Management App';
        return view('pages.Leave.Pending', $data);
    }

    function Get(Request $request){
        $criteria = $request->criteria;
        $url = "admin/pending-leave?criteria=".$criteria;
        $response = Http::sms()->get($url);
        if($response->status() === 200){
            return $response->object();
        }else{
            return $response->object();
        }
    }

    function Aprove(Request $request){
        $criteria = $request->criteria;
        $id = $request->id;
        $url = "admin/leave-approve?criteria={$criteria}&id={$id}";
        $response = Http::sms()->post($url);
        if($response->status() === 200){
            return $response->object();
        }
    }
}
