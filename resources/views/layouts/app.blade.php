<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Customer Support Tickets Management Panel</title>
    <!-- Favicon icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/libs/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/libs/quill/dist/quill.snow.css')}}">
    
    <link href="{{ URL::to('assets/libs/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet" />
    <link href="{{ URL::to('assets/extra-libs/calendar/calendar.css')}}" rel="stylesheet" />
    <link href="{{ URL::to('dist/css/style.min.css')}}" rel="stylesheet">
    
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.3.3/css/select.bootstrap5.min.css" rel="stylesheet">
    


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
    .recentPost{
        background: #f1f1f16e;
        padding: 1.5rem;
        font-size: 14px;
        border-bottom: 1px solid #dad4d4;
        margin-bottom: .20em;
    }
    #example_wrapper{
        padding: 1.2rem;
    }
    .viewmorebtn{
        width: 100%;
    background: #f7f4f4;
    color: #000000;
    }
    .noteitem{
        display:none;
        padding: 10px;
        border-width: 0 1px 1px 0;
        border-style: solid;
        border-color: #fff;
        box-shadow: 0 1px 1px #ccc;
        margin-bottom: 5px;
    }
    .justify-content-center {
        margin:100px auto;
    }
    .betweensection{
        background: #ffffff;
        padding: 0rem;
        margin-bottom: 0rem;
    }
    .dashboard{
       border-radius: 5px;
		padding: 1rem;
		background: #a1c8f1;
		text-align: center;
		margin-top: 1rem;
		color: #000000;
		font-size: 2em;
	}
    ul#fileList {
        margin-bottom: .48rem;
        padding: 0;
    }
    #fileList li {
        list-style: none;
		background: #5f84e8;
		margin-bottom: .2rem;
		width: 100%;
		padding: 0.2rem;
		border-radius: 5px;
		text-align: center;
		font-size: 9px;
		font-weight: 700;
		color: #f9f9f9;
    }
	#assigned_length{
		display:none !important;
	}
	.welcomemessage {
		background: #000000;
		padding: .45rem;
		font-weight: bold;
		font-size: 10px;
		color: #f4f5f7;
	}
	.welcomemessage a {
		background: #2255a4;
		padding: 3px 14px;
		margin-left: 1rem;
		border-radius: 3px;
		color: #f9f9f9;
		text-transform: uppercase;
		font-size: 10px;
	}
