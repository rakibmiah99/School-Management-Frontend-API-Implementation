<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class SettingsPaymentsController extends Controller
{
    function Page(){
        $response = Http::sms()->get('/about-school');
        if($response->status() === 200){
            $data['activePage'] = 'settings-payments';
            $data['activeMenu'] = 'settings';
            $data['title'] = 'Payment Settings | School Management App';
            return view('pages.Settings.Payments', $data);
        }
        else if($response->status(401)){
            redirect('/login');
        }
    }
}
