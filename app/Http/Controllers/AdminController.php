<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\Addticket;
use App\Models\TicketAttachments;
use App\Models\Intractions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mail;


class AdminController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $user = auth()->user();
            $dynamic_agent_id = $user->id;
            $dynamic_agent_email = $user->email;
             $dynamic_agent_name = $user->name;
            $dynamic_agent_role = $user->role;
            $totalTickets = DB::table('addtickets')->count();
            $openTickets = DB::table('addtickets')->where('status','open')->count();
            $closeTickets = DB::table('addtickets')->where('status','close')->count();
            $alltickets = DB::table('addtickets')->get();
            return view('admin/index',compact('alltickets','totalTickets','openTickets','closeTickets','dynamic_agent_name','dynamic_agent_id','dynamic_agent_email','dynamic_agent_role'));
        }
        
        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
