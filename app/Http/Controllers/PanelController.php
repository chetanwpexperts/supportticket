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

class PanelController extends Controller
{
    public $agent_id = "1";
    
    public function __contstruct()
    {
        $user = auth()->user();
        $this->agent_id = $user->id;
    }
    public function index()
    {
        if(Auth::check()){
            $user = auth()->user();
            $dynamic_agent_id = $user->id;
            $dynamic_agent_email = $user->email;
            $dynamic_agent_role = $user->role;
            $dynamic_agent_name = $user->name;
            if($dynamic_agent_role == "admin")
            {
                $totalTickets = DB::table('addtickets')->count();
                $openTickets = DB::table('addtickets')->where('status','open')->count();
                $closeTickets = DB::table('addtickets')->where('status','close')->count();
                $alltickets = DB::table('addtickets')->get();
                return view('admin/index',compact('dynamic_agent_name','dynamic_agent_id','dynamic_agent_email','dynamic_agent_role','alltickets','totalTickets','openTickets','closeTickets'));
            }else{
                return view('panel',compact('dynamic_agent_name','dynamic_agent_id','dynamic_agent_email','dynamic_agent_role'));
            }
        }
        
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            $user = auth()->user();
            $dynamic_agent_id = $user->id;
            $dynamic_agent_email = $user->email;
            $dynamic_agent_role = $user->role;
            $dynamic_agent_name = $user->name;
            return view('addticket', compact('dynamic_agent_name','dynamic_agent_id','dynamic_agent_email','dynamic_agent_role'));
        }
        
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file.*' => 'mimes:jpeg,jpg,png,gif,pdf,xlx,csv|max:2048',
        ]);
        
        $var = new Addticket();
        $varattachment = new TicketAttachments();
        
        $var->ticket_number = $request->input('ticket_number');
        $var->order_number = $request->input('order_number');
        $var->call_type = $request->input('call_type');
        $var->department_id = $request->input('department_id');
        $var->product_id = $request->input('product_id');
        $var->customer_name = $request->input('customer_name');
        $var->phone = $request->input('phone');
        $var->email = $request->input('email');
        $var->subject = $request->input('subject');
        $var->notes = $request->input('notes');
        $var->internal_notes = $request->input('internal_notes');
        $var->user_id = $request->input('user_id');
        $var->status = $request->input('status');
        if($var->status == "open")
        {
            $var->open = 1;
            $var->assign = 0;
            $var->close = 0;
        }else if($var->status == "close")
        {
            $var->close = 1;
            $var->open = 0;
            $var->assign = 0;
        }else if($var->status == "assign")
        {
            $var->assign = 1;
            $var->open = 0;
            $var->close = 0;
        }else{
            $var->open = 1;
            $var->assign = 0;
            $var->close = 0;
        }
        $var->save();
        
        $insertedId = $var->id;
        
        if($insertedId != "")
        {
            /**
             * add notes
             */
            $intraction = new Intractions();

            $intraction->ticket_number = $request->input('ticket_number');
            $intraction->notes = $request->input('notes');
            $intraction->internal_notes = $request->input('internal_notes');
            $intraction->agent_id = $request->input('user_id');
            $intraction->save();
            
            $intraction_id = $intraction->id;
            
            /**
             * file upload
             **/
            if($request->hasfile('file')) 
            {
                foreach($request->file('file') as $file)
                {
                    $fileName = time().'_'.$file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads', $fileName, 'public');
                    //$imgData[] = $fileName;
                    $imgData[] = $filePath;
                }
                
                $imagespath = json_encode($imgData);
                $varattachment->file = $imagespath;
                $varattachment->ticket_number = $request->input('ticket_number');
                $varattachment->intraction_id = $intraction_id;
                $varattachment->agent_id = $request->input('user_id');
                $varattachment->save();
            }
            /*
            if($request->file()) {
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
                $varattachment->file = $filePath;
            }else{
                $varattachment->file = null;
            }
            
            $varattachment->ticket_number = $request->input('ticket_number');
            $varattachment->intraction_id = $intraction_id;
            $varattachment->save();   
            */
        }
        $customer_email = $request->input('email');
        $customer_name = $request->input('customer_name');
        $notes = $request->input('notes');
        $agentname = DB::table('users')->select('name')->where('id', $request->input('user_id'))->first();
        $agentname = $agentname->name;
        $arr = array(
            "mail_id"=> 7,
            "subject"=> "#".$var->ticket_number."-". $request->input('subject'),
            "body"=> view('emails.thankyouemail',compact('customer_name', 'notes','agentname'))->render(),
            "to"=>array(
                    array(
                        "email"=> $request->input('email'),
                        "name" => $request->input('customer_name')
                    )
                )
        );
            
        $arr = json_encode($arr);
        
        $url = 'https://liveapps.face2friend.com/api/sendEmail';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return redirect()->route('panel.thankyou')->with('success','Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::check()){
            $user = auth()->user();
            if($user->role == "admin")
                $recent_tickets = DB::table('addtickets')->limit(5)->orderBy('id', 'DESC')->get();
            else
                $recent_tickets = DB::table('addtickets')->where('user_id',$user->id)->limit(5)->orderBy('id', 'DESC')->get();
            // $recent_tickets = DB::table('addtickets')->where('user_id',$user->id)->limit(5)->orderBy('id', 'DESC')->get();
            $products = DB::table('products')->get();
            $agents = DB::table('users')->where([['role', '!=', 'admin']])->get();
            $product = $products;
            $departments = DB::table('departments')->get();
            $data = $departments;
            $tickets = DB::table('addtickets')->where('ticket_number',$id)->get();
            $checkifticketassigned = DB::table('addtickets')->where('ticket_number',$id)->where('user_id',$user->id)->where('assign',1)->get();
            $checkifticketassignedtome = DB::table('intractions')->where('ticket_number',$id)->get();
            $assignedTicketsArr = array();
            $assignedToTicketsArr = array();
            foreach($checkifticketassignedtome as $assignedTickets)
            {
                if($assignedTickets->assignedBy != "")
                {
                    $assignedTicketsArr[] = $assignedTickets;
                }
                
                if($assignedTickets->assignedTo != "")
                {
                    $assignedToTicketsArr[] = $assignedTickets;
                }
            }
            $notes = DB::table('intractions')->where('ticket_number',$id)->orderBy('created_at', 'DESC')->get();
            $intractionCount = count($notes);
            $attachments = DB::table('ticket_attachments')->where('ticket_number',$id)->orderBy('created_at', 'DESC')->get();
            $atch = $attachments;
            $dynamic_agent_id = $user->id;
            $dynamic_agent_email = $user->email;
            $dynamic_agent_name = $user->name;
            $dynamic_agent_role = $user->role;
            return view('panel.show', compact('attachments','atch','dynamic_agent_name','dynamic_agent_role','assignedToTicketsArr','assignedTicketsArr','checkifticketassigned','dynamic_agent_id','dynamic_agent_email','data','product','tickets','notes','recent_tickets','agents','intractionCount'));
        }
        
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'file.*' => 'mimes:jpeg,jpg,png,gif,pdf,xlx,csv|max:2048',
        ]);
        
        $var = Addticket::find($id);
        $varattachment = new TicketAttachments();
        
        $var->ticket_number = $request->input('ticket_number');
        $var->order_number = $request->input('order_number');
        $var->call_type = $request->input('call_type');
        $var->department_id = $request->input('department_id');
        $var->product_id = $request->input('product_id');
        $var->customer_name = $request->input('customer_name');
        $var->phone = $request->input('phone');
        $var->email = $request->input('email');
        $var->subject = $request->input('subject');
        $var->notes = $request->input('notes');
        $var->internal_notes = $request->input('internal_notes');
        // $var->user_id = $request->input('user_id');
        $var->status = $request->input('status');
        if($var->status == "open")
        {
            $var->open = 1;
            $var->close = 0;
            $var->assign = 0;
        }else if($var->status == "close")
        {
            $var->open = 0;
            $var->close = 1;
            $var->assign = 0;
        }else if($var->status == "assign")
        {
            $var->assign = 1;
            $var->close = 0;
            $var->open = 0;
            
        }else{
            $var->open = 1;
            $var->assign = 0;
            $var->close = 0;
        }
        $var->save();
        /**
         * add notes
         */
        $intraction = new Intractions();
        
        $intraction->ticket_number = $request->input('ticket_number');
        $intraction->notes = $request->input('notes');
        $intraction->internal_notes = $request->input('internal_notes');
        $intraction->agent_id = $request->input('user_id');
        $intraction->save();
        
        $intraction_id = $intraction->id;
        
        /**
         * file upload
         **/
        if($request->hasfile('file')) 
        {
            foreach($request->file('file') as $file)
            {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                //$imgData[] = $fileName;
                $imgData[] = $filePath;
            }
            
            $imagespath = json_encode($imgData);
            $varattachment->file = $imagespath;
            $varattachment->ticket_number = $request->input('ticket_number');
            $varattachment->intraction_id = $intraction_id;
            $varattachment->agent_id = $request->input('user_id');
            $varattachment->save();
        }
        
        /* 
        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $varattachment->file = $filePath;
        }else{
                $varattachment->file = null;
        }
        
        $varattachment->intraction_id = $intraction_id;
        $varattachment->ticket_number = $request->input('ticket_number');
        $varattachment->save();
        */
        
        return redirect()->route('panel.thankyou')->with('success',"Ticket Updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function myAccount()
    {
        if(Auth::check()){
			$assignedtickets = array();
            $user = auth()->user();
            //$tickets = DB::table('addtickets')->where('user_id',$user->id)->get();
			//$assigned_tickets = DB::table('intractions')->where('assignedTo',$user->id)->get();
			//foreach($assigned_tickets as $ast)
			//{
				//$astickets = DB::table('addtickets')->where('ticket_number',$ast->ticket_number)->get();
				//$tickets = $astickets;
			//}
            //$data = $tickets;
			
			$tickets = Addticket::join('intractions', 'addtickets.ticket_number', '=', 'intractions.ticket_number')->groupBy('addtickets.ticket_number')
               ->get(['addtickets.*', 'intractions.*']);
			$data = $tickets;
            $dynamic_agent_id = $user->id;
            $dynamic_agent_email = $user->email;
            $dynamic_agent_role = $user->role;
            $dynamic_agent_name = $user->name;
            return view('myaccount', compact('assignedtickets','data','dynamic_agent_name','dynamic_agent_id','dynamic_agent_email','dynamic_agent_role'));
        }
        
         return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function reports()
    {
        return view('reports', []);
    }
    
    public function addTicket($id=null)
    {
        if($id != null)
        {
            echo "<pre>";
            print_r($id);
        }
        if(Auth::check()){
            $user = auth()->user();
            $agents = DB::table('users')->where([['role', '!=', 'admin']])->get();
            if($user->role == "admin")
                $tickets = DB::table('addtickets')->limit(5)->orderBy('id', 'DESC')->get();
            else
                $tickets = DB::table('addtickets')->where('user_id',$user->id)->limit(5)->orderBy('id', 'DESC')->get();
            $products = DB::table('products')->get();
            $product = $products;
            $departments = DB::table('departments')->get();
            $data = $departments;
            $dynamic_agent_id = $user->id;
            $dynamic_agent_role = $user->role;
            $dynamic_agent_name = $user->name;
            return view('addticket', compact('dynamic_agent_name','dynamic_agent_role','data','product','tickets','agents','dynamic_agent_id'));
        }
        
        return redirect("login")->withSuccess('You are not allowed to access');
    }
     
    public function showDepartmentName($id)
    {
        $package = Departments::find($id)
                         ->with('name')
                         ->where('id', $id)
                         ->first();
    
        return view('panel.show', compact('package'));
    }  
    
    public function ajaxRequest(Request $request)
    {
        $realted_tickets = Addticket::orderBy('id','desc')->where([
            ['order_number', "=", $request->input('order_number')]
            ])->orWhere([
                ['phone', "=", $request->input('phone')]
                ])->orWhere([
                    ['email', "=", $request->input('email')]
                    ])->get();
        if($realted_tickets->isEmpty())
        {
            ?>
            <div class="col-md-12 recentPost">
                No Information Found
            </div>
            <?php
        }else{
            foreach($realted_tickets as $rt)
            {
                ?>
                <div class="col-md-12 recentPost">
                    <a href="<?php echo route('panel.show',['panel' => $rt->ticket_number]);?>">#.<?=$rt->ticket_number;?></a> - <?=ucfirst($rt->subject);?>
                </div>
                <?php
            }
        }
        die;
        
    }
    
    public function ajaxFileUpload(Request $request)
    {
        echo "<pre>";
        print_r($_POST);
        print_r($request->file());
        die;
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assign(Request $request)
    {
        $addticket = Addticket::find($request->input('id'));
        $varattachment = new TicketAttachments();
        
        
        $addticket->ticket_number = $request->input('ticket_number');
        $addticket->order_number = $request->input('order_number');
        $addticket->call_type = $request->input('call_type');
        $addticket->department_id = $request->input('department_id');
        $addticket->product_id = $request->input('product_id');
        $addticket->customer_name = $request->input('customer_name');
        $addticket->phone = $request->input('phone');
        //customer_name
        $addticket->email = $request->input('email');
        $addticket->subject = $request->input('subject');
        $addticket->notes = $request->input('notes');
        $addticket->internal_notes = $request->input('internal_notes');
        // $addticket->user_id = $request->input('agent_id');
        $addticket->status = $request->input('status');
        if($addticket->status == "open")
        {
            $addticket->open = 1;
            $addticket->close = 0;
            $addticket->assign = 0;
        }else if($addticket->status == "close")
        {
            $addticket->open = 0;
            $addticket->close = 1;
            $addticket->assign = 0;
        }else if($addticket->status == "assign")
        {
            $addticket->assign = 1;
            $addticket->close = 0;
            $addticket->open = 0;
            
        }else{
            $addticket->open = 1;
            $addticket->assign = 0;
            $addticket->close = 0;
        }
        
        $result = $addticket->save();
        /**
         * add notes
         */
        $intraction = new Intractions();
        
        $intraction->ticket_number = $request->input('ticket_number');
        $intraction->notes = $request->input('notes');
        $intraction->internal_notes = $request->input('internal_notes');
        $intraction->agent_id = $request->input('user_id');
        $intraction->assignedTo = $request->input('agent_id');
        $intraction->assignedBy = $intraction->agent_id;
        $intraction->save();
        
        $intraction_id = $intraction->id;
        
        /**
         * file upload
         **/
        if($request->hasfile('file')) 
        {
            foreach($request->file('file') as $file)
            {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                //$imgData[] = $fileName;
                $imgData[] = $filePath;
            }
            
            $imagespath = json_encode($imgData);
            $varattachment->file = $imagespath;
            $varattachment->ticket_number = $request->input('ticket_number');
            $varattachment->intraction_id = $intraction_id;
            $varattachment->agent_id = $request->input('user_id');
            $varattachment->save();
        }
        
        /*
        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $varattachment->file = $filePath;
            
        }else{
            $varattachment->file = null;
        }
        $varattachment->ticket_number = $request->input('ticket_number');   
        $varattachment->intraction_id = $intraction_id;
        $varattachment->save();
        */
        
        $agentname = DB::table('users')->select('name')->where('id', $request->input('user_id'))->first();
        $agentemail = DB::table('users')->select('email')->where('id', $request->input('user_id'))->first();
        
        $arr = array(
            "mail_id"=> 7,
            "subject"=> $addticket->ticket_number,
            "body"=> $intraction->notes,
            "to"=>array(
                    array(
                        "email"=> $addticket->email,
                        "name" => $request->input('customer_name')
                    ),
                    array(
                        "email"=> $agentemail->email,
                        "name" => $agentname->name
                    ),
                    array(
                        "email"=> 'sharmamanoj78@gmail.com',
                        "name" => "Admin"
                    )
                )
        );
            
        $arr = json_encode($arr);
        
        $url = 'https://liveapps.face2friend.com/api/sendEmail';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return redirect()->route('panel.thankyou')->with('success','Ticket is assigned to another agent successffully.');
    }
    
    public function getAgentName($id)
    {
        $agent = DB::table('users')->select('name')->where('id', $id)->first();
        return $agent->name;
    }
    
    public function thankyou()
    {
        if(Auth::check()){
            $user = auth()->user();
            $role = $user->role;
            $dynamic_agent_role = $role;
            $dynamic_agent_id = $user->id;
            $dynamic_agent_name = $user->name;
            $dynamic_agent_email = $user->email;
            
            return view('thankyou', compact('role','dynamic_agent_name','dynamic_agent_id','dynamic_agent_email','dynamic_agent_role'));
        }
        
        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
