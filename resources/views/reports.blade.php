@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">My Account</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" id="opencases">
                                <h5 class="card-title mb-0">Open Cases</h5>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Ticket Number</th>
                                        <th scope="col">Open Date</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Assigned To</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>123141</td>
                                        <td>25/05/2021</td>
                                        <td>30 Minutes</td>
                                        <td>Agent 1</td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>344532</td>
                                        <td>25/05/2021</td>
                                        <td>10 Minutes</td>
                                        <td>Agent 2</td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>345454</td>
                                        <td>25/05/2021</td>
                                        <td>15 Minutes</td>
                                        <td>Agent 3</td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card">
                            <div class="card-body" id="opencases">
                                <h5 class="card-title mb-0">Close Cases</h5>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Ticket Number</th>
                                        <th scope="col">Open Date</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Assigned To</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>22323</td>
                                        <td>22/04/2021</td>
                                        <td>10 Minutes</td>
                                        <td>Agent 1</td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12123</td>
                                        <td>23/03/2021</td>
                                        <td>10 Minutes</td>
                                        <td>Agent 2</td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12311</td>
                                        <td>25/03/2021</td>
                                        <td>10 Minutes</td>
                                        <td>Agent 3</td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                        </td>
                                    </tr>
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