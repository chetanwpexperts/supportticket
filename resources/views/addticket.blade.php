@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!--
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
                @php
                $randomString = rand(10000,9999999);
                @endphp
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
                                <div class="row">
                                    <div class="col-md-12">
                                       <a href="<?=url("/panel/addticket");?>" class="btn btn-default"> <i class="mdi mdi-plus"></i> Add New Ticket</a>
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
                                    <?php
                                    if(count($tickets) > 0)
                                    {
                                        ?>
                                        @foreach($tickets as $ticket)
                                            <div class="col-md-12 recentPost">
                                                <a href="{{ route('panel.show',['panel' => $ticket->ticket_number]) }}">#.{{$ticket->ticket_number}}</a> - {{ ucfirst($ticket->subject) }}
                                            </div>
                                        @endforeach
                                        <?php
                                        if($dynamic_agent_role != "admin"){
                                            ?>
                                            <a href="{{ url('panel/myaccount')}}" class="btn viewmorebtn">View More</a>
                                            <?php
                                        }else{
                                            ?>
                                            <a href="{{ url('/admin')}}" class="btn viewmorebtn">View More</a>
                                        <?php
                                        }
                                    }else{
                                        ?>
                                        <div class="col-md-12 recentPost">
                                            No Information Avaiable
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                      <div class="card">
                        <form class="form-horizontal" action="{{ route('panel.store') }}" method="post" enctype="multipart/form-data" id="ticketform">
                            {{csrf_field()}}
                            <div class="card-body">
                                <h4 class="card-title">Ticket</h4>
                                
                                <div class="betweensection">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="input-order-number" class="col-sm-4 text-left control-label col-form-label">Ticket Number</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" value="TIC{{$randomString}}" readonly disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="input-order-number" class="col-sm-4 text-left control-label col-form-label">Order Number</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="order_number" class="form-control" id="input-order-number" placeholder="Enter Order Number" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="customer_name" class="col-sm-4 text-left control-label col-form-label">Customer Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Enter Customer Name" required>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="email1" class="col-sm-3 text-left control-label col-form-label">Product</label>
                                                <div class="col-sm-9">
                                                  <select name="product_id" class="select2 form-select shadow-none"
                                                      style="width: 100%; height:36px;">
                                                      <option>Select</option>
                                                      <?php 
                                                      foreach($product as $prd)
                                                      {
                                                          ?>
                                                          <option value="<?=$prd->id;?>"><?=$prd->name;?></option>
                                                          <?php
                                                      }
                                                      ?>
                                                      
                                                  </select>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="phone-mask" class="col-sm-4 text-left control-label col-form-label">Contact No</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="phone" class="form-control phone-inputmask" id="phone-mask" placeholder="Enter Phone Number" required>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="col-6">
                                          <div class="form-group">
                                            <div class="row">
                                                <label for="input-call-type" class="col-sm-3 text-left control-label col-form-label">Call Type</label>
                                                <div class="col-sm-9">
                                                  <select name="call_type" id="input-call-type" class="form-control form-control-alternative">
                                                      <option>Select</option>
                                                      <option value="technical issue">Technical Issue</option>
                                                      <option value="sales issue">Sales</option>
                                                      <option value="shipment issue">Shipment/Delivery</option>
                                                      <option value="replacement/refunds issue">Replacement/Refunds</option>
                                                      <option value="installation help">Installation Help</option>
                                                    </select>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="email" class="col-sm-4 text-left control-label col-form-label">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      
                                      <div class="col-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="email1" class="col-sm-3 text-left control-label col-form-label">Assign</label>
                                                <div class="col-sm-9">
                                                  <!--<input id="assign" type="checkbox" name="assgin" value="1" />  -->
                                                  <select name="status" id="status" class="form-control form-control-alternative">
                                                      <option>Select</option>
                                                      <option value="open" selected>Open</option>
                                                      <option value="close">Close</option>
                                                      <option value="assign">Assign</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                        
                                        <!--<div class="col-6">
                                        <div class="form-group">
                                            <label for="email1" class="col-sm-3 text-left control-label col-form-label">Department</label>
                                            <div class="col-sm-12">
                                              <select id="department_id" name="department_id" class="select2 form-select shadow-none"
                                                  style="width: 100%; height:36px;">
                                                  <option>Select</option>
                                                  <?php
                                                  /*
                                                  foreach($data as $department)
                                                  {
                                                      ?>
                                                      <option value="<?=$department->id;?>"><?=$department->name;?></option>
                                                      <?php
                                                  }
                                                  */                                                  ?>
                                                  <option value="new">Add New Department</option>
                                              </select>
                                            </div>
                                        </div>
                                      </div> -->
                                        
                                      
                                      
                                      
                                      <div class="col-6" id="agentlist" style="display:none;">
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="email1" class="col-sm-4 text-left control-label col-form-label">Agents</label>
                                                <div class="col-sm-8">
                                                  <select name="agent_id" class="select2 form-select shadow-none"
                                                      style="width: 100%; height:36px;">
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
                                      </div>
                                      
                                    </div>

                              </div>
                              <div class="betweensection">
                              <div class="row">
                                 <div class="col-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="input-subject" class="col-sm-2 text-left control-label col-form-label">Subject</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="subject" value="" class="form-control" id="input-subject" placeholder="Enter subject" required>
                                            </div>
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
                                          <div class="col-12">
                                              <div class="card">
                                                  <div class="card-body-body">
                                                      
                                                      <!-- Create the editor container -->
                                                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="9" name="notes" value=""></textarea>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="tab-pane fade" id="pills-internalnotes" role="tabpanel" aria-labelledby="pills-internalnotes-tab">
                                          <div class="col-10">
                                              <div class="card">
                                                  <div class="card-body-body">
                                                      
                                                      <!-- Create the editor container -->
                                                      <textarea class="form-control" id="exampleFormControlTextarea2" rows="9" name="internal_notes" value=""></textarea>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="betweensection">
                                <div class="row">
                                    <div class="col-6">
                                        <ul id="fileList"></ul>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="input-file" class="col-sm-4 text-left control-label col-form-label">Attachment</label>
                                                <div class="col-sm-8">
                                                    <input type="file" name="file[]" id="files" class="form-control" multiple="true" onchange="javascript:updateList()">
                                                    <!-- <div class="input-group hdtuto control-group lst increment" >
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
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                         <input type="hidden" name="user_id" value="{{$dynamic_agent_id}}" class="form-control" id="input-user-id" placeholder="Enter subject" required>
                                        <input type="hidden" name="ticket_number" value="TIC{{$randomString}}" class="form-control">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                     </div>
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
            
            <div class="modal fade" id="addnewdipartment" tabindex="-1" aria-labelledby="addnewdipartment" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="input-add-department" class="col-sm-6 text-left control-label col-form-label">Department Name</label>
                                <div class="col-sm-12">
                                    <select id="input-add-department" name="name" class="select22 form-select shadow-none"
                                                  style="width: 100%; height:36px;">
                                    <option>Select</option>
                                      <?php 
                                      if(isset($data))
                                      {
                                          foreach($data as $department)
                                          {
                                              ?>
                                              <option value="<?=$department->id;?>"><?=$department->name;?></option>
                                              <?php
                                          }
                                      }
                                      ?>
                                      </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
@endsection