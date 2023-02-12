<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Get Page
    public function Page(Request $request)
    {
        $response = Http::sms()->get("/admin/dashboard-report");


        if($response->status() === 401){
            return redirect('/login');
        }else{
            $data ['activeMenu'] = 'dashboard';
            $data ['activePage'] = 'dashboard';
            $data ['title'] = 'Dashboard | School Management App';
            $data ['count'] = $response->object();
            return view('pages.DashboardPage', $data);
        }

    }

    function Chart(){
        $startDate = strtotime('-100 days');
        $todayDate = strtotime('now');
        $formatStartDate = date('Y-m-d', $startDate);
        $formatTodayDate = date('Y-m-d', $todayDate);
        $chartUrl = "/admin/accounts-report?from_date={$formatStartDate}&to_date={$formatTodayDate}";
        $chartResponse = Http::sms()->get($chartUrl)->object();

        $labels = [];
        $incomes = [];
        $expense = [];
        foreach ($chartResponse as $item){
            $inc_ammount = ($item->inc_amount == null) ? 0 : $item->inc_amount;
            $exp_ammount = ($item->exp_amount == null) ? 0 : $item->exp_amount;
            array_push($labels ,$item->date);
            array_push($incomes, $inc_ammount);
            array_push($expense, $exp_ammount);
        }
        return response([
            'labels' => $labels,
            'incomes' => $incomes,
            'expense' => $expense
        ], 200);
    }


}
