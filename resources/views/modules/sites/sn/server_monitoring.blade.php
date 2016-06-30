@extends('templates.layouts.gentalella')
@section('content')
                <!-- top tiles -->
                <div class="row tile_count">
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                            <div class="count">2500</div>
                            <span class="count_bottom"><i class="green">4% </i> From last Week</span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
                            <div class="count">123.50</div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
                            <div class="count green">2,500</div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
                            <div class="count">4,567</div>
                            <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
                            <div class="count">2,315</div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
                            <div class="count">7,325</div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
                        </div>
                    </div>

                </div>
                <!-- /top tiles -->

                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Office Social Network  <small>Realtime</small></h2>
                                    <div class="filter">
                                        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                        <canvas id="canvas000"></canvas>
                                        
                                    </div>

                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <div>
                                            <div class="x_title">
                                                <h2>Last Updated</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#">Settings 1</a>
                                                            </li>
                                                            <li><a href="#">Settings 2</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#"><i class="fa fa-close"></i></a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <ul class="list-unstyled top_profiles belang scroll-view" style="min-height:500px;">
                                            <!-- <ul class="list-unstyled top_profiles scroll-view"> -->
                                                <li class="media event">
                                                    <a class=" profile_pic_sn">
                                                        <!-- <i class="fa fa-user aero"></i> -->
                                                        <img src="assets/templates/gentelella/images/img.jpg" alt="..." class="img-circle profile_img pull-left">
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="title" href="#">Ms. Mary Jane</a>
                                                        <p><strong>$2300. </strong> Agent Avarage Sales </p>
                                                        <p> <small>12 Sales Today</small>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="media event">
                                                    <a class="pull-left border-green profile_thumb">
                                                        <i class="fa fa-user green"></i>
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="title" href="#">Ms. Mary Jane</a>
                                                        <p><strong>$2300. </strong> Agent Avarage Sales </p>
                                                        <p> <small>12 Sales Today</small>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="media event">
                                                    <a class="pull-left border-blue profile_thumb">
                                                        <i class="fa fa-user blue"></i>
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="title" href="#">Ms. Mary Jane</a>
                                                        <p><strong>$2300. </strong> Agent Avarage Sales </p>
                                                        <p> <small>12 Sales Today</small>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="media event">
                                                    <a class="pull-left border-aero profile_thumb">
                                                        <i class="fa fa-user aero"></i>
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="title" href="#">Ms. Mary Jane</a>
                                                        <p><strong>$2300. </strong> Agent Avarage Sales </p>
                                                        <p> <small>12 Sales Today</small>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="media event">
                                                    <a class="pull-left border-green profile_thumb">
                                                        <i class="fa fa-user green"></i>
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="title" href="#">Ms. Mary Jane</a>
                                                        <p><strong>$2300. </strong> Agent Avarage Sales </p>
                                                        <p> <small>12 Sales Today</small>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="media event">
                                                    <a class="pull-left border-green profile_thumb">
                                                        <i class="fa fa-user green"></i>
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="title" href="#">Ms. Mary Jane</a>
                                                        <p><strong>$2300. </strong> Agent Avarage Sales </p>
                                                        <p> <small>12 Sales Today</small>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="media event">
                                                    <a class="pull-left border-green profile_thumb">
                                                        <i class="fa fa-user green"></i>
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="title" href="#">Ms. Mary Jane</a>
                                                        <p><strong>$2300. </strong> Agent Avarage Sales </p>
                                                        <p> <small>12 Sales Today</small>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="media event">
                                                    <a class="pull-left border-green profile_thumb">
                                                        <i class="fa fa-user green"></i>
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="title" href="#">Ms. Mary Jane</a>
                                                        <p><strong>$2300. </strong> Agent Avarage Sales </p>
                                                        <p> <small>12 Sales Today</small>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="media event">
                                                    <a class="pull-left border-green profile_thumb">
                                                        <i class="fa fa-user green"></i>
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="title" href="#">Ms. Mary Jane</a>
                                                        <p><strong>$2300. </strong> Agent Avarage Sales </p>
                                                        <p> <small>12 Sales Today</small>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <meta name="_token" content="{{ app('Illuminate\Encryption\Encrypter')->encrypt(csrf_token()) }}" />
                        <script>
                        var lineChartData = {
                            labels: ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
                            datasets: [
                                {
                                    label: "My First dataset",
                                    fillColor: "rgba(38, 185, 154, 0.31)", //rgba(220,220,220,0.2)
                                    strokeColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
                                    pointColor: "rgba(38, 185, 154, 0.7)", //rgba(220,220,220,1)
                                    pointStrokeColor: "#fff",
                                    pointHighlightFill: "#fff",
                                    pointHighlightStroke: "rgba(220,220,220,1)",
                                    data: [0,0,0,0,0,0,0,0,0,0]
                            }
                        ]

                        }

                        $(document).ready(function(){
                            var test;
                            test = new Chart(document.getElementById("canvas000").getContext("2d")).Line(lineChartData, {
                                responsive: true,
                                tooltipFillColor: "rgba(51, 51, 51, 0.55)"
                            });
                            sn_status(test);
                        })


                        // var timestamp_status = null;
                        function sn_status(chart) {
                            // console.log(chart);
                            $.ajax({
                                type : 'GET',
                                url  : 'monitoring/get' ,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                                // data : { element : chart },
                                async : true,
                                cache : false,
                                success : function(data) {
                                        // console.log(chart);
                                            var json = eval('(' + data + ')');
                                            // test();
                                             // var test = new Chart(document.getElementById("canvas000").getContext("2d"));
                                                chart.removeData();
                                                //console.log(json['load']);
                                                chart.addData([json['load']] ,"google");
                                                //chart.addData(100 ,"google");

                                            // var id_chat;
                                            
                                            // if(json['msg'] == ''){
                                            //     //$('#msg').html('No msg');
                                            //     console.log('nothing');                 
                                            // }else { 
                                            //     console.log(json['msg']); 
                                            //     if(pertama) {
                                            //         //do nothing;
                                            //     } else  {
                                            //         if(json['jenis'] != ""){
                                            //             $('#'+json['jenis']+' li:last-child').before(json['msg']);   
                                            //         } else {
                                            //             //console.log('_');
                                            //             // $('#status_social_network li:eq(0)').after(json['msg']);
                                            //         }
                                            //         //$("#beepSound").play();

                                            //        // _refresh(); 
                                           
                                            //     }
                                            // }
                                            // timestamp_status  = json['timestamp'];
                                                setTimeout(function(){sn_status(chart)},5000);
                                            // setTimeout('sn_status('+chart+')', 1000);
                                },
                                error : function(XMLHttpRequest, textstatus, error) { 
                                            //alert('Error : '.error);
                                            setTimeout(function(){sn_status(chart)},15000);
                                            // setTimeout('sn_status('+chart+')', 15000);
                                }                                                                                                                                                                                                                                                                                                                                           
                            });
                        }

                        </script>
@stop