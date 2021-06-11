@php
$tic = $tickets[0];
@endphp

@extends('layouts.app')

@section('content')

<?php 
$old_agent = DB::table('intractions')->select('agent_id')->where('ticket_number', $tic->ticket_number)->limit(1)->orderBy('id', 'ASC')->first();
?>
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!--

            -->
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-1">
                        <div class="card">
                            <div class="card-body">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Ticket Information </h4>
                                <div class="row">
                                    <div class="col-md-12 recentPost">
                                        <small>Ticket Status</small><br />
                                        @php
                                        if($tic->open == 1)
                                        {
                                            echo "Open";
                                        }else if($tic->close == 1)
                                        {
                                            echo "Close";
                                        }
                                        @endphp
                                    </div>
                                    <div class="col-md-12 recentPost">
                                        <small>Department</small><br />
                                        @php
                                        $department = DB::table('departments')->select('name')->where('id', $tic->department_id)->first();
                                        @endphp
                                        {{$department->name}}
                                    </div>
                                    <div class="col-md-12 recentPost">
                                       <!--jS \o\f F Y-->
                                       @php
                                       $publish_date = date('jS \o\f F Y', strtotime($tic->created_at));
                                       $lastupdate = date('jS \o\f F Y', strtotime($tic->updated_at));
                                       @endphp
                                       <small>Submited</small><br />
                                       {{$publish_date}}
                                    </div>
                                    <div class="col-md-12 recentPost">
                                        <small>Last Update</small><br />
                                       {{$lastupdate}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Related Recent Tickets </h4>
                                <div class="row" id="relatedOrderNUmber">
                                    <div class="col-md-12 recentPost">
                                        No Information Avaiable
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Recent Tickets </h4>
                                <div class="row">
                                    @foreach($recent_tickets as $ticket)
                                        <div class="col-md-12 recentPost">
                                            <a href="{{ route('panel.show',['panel' => $ticket->ticket_number]) }}">#.{{$ticket->ticket_number}}</a> - {{ ucfirst($ticket->subject) }}
                                        </div>
                                    @endforeach
                                    <a href="{{ url('panel/myaccount')}}" class="btn viewmorebtn">View More</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-7">
                        <?php if($tic->close == 1){ ?>
                        <div class="card">
                           <div class="card-body">
                            <div class="alert alert-danger" role="alert">
                                  This Ticket now clsoed.
                             </div>
                            </div>
                        </div>
                        <?php 
                        }
                        ?>

                      <div class="card">
                        
                        <form class="form-horizontal" action="{{ route('panel.update', ['panel' => $tic->id]) }}" method="post" enctype="multipart/form-data" id="ticketform">
                           
                            {{csrf_field()}}
                            <div id="noupdate">
                            {{ method_field('PUT') }}
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Ticket-{{$tic->ticket_number}}</h4>
                                <div class="betweensection">
                                    <div class="row">
                                      <div class="col-4">
                                        <div class="form-group">
                                            <label for="input-order-number" class="col-sm-6 text-left control-label col-form-label">Order Number</label>
                                            <div class="col-sm-12">
                                                <input type="text" name="order_number" class="form-control" id="input-order-number" value="{{$tic->order_number}}" placeholder="Enter Order Number" required <?php echo ($tic->close==1) ? "disabled" : "";?>>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone-mask" class="col-sm-6 text-left control-label col-form-label">Contact No</label>
                                            <div class="col-sm-12">
                                                <input type="text" name="phone" class="form-control phone-inputmask" id="phone-mask" value="{{$tic->phone}}" placeholder="Enter Phone Number" required <?php echo ($tic->close==1) ? "disabled" : "";?>>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email" class="col-sm-6 text-left control-label col-form-label">Email</label>
                                            <div class="col-sm-12">
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{$tic->email}}" required <?php echo ($tic->close==1) ? "disabled" : "";?>>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                          <div class="form-group">
                                            <label for="input-call-type" class="col-sm-3 text-left control-label col-form-label">Call Type</label>
                                            <div class="col-sm-12">
                                              <select name="call_type" id="input-call-type" class="form-control form-control-alternative" <?php echo ($tic->close==1) ? "disabled" : "";?>>
                                                  <option>Select</option>
                                                  <option value="technical issue" <?php echo ($tic->call_type == "technical issue") ? "selected" : "";?>>Technical Issue</option>
                                                  <option value="sales issue" <?php echo ($tic->call_type == "sales issue") ? "selected" : "";?>>Sales</option>
                                                  <option value="shipment issue" <?php echo ($tic->call_type == "shipment issue") ? "selected" : "";?>>Shipment/Delivery</option>
                                                  <option value="replacement/refunds issue" <?php echo ($tic->call_type == "replacement/refunds issue") ? "selected" : "";?>>Replacement/Refunds</option>
                                                  <option value="installation help" <?php echo ($tic->call_type == "installation help") ? "selected" : "";?>>Installation Help</option>
                                                </select>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                            <label for="email1" class="col-sm-3 text-left control-label col-form-label">Department</label>
                                            <div class="col-sm-12">
                                              <select id="department_id" name="department_id" class="select2 form-select shadow-none"
                                                  style="width: 100%; height:36px;" <?php echo ($tic->close==1) ? "disabled" : "";?>>
                                                  <option>Select</option>
                                                  <?php 
                                                  foreach($data as $department)
                                                  {
                                                      ?>
                                                      <option value="<?=$department->id;?>" <?php echo ($tic->department_id == $department->id) ? "selected" : "";?>><?=$department->name;?></option>
                                                      <?php
                                                  }
                                                  ?>
                                                  <option value="new">Add New Department</option>
                                              </select>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="form-group">
                                            <label for="email1" class="col-sm-3 text-left control-label col-form-label">Product</label>
                                            <div class="col-sm-12">
                                              <select name="product_id" class="select2 form-select shadow-none"
                                                  style="width: 100%; height:36px;" <?php echo ($tic->close==1) ? "disabled" : "";?>>
                                                  <option>Select</option>
                                                  <?php 
                                                  foreach($product as $prd)
                                                  {
                                                      ?>
                                                      <option value="<?=$prd->id;?>" <?php echo ($tic->product_id == $prd->id) ? "selected" : "";?>><?=$prd->name;?></option>
                                                      <?php
                                                  }
                                                  ?>
                                                  
                                              </select>
                                            </div>
                                        </div>
                                      </div>
                                      <?php
                                      if($tic->close != 1)
                                      { ?>
                                      <div class="col-6">
                                        <div class="form-group">
                                            <label for="email1" class="col-sm-6 text-left control-label col-form-label">Assign To Other Agent</label>
                                            <div class="col-sm-12">
                                              <input id="assign" type="checkbox" name="assgin" value="1" /> 
                                            </div>
                                        </div>
                                      </div>
                                      
                                      <div class="col-6" id="agentlist" style="display:none;">
                                        <div class="form-group">
                                            <label for="email1" class="col-sm-3 text-left control-label col-form-label">Agents</label>
                                            <div class="col-sm-12">
                                              <select name="agent_id" class="select2 form-select shadow-none"
                                                  style="width: 100%; height:36px;" <?php echo ($tic->close==1) ? "disabled" : "";?>>
                                                  <option>Select</option>
                                                  <?php 
                                                  foreach($agents as $user)
                                                  {
                                                      ?>
                                                      <option value="<?=$user->id;?>"><?=$user->name;?></option>
                                                      <?php
                                                  }
                                                  ?>
                                                  
                                              </select>
                                            </div>
                                        </div>
                                      </div>
                                      <?php 
                              }?>
                                    </div>

                              </div>
                              
                              <?php
                              if($tic->close != 1)
                              { ?>
                              <h4 class="card-title">Notes</h4>
                              <div class="betweensection">
                            
                              <div class="row">
                                 <div class="col-12">
                                    <div class="form-group">
                                        <label for="input-subject" class="col-sm-3 text-left control-label col-form-label">Subject</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="subject" value="{{$tic->subject}}" class="form-control" id="input-subject" placeholder="Enter subject" required>
                                        </div>
                                    </div>
                                  </div>
                                 
                                  <div class="col-md-12">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                      <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-notes-tab" data-bs-toggle="pill" data-bs-target="#pills-notes" type="button" role="tab" aria-controls="pills-notes" aria-selected="true">Notes</button>
                                      </li>
                                      <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-internalnotes-tab" data-bs-toggle="pill" data-bs-target="#pills-internalnotes" type="button" role="tab" aria-controls="pills-internalnotes" aria-selected="false">Internal Notes</button>
                                      </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                      <div class="tab-pane fade show active" id="pills-notes" role="tabpanel" aria-labelledby="pills-notes-tab">
                                          <div class="col-10">
                                              <div class="card">
                                                  <div class="card-body-body">
                                                      
                                                      <!-- Create the editor container -->
                                                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="notes" value=""></textarea>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="tab-pane fade" id="pills-internalnotes" role="tabpanel" aria-labelledby="pills-internalnotes-tab">
                                          <div class="col-10">
                                              <div class="card">
                                                  <div class="card-body-body">
                                                      
                                                      <!-- Create the editor container -->
                                                      <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" name="internal_notes" value=""></textarea>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    </div>
                                </div> 
                            </div>

                            <h4 class="card-title">Attachments</h4>
                              <div class="betweensection">
                              <div class="row">
                                 <div class="col-12">
                                    <div class="form-group">
                                        <label for="input-file" class="col-sm-3 text-left control-label col-form-label">Attachment</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="file" class="form-control">
                                        </div>
                                        
                                    <!--<div class="input-group hdtuto control-group lst increment" >
                                      <input type="file" name="file[]" class="myfrm form-control">
                                      <div class="input-group-btn"> 
                                        <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                      </div>
                                    </div>
                                    <div class="clone hide">
                                      <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                        <input type="file" name="file[]" class="myfrm form-control">
                                        <div class="input-group-btn"> 
                                          <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                      </div>
                                    </div>
                                    </div>
                                  </div>-->
                                  
                                </div> 
                                <?php 
                                /*$newuserid = "";
                                $newagent = DB::table('intractions')->select('assignedTo')->where('ticket_number', $tic->ticket_number)->limit(1)->orderBy('id', 'DESC')->first();
                                if(count((array)$newagent) > 0)
                                {
                                    if($newagent->assignedTo == null)
                                    {
                                        $newuserid = "1";
                                    }else{
                                        $newuserid = $newagent->assignedTo;
                                    }
                                }*/
                                ?>
                                <input type="hidden" name="user_id" value="{{$tic->user_id}}" class="form-control" id="input-user-id">
                                <input type="hidden" name="id" value="{{$tic->id}}" class="form-control" id="input-row-id">
                                <input type="hidden" name="ticket_number" value="{{$tic->ticket_number}}" class="form-control">
                            </div>
                            </div>
                        </div>

                            <div class="col-12">
                            <div class="form-group">
                                <label class="col-sm-6 text-left control-label col-form-label">Close This Ticket</label>
                                <div class="col-sm-12">
                                  <input id="close" type="checkbox" name="close" value="1" /> 
                                </div>
                            </div>
                          </div>
                          
                            <div class="row">
                                  <div class="col-12">
                                    <button type="submit" class="btn btn-primary" <?php //echo ($old_agent->agent_id != $tic->user_id) ? "disabled" : "";?>>Submit</button>
                                    <p>&nbsp;</p>
                                 </div>
                            </div>
                            <?php 
                          }
                          ?>
                            <h4 class="card-title">Previous Notes</h4>
                            <div class="betweensection" style="border: 2px solid #EEE;padding: 1rem;">
                                <div class="row">
                                    <div class="col-12">
                                        <?php
                                        $i = 0;
                                        foreach($notes as $note)
                                        {
                                            $attachments = DB::table('ticket_attachments')->where('intraction_id',$note->id)->orderBy('created_at', 'DESC')->get();
                                            $agent = DB::table('users')->select('name')->where('id', $note->agent_id)->first();
                                            ?>
                                            @php
                                            $publish_date = date('jS \o\f F Y H:m:s', strtotime($note->created_at));
                                            $lastupdate = date('jS \o\f F Y H:m:s', strtotime($note->updated_at));
                                            @endphp
                                            <div class="form-group noteitem" style="border-bottom: 1px solid #cecece;padding-bottom: 1rem;">
                                                <label class="col-sm-8 text-left control-label col-form-label"><font color="#b7a4a4">{{$agent->name}}</font> <?php if( ( $note->assignedBy != 0 || $note->assignedBy != null ) && ( $note->assignedTo != 0 || $note->assignedTo != null ) )
                                                {
                                                    $agentBY = DB::table('users')->select('name')->where('id', $note->assignedBy)->first();
                                                    $agentTO = DB::table('users')->select('name')->where('id', $note->assignedTo)->first();
                                                     
                                                    ?>
                                                    has been transfered this issue to agent <strong><?=$agentTO->name;?></strong>.
                                                    <?php
                                                }
                                                ?>
                                                </label>
                                                
                                                <small style="float:right;"><i>{{$publish_date}}</i></small>
                                                <div class="col-sm-12">
                                                    <small>Notes: </small> 
                                                    &nbsp; &nbsp; {{$note->notes}}
                                                </div>
                                                <div class="col-sm-12" id="internalnotes">
                                                    <small>Internal Notes: </small> 
                                                    &nbsp; &nbsp; {{$note->internal_notes}}
                                                </div>
                                                <div class="col-sm-12" id="attachments">
                                                    <small>Attachments:  </small> 
                                                    <?php 
                                                    $path = storage_path('public/' . $attachments[0]->file);
                                                    $fileName = pathinfo($path, PATHINFO_FILENAME);
                                                    $extension = pathinfo($path, PATHINFO_EXTENSION);
                                                    ?>
                                                    <?php
                                                    if($attachments[0]->file == null){
                                                       echo "No Attachment";
                                                    }else{
                                                        ?>
                                                        <i class="mdi mdi-attachment font-24"></i> <a href="{{ asset('storage/'.$attachments[0]->file) }}" download><?=$fileName.".".$extension;?></a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                       ?>
                                    </div>
                                    <?php
                                    if($intractionCount > "5")
                                    {
                                        ?>
                                        <div class="col-12 text-center" style="margin-top:1rem"><a href="#" class="btn btn-secondary" id="loadMore">Load More</a></div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            
                        </form>
                      </div>
                      
                    </div>
                    
                </div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
@endsection
