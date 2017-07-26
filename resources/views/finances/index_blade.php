<?php
 include_once('header_finance.php');
 ?>

 <?php
 //code that refereshes the page every 30 seconds
 $url1 = $_SERVER['REQUEST_URI'];
 header("Refresh: 30; URL=$url1");

 ?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="btn-group pull-right m-t-15">
                                    <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                                    <ul class="dropdown-menu drop-menu-right" role="menu">
                                        <li><a href="#">View Request</a></li>
                                        <li><a href="#">Manage Request</a></li>
                                        <li><a href="#">View Staff</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">View Transaction</a></li>
                                    </ul>
                                </div>

                                <h4 class="page-title">Dashboard</h4>
                                <p class="text-muted page-title-alt">Welcome to DAMS finance panel</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-lg-3" onclick="document.location='{{route('finances.pending')}}'">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon bg-icon-primary pull-left">
                                        <i class="md md-attach-file text-primary"></i>
                                    </div>
                                    <div class="text-right">
                                      @foreach($corders as $orde)
                                        <h3 class="text-dark"><b class="counter">{{$orde->order_count}}</b></h3>
                                        <?php session_start(); $_SESSION[''] = $orde->order_count; ?>
                                        <p class="text-muted">Pending Requests</p>
                                      @endforeach
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3" onclick="document.location='{{route('finances.items')}}'">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-pink pull-left">
                                        <i class="md md-add-shopping-cart text-pink"></i>
                                    </div>
                                    <div class="text-right">
                                      @foreach($items as $ite)
                                        <h3 class="text-dark"><b class="counter">{{$ite->item_count}}</b></h3>
                                        <p class="text-muted">Registered Assets</p>
                                      @endforeach
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3" onclick="document.location='{{route('finances.items')}}'">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-info pull-left">
                                        <i class="md md-equalizer text-info"></i>
                                    </div>
                                    <div class="text-right">
                                      @foreach($caorders as $caorder)
                                        <h3 class="text-dark"><b class="counter">{{$caorder->aorder_count}}</b></h3>
                                        <p class="text-muted">Approved Requests</p>
                                      @endforeach
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                         <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">View Request</h4>
                        <ol class="breadcrumb">
                            <li>
                                <a href="#">View All Requests</a>
                            </li>
                            <li class="active">
                                View Request
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Request Name</th>
                                    <th>Request Id</th>
                                    <th>Admin Status</th>
                                    <th>Finance Status</th>
                                    <th>Unit Head Status</th>
                                </tr>
                                </thead>


                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Genrator Set</td>
                                    <td>256353</td>
                                    <td>Approved</td>
                                    <td>Pending</td>
                                    <td>Pending</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Printer Set</td>
                                    <td>256523</td>
                                    <td>Pending</td>
                                    <td>Pending</td>
                                    <td>Pending</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Phone Set</td>
                                    <td>2563090</td>
                                    <td>Approved</td>
                                    <td>Approved</td>
                                    <td>Approved</td>
                                </tr>
                                 <tr>
                                    <td>4</td>
                                    <td>Phone Set</td>
                                    <td>2563090</td>
                                    <td>Approved</td>
                                    <td>Approved</td>
                                    <td>Approved</td>
                                </tr>
                                 <tr>
                                    <td>5</td>
                                    <td>Phone Set</td>
                                    <td>2563090</td>
                                    <td>Approved</td>
                                    <td>Approved</td>
                                    <td>Approved</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end row -->

<!-- Quick Staff View -->

 <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Staff</h4>
                        <ol class="breadcrumb">
                            <li>
                                <a href="#">View All Staff</a>
                            </li>
                            <li class="active">
                                Department Staff
                            </li>
                        </ol>
                    </div>
                </div>

<div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Staff ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                </tr>
                                </thead>


                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>DMN001</td>
                                    <td>Odegbaro Kunle</td>
                                    <td>t.testing@dreammesh.ng</td>
                                    <td>Programmer</td>
                                    <td>Developer Team</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>DMN002</td>
                                    <td>Odegbaro Kunle</td>
                                    <td>t.testing@dreammesh.ng</td>
                                    <td>Programmer</td>
                                    <td>Developer Team</td>
                                </tr>
                                <tr>
                                   <td>3</td>
                                    <td>DMN003</td>
                                    <td>Odegbaro Kunle</td>
                                    <td>t.testing@dreammesh.ng</td>
                                    <td>Programmer</td>
                                    <td>Developer Team</td>
                                </tr>
                                 <tr>
                                    <td>4</td>
                                    <td>DMN004</td>
                                    <td>Odegbaro Kunle</td>
                                    <td>t.testing@dreammesh.ng</td>
                                    <td>Programmer</td>
                                    <td>Developer Team</td>
                                </tr>
                                 <tr>
                                    <td>1</td>
                                    <td>DMN001</td>
                                    <td>Odegbaro Kunle</td>
                                    <td>t.testing@dreammesh.ng</td>
                                    <td>Programmer</td>
                                    <td>Developer Team</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->



            </div>



        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>

        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <script src="assets/plugins/peity/jquery.peity.min.js"></script>

        <!-- jQuery  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>



        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>

        <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

        <script src="assets/pages/jquery.dashboard.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });

                $(".knob").knob();

            });
        </script>


    </body>
</html>
