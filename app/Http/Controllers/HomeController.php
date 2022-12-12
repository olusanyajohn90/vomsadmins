<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Vehicle;
use App\Models\Admin\Certificate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $userid = Auth::id();
        $user = Auth::user()->id;
        // dd($user);

    $userstate = DB::table('users')->where('id', $user)-> first();


        //   dd($userstate);
        $sumvehicles = Vehicle::where('registration_state_id',$userstate->state_id)->count();
        $sumcertificates = Certificate::where('issue_state_id',$userstate->state_id)->count();
        $awaitinglicence = Certificate::where('issue_state_id',$userstate->state_id)->wherelicense_plate("Not Yet Assigned")->count();
        //    dd($sumcertificates);










         return view('admin.dashboard.all', compact('sumvehicles', 'sumcertificates', 'awaitinglicence'));
        // return view('admin.dashboard.all');
    }

    public function adminHome()
    {
        return view('admin.dashboard.all');
    }


}