</style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">

                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon ps-2">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ URL::to('assets/images/logo-icon.png')}}" alt="homepage" class="light-logo" />

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{ URL::to('assets/images/logo-text.png')}}" alt="homepage" class="light-logo" />

                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                        </li>
                        @else
                        
                        <li class="nav-item d-none d-lg-block"><a
                                class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item"> 
                            <a class="nav-link" href="<?=url("/panel/myaccount");?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i> <span class="hide-menu">Dashboard</span></a>
                        </li>

						<?php
						if($dynamic_agent_role != "admin")
						{
							?>
							<li class="nav-item"><a class="nav-link" href="<?=url("/panel/myaccount");?>">My Account</a></li>
							<?php
						}else{
							?>
							<li class="nav-item"><a class="nav-link" href="<?=url("/admin");?>">My Account</a></li>
							<?php
						}
						?>
                        @endguest
                        
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ==============================================================
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                                    class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li> -->
                    </ul>
                    @auth
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
					<div class="welcomemessage"> Welcome {{$dynamic_agent_name}} <a href="{{ route('signout') }}">Logout</a></div>
					<!--
                    <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <!--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-bell font-24"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                            <!-- Message 
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i
                                                            class="ti-calendar"></i></span>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0">Event today</h5>
                                                        <span class="mail-desc">Just a reminder that event</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message 
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i
                                                            class="ti-settings"></i></span>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0">Settings</h5>
                                                        <span class="mail-desc">You can customize this template</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message 
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i
                                                            class="ti-user"></i></span>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0">Pavan kumar</h5>
                                                        <span class="mail-desc">Just see the my admin!</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message 
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-danger btn-circle"><i
                                                            class="fa fa-link"></i></span>
                                                    <div class="ms-2">
                                                        <h5 class="mb-0">Luanch Admin</h5>
                                                        <span class="mail-desc">Just see the my new admin!</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ URL::to('assets/images/users/1.jpg')}}" alt="user" class="rounded-circle" width="31">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user me-1 ms-1"></i>
                                    My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet me-1 ms-1"></i>
                                    My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email me-1 ms-1"></i>
                                    Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i
                                        class="ti-settings me-1 ms-1"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i
                                        class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                                <div class="ps-4 p-10"><a href="javascript:void(0)"
                                        class="btn btn-sm btn-success btn-rounded text-white">View Profile</a></div>
                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== 
                    </ul> -->
                    @endauth
                </div>
                
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						@include('flash-message')
					</div>
				</div>
			</div>
            @yield('content')
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
              All Rights Reserved by CustomersPanel. Designed and Developed by <a
                  href="javascript:void(0);">CustomersPanel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        
        <!--<Model>-->
        
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ URL::to('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ URL::to('dist/js/jquery.ui.touch-punch-improved.js')}}"></script>
    <script src="{{ URL::to('dist/js/jquery-ui.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ URL::to('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    
    <script src="{{ URL::to('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{ URL::to('assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{ URL::to('dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{ URL::to('dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{ URL::to('dist/js/custom.min.js')}}"></script>
    <!-- this page js -->
    <script src="{{ URL::to('assets/libs/moment/min/moment.min.js')}}"></script>
    <script src="{{ URL::to('assets/libs/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <script src="{{ URL::to('dist/js/pages/calendar/cal-init.js')}}"></script>
    
    <script src="{{ URL::to('assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{ URL::to('dist/js/pages/mask/mask.init.js')}}"></script>
    <script src="{{ URL::to('assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{ URL::to('assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{ URL::to('assets/libs/quill/dist/quill.min.js')}}"></script>
    <script>
      $(".select2").select2();
      $('.select22').select2({
            dropdownParent: $('#addnewdipartment'),
            tags:true,
        }).on('select2:close', function(){
            var formdepartment = $("#department_id");
            var element = $(this);
            var name = $.trim(element.val());
        
            if(name != '')
            {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
              $.ajax({
                url:"{{ route('department.store') }}",
                method:"POST",
                data:{name:name},
                success:function(data)
                {
                  if(data == '1')
                  {
                    element.append('<option value="'+name+'">'+name+'</option>').val(name);
                    formdepartment.append('<option value="'+name+'">'+name+'</option>').val(name);
                  }
                  
                  $('#addnewdipartment').modal('hide');
                }
              })
            }
        
        });


        $("#input-ticket-number").prop('disabled', true);
        

        $("#input-order-number").on("keyup", function(){
          var myval = $(this).val();
          if(myval != ""){
            $('#input-user-type [value=existing_customer]').attr('selected', 'true');
          }else{
            $('#input-user-type [value=new_customer]').attr('selected', 'true');
          }
        });

        /*var quill = new Quill('#editor', {
            theme: 'snow'
        });
        var quill = new Quill('#editor2', {
            theme: 'snow'
        });*/
        
        $(document).ready(function() {
			$(".btn-success").click(function(){ 
              var lsthmtl = $(".clone").html();
              $(".increment").after(lsthmtl);
			});
			
			$("body").on("click",".btn-danger",function(){ 
				$(this).parents(".hdtuto").remove();
			});
          
			$('#example').DataTable( {
                select: true,
                pageLength : 5
            });
			$('#assigned').DataTable( {
                select: true,
				bFilter: false,
				paging: false,
				info:     false
            });
        });
        
        $("#input-order-number").on("change", function(e){
            e.preventDefault();
            $("#relatedOrderNUmber").html("<div class='col-md-12 recentPost'>Loading, please wait...</div>");
            
            var order_number = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('panel.request') }}",
                type:'POST',
                data: {order_number:order_number},
                success: function(response) {
                  $("#relatedOrderNUmber").html(response);
                }
            });
            
            return false;
        });
        
        $("#email").on("change", function(e){
            e.preventDefault();
            $("#relatedOrderNUmber").html("<div class='col-md-12 recentPost'>Loading, please wait...</div>");
            
            var email = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('panel.request') }}",
                type:'POST',
                data: {email:email},
                success: function(response) {
                  $("#relatedOrderNUmber").html(response);
                }
            });
            
            return false;
        });
        
        $("#phone-mask").on("change", function(e){
            e.preventDefault();
            $("#relatedOrderNUmber").html("<div class='col-md-12 recentPost'>Loading, please wait...</div>");
            
            var phone = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('panel.request') }}",
                type:'POST',
                data: {phone:phone},
                success: function(response) {
                  $("#relatedOrderNUmber").html(response);
                }
            });
            
            return false;
        });
        
        $("#department_id").on("change", function(e){
            e.preventDefault();
            var addnew = $(this).val();
            if(addnew == "new")
            {
                $('#addnewdipartment').modal('show');
            }else{
                $('#addnewdipartment').modal('hide');
            }
        });

        $('#assign').change(function(){
            var checked = $('#assign').is(':checked');
            if(checked){
                var id = $("#input-row-id").val();
                $('#ticketform').attr('action',"{{ route('panel.assign') }}");
                $("#agentlist").show("animate");
                $("#noupdate").remove();
            }
            else{
                $('#ticketform').attr('action',"{{ route('panel.store') }}");
                $("#agentlist").hide("animate");
            }
        });
        
        $('#status').change(function(){
            var selcetedval = $(this).val();
            if(selcetedval == "assign"){
                var id = $("#input-row-id").val();
                $('#ticketform').attr('action',"{{ route('panel.assign') }}");
                $("#agentlist").show("animate");
                $("#noupdate").remove();
            }
            else if(selcetedval == "open"){
                $('#btnsubmit').prop('disabled',false);
				$('input').prop('disabled',false);
				$('select').prop('disabled',false);
				$('textarea').prop('disabled',false);
				$('file').prop('disabled',false);
            }else{
                $('#ticketform').attr('action',"{{ route('panel.store') }}");
                $("#agentlist").hide("animate");
            }
        });
        
        $(function () {
            $(".noteitem").slice(0, 3).show();
            $("#loadMore").on('click', function (e) {
                e.preventDefault();
                $(".noteitem:hidden").slice(0, 5).slideDown();
                if ($(".noteitem:hidden").length == 0) {
                    $("#load").fadeOut('slow');
                }
                $('html,body').animate({
                    scrollTop: $(this).offset().top
                }, 900);
            });
        });
        
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('.totop a').fadeIn();
            } else {
                $('.totop a').fadeOut();
            }
        });
        
        updateList = function() {
          var input = document.getElementById('files');
          var output = document.getElementById('fileList');
        
          for (var i = 0; i < input.files.length; ++i) {
            output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
          }
        }

    </script>

</body>

</html>
