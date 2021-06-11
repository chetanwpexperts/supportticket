<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Addticket;
use App\Models\TicketAttachments;
use App\Models\Intractions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mail;

class PanelController extends Controller
{
    public function index()
    {
        return view('panel');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addticket', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo "<pre>";
        //print_r($request->input());
        // print_r($request->file); die;
       
        
        $request->validate([
            'file' => 'mimes:jpeg,jpg,png,gif,pdf,xlx,csv|max:2048',
        ]);
        
        $var = new Addticket();
        $varattachment = new TicketAttachments();
        
        $var->ticket_number = $request->input('ticket_number');
        $var->order_number = $request->input('order_number');
        $var->call_type = $request->input('call_type');
        $var->department_id = $request->input('department_id');
        $var->product_id = $request->input('product_id');
        $var->phone = $request->input('phone');
        $var->email = $request->input('email');
        $var->subject = $request->input('subject');
        $var->notes = $request->input('notes');
        $var->internal_notes = $request->input('internal_notes');
        $var->user_id = $request->input('user_id');
        $var->open = 1;
        $var->close = (null !== $request->input('close') ) ? $request->input('close'):0;
        $var->assign = 0;
        
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
            
            /*$files = [];
            if($request->hasfile('file'))
            {
                foreach($request->file('file') as $file)
                {
                    $name = time().'_'.$file->getClientOriginalName();
                    $filePath = $file->file('file')->storeAs('uploads', $name, 'public');
                    $files['ticket_number'] = $request->input('ticket_number');
                    $files['file'] = $filePath; 
                }
                
                $varattachment = new TicketAttachments();
                $varattachment->ticket_number = $files['ticket_number'];
                $varattachment->file = $files['file'];
                $varattachment->save();
            }*/
             
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
        }
        
        $arr = array(
            "mail_id"=> 7,
            "subject"=> $addticket->ticket_number,
            "body"=> $intraction->notes,
            "to"=>array(
                    array(
                        "email"=> $addticket->email,
                        "name" => ""
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

        return redirect()->route('panel.index')->with('success','Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recent_tickets = DB::table('addtickets')->limit(5)->orderBy('id', 'DESC')->get();
        $products = DB::table('products')->get();
        $agents = DB::table('users')->get();
        $product = $products;
        $departments = DB::table('departments')->get();
        $data = $departments;
        $tickets = DB::table('addtickets')->where('ticket_number',$id)->get();
        $notes = DB::table('intractions')->where('ticket_number',$id)->orderBy('created_at', 'DESC')->get();
        $intractionCount = count($notes);
        $attachments = DB::table('ticket_attachments')->where('ticket_number',$id)->orderBy('created_at', 'DESC')->get();
        return view('panel.show', compact('data','product','tickets','notes','recent_tickets','agents','attachments','intractionCount'));
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
            'file' => 'mimes:jpeg,jpg,png,gif,pdf,xlx,csv|max:2048',
        ]);
        
        $var = Addticket::find($id);
        $varattachment = new TicketAttachments();
        
        $var->ticket_number = $request->input('ticket_number');
        $var->order_number = $request->input('order_number');
        $var->call_type = $request->input('call_type');
        $var->department_id = $request->input('department_id');
        $var->product_id = $request->input('product_id');
        $var->phone = $request->input('phone');
        $var->email = $request->input('email');
        $var->subject = $request->input('subject');
        $var->notes = $request->input('notes');
        $var->internal_notes = $request->input('internal_notes');
        $var->user_id = $request->input('user_id');
        $var->close = (null !== $request->input('close') ) ? $request->input('close'):0;
        if($var->close == 1)
        {
            $var->open = 0;
        }else{
            $var->open = 1;
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
        
        /*$files = [];
        if($request->hasfile('file'))
        {
            foreach($request->file('file') as $file)
            {
                $name = time().'_'.$file->getClientOriginalName();
                $filePath = $file->file('file')->storeAs('uploads', $name, 'public');
                $files['ticket_number'] = $request->input('ticket_number');
                $files['file'] = $filePath; 
            }
            
            $varattachment = new TicketAttachments();
            $varattachment->ticket_number = $files['ticket_number'];
            $varattachment->file = $files['file'];
            $varattachment->save();
        }*/
         
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
        
        return redirect()->route('panel.index')->with('success','Ticket Updated Successfully.');
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
        $tickets = DB::table('addtickets')->get();
        $data = $tickets;
        return view('myaccount', compact('data'));
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
        $agents = DB::table('users')->get();
        $tickets = DB::table('addtickets')->limit(5)->orderBy('id', 'DESC')->get();
        $products = DB::table('products')->get();
        $product = $products;
        $departments = DB::table('departments')->get();
        $data = $departments;
        return view('addticket', compact('data','product','tickets','agents'));
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
        $realted_tickets = Addticket::orderBy('id','desc')->where([['order_number', "=", $request->input('order_number')],['close', "=", 0]])->get();
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
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assign(Request $request)
    {
        
        //echo "<pre>";
        // print_r($request->input()); die;
        
        $addticket = Addticket::find($request->input('id'));
        $varattachment = new TicketAttachments();
        
        
        $addticket->ticket_number = $request->input('ticket_number');
        $addticket->order_number = $request->input('order_number');
        $addticket->call_type = $request->input('call_type');
        $addticket->department_id = $request->input('department_id');
        $addticket->product_id = $request->input('product_id');
        $addticket->phone = $request->input('phone');
        $addticket->email = $request->input('email');
        $addticket->subject = $request->input('subject');
        $addticket->notes = $request->input('notes');
        $addticket->internal_notes = $request->input('internal_notes');
        $addticket->user_id = $request->input('agent_id');
        
        $addticket->close = (null !== $request->input('close') ) ? $request->input('close'):0;
        if($addticket->close == 0)
        {
            $addticket->open = 1;
        }else{
            $addticket->open = 0;
        }
        $addticket->assign = 1;
        
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
        
        Log::emergency("Notes: " . $intraction->notes . " - Agent");
        /*$files = [];
        if($request->hasfile('file'))
        {
            foreach($request->file('file') as $file)
            {
                $name = time().'_'.$file->getClientOriginalName();
                $filePath = $file->file('file')->storeAs('uploads', $name, 'public');
                $files['ticket_number'] = $request->input('ticket_number');
                $files['file'] = $filePath; 
            }
            
            $varattachment = new TicketAttachments();
            $varattachment->ticket_number = $files['ticket_number'];
            $varattachment->file = $files['file'];
            $varattachment->save();
        }*/
         
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
        
        $arr = array(
            "mail_id"=> 7,
            "subject"=> $addticket->ticket_number,
            "body"=> $intraction->notes,
            "to"=>array(
                    array(
                        "email"=> $addticket->email,
                        "name" => ""
                    ),
                    array(
                        "email"=> 'chetanwpexperts@gmail.com',
                        "name" => ""
                    ),
                    array(
                        "email"=> '19chetan87sharma@gmail.com',
                        "name" => ""
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

        return redirect()->route('panel.index')->with('success','Ticket is assigned to another agent successffully.');
    }
    
    public function getAgentName($id)
    {
        $agent = DB::table('users')->select('name')->where('id', $id)->first();
        return $agent->name;
    }
}
