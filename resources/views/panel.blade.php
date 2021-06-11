@extends('layouts.app')

@section('content')

    <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">&nbsp;</h4>
                        
                    </div>
                    <p>&nbsp;</p>
                </div>
            </div>
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
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3">
                        &nbsp;
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="<?=url("/panel/myaccount");?>">
                          <div class="card card-hover">
                              <div class="box bg-warning text-center">
                                  <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                  <h6 class="text-white">All Tickets</h6>
                              </div>
                          </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="<?=url("/panel/addticket");?>">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                                <h6 class="text-white">Add New Ticket</h6>
                            </div>
                        </div>
                        </a>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        &nbsp;
                    </div>
                </div>


                <!-- END MODAL -->

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