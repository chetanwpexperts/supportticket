@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== 
            @php
            echo '<pre>';
            print_r($data);
            @endphp 
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
                    <div class="col-md-10" style="margin: auto;">
                        <div class="row" style="margin-top: 1rem;">
							<div class="col-md-6">
                              &nbsp;
							</div>
							<div class="col-md-6" style="text-align:right;position:relative;right:1rem;">
								<a href="<?=url("/panel/addticket");?>" class="btn btn-default"> <i class="mdi mdi-plus"></i> Add New Ticket</a>
							</div>
							<div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-0">Tickets {{$dynamic_agent_id}}</h4>
                            </div>
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col"><strong>#No.</strong></th>
                                        <th scope="col">Ticket Number</th>
                                        <th scope="col">Order Number</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
									$agent = "";
									$agenttext = "";
                                    foreach($data as $ticket)
                                    {
                                        $status = "";
                                        if($ticket->open == 1)
                                        {
                                            $status = "Open";
                                        }else if($ticket->close == 1)
                                        {
                                            $status = "Close";
                                        }else if($ticket->assign == 1)
                                        {
                                            $status = "Assigned";
                                        }
                                        ?>   
                                        <tr>
                                            <td><strong><?=$i;?></strong></td>
                                            <td><a href="{{ route('panel.show',['panel' => $ticket->ticket_number]) }}"><?=$ticket->ticket_number;?></a></td>
                                            <td><?=$ticket->order_number;?></td>
                                            <td><?=$ticket->call_type;?></td>
                                            <td><?=$ticket->subject;?></td>
                                            <td><?=$status;?></td>
                                        </tr>
										<?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
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