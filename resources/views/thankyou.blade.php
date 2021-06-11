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
                    <div class="jumbotron text-center">
                      <h1 class="display-3">Thank You!</h1>
                      <p class="lead"><strong>Ticket submited successfully</strong> for further updates on we will check the issue for you order.</p>
                      <hr>
                    
                      <p class="lead">
                          <?php
                          if($role == "admin")
                          {
                              ?>
                              <a class="btn btn-primary btn-sm" href="<?=url("/admin/");?>" role="button">Go To All Tickets</a>
                              <?php
                          }else{
                              ?>
                              <a class="btn btn-primary btn-sm" href="<?=url("/panel/addticket");?>" role="button">Add New Ticket</a>
                              <?php
                          }
                          ?>
                        
                      </p>
                    </div>
                </div>
            </div>
@endsection