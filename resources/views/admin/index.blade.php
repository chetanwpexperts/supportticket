@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->

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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-0">Overview</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="dashboard">{{$totalTickets}} <br />Total Tickets</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="dashboard">{{$openTickets}} <br />Open Tickets</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="dashboard">{{$closeTickets}} <br />Close Tickets</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-0">Tickets</h4>
                            </div>
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col"><strong>#No.</strong></th>
                                        <th scope="col">Ticket Number</th>
                                        <th scope="col">Order Number</th>
                                        <th scope="col">Agent</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($alltickets as $ticket)
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
                                        $agent = DB::table('users')->select('name')->where('id', $ticket->user_id)->first();
                                        $product = DB::table('products')->select('name')->where('id', $ticket->product_id)->first();
                                        ?>   
                                        <tr>
                                            <td><strong><?=$i;?></strong></td>
                                            <td><a href="{{ route('panel.show',['panel' => $ticket->ticket_number]) }}"><?=$ticket->ticket_number;?></a></td>
                                            <td><?=$ticket->order_number;?></td>
                                            <td><?=$agent->name;?></td>
                                            <td><?=$product->name;?></td>
                                            <td><?=ucwords($ticket->call_type);?></td>
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