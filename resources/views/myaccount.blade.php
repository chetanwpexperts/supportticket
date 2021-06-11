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
                                        <!--<th scope="col">Phone</th>
                                        <th scope="col">Email</th>-->
                                        <th scope="col">Department</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($data as $ticket)
                                    {
                                        ?>
                                        @php
                                        $department = DB::table('departments')->select('name')->where('id', $ticket->department_id)->first();
                                        @endphp   
                                        <tr>
                                            <td><strong><?=$i;?></strong></td>
                                            <td><a href="{{ route('panel.show',['panel' => $ticket->ticket_number]) }}"><?=$ticket->ticket_number;?></a></td>
                                            <td><?=$ticket->order_number;?></td>
                                            <!--<td><?=$ticket->phone;?></td>
                                            <td><?=$ticket->email;?></td>-->
                                            <td><?=$department->name;?></td>
                                            <td><?=$ticket->subject;?></td>
                                            <td>
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Archive">
                                                    <i class="mdi mdi-archive"></i>
                                                </a>
                                            </td>
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