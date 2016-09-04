@extends('templates.layouts.gentalella')
@section('content')
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Jejaring Sosial Kantor  <small>Realtime</small></h2>
                <div class="filter">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span> {{ Carbon\Carbon::today()->format('d M Y') }} </span> 
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="">

                        <!-- <h4>Recent Activity</h4> -->

                        <!-- end of user messages -->
                        <ul class="messages_sn status list-unstyled top_profiles scroll-view" style="min-height:500px;">
                            <li>
                                <img src="assets/templates/gentelella/images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                    <h3 class="date text-info">24</h3>
                                    <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                    <h4 class="heading">Desmond Davison</h4>
                                    <blockquote class="message">
                                        Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.
                                    <div class="attr_sn">
                                        <span><a href="#"><i class="fa fa-comment-o"></i> comment </a> | <a href="#"><i class="fa fa-thumbs-o-up"></i> like</a> | <a href="#"><i class="fa fa-thumbs-o-down"></i> dislike</a> </span>
                                        <span>13 hours ago</span>
                                    </div>
                            
                                    </blockquote>
                                    <br />
                                    <p class="url">
                                        <ul class="messages_sn list-unstyled">
                                            <li>
                                                <img src="assets/templates/gentelella/images/picture.jpg" class="avatar" alt="Avatar">
                                                <div class="message_wrapper">
                                                    <blockquote class="message">
                                                        <span><b>Desmond Davison. </b></span>
                                                        Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.                                                                
                                                        <div class="attr_sn">
                                                            <span><a href="#"><i class="fa fa-thumbs-o-up"></i> like</a> | <a href="#"><i class="fa fa-thumbs-o-down"></i> dislike</a> </span>
                                                            <span>13 hours ago</span>
                                                        </div>
                                                    </blockquote>                                                                        
                                                </div>
                                            </li>
                                            <li>
                                                <img src="assets/templates/gentelella/images/picture2.jpg" class="avatar" alt="Avatar">
                                                <div class="message_wrapper">
                                                    <blockquote class="message">
                                                        <span><b>Desmond Davison. </b></span>
                                                        Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.                                                                
                                                        <div class="attr_sn">
                                                            <span><a href="#"><i class="fa fa-thumbs-o-up"></i> like</a> | <a href="#"><i class="fa fa-thumbs-o-down"></i> dislike</a> </span>
                                                            <span>13 hours ago</span>
                                                        </div>
                                                    </blockquote>                                                                        
                                                </div>
                                            </li>
                                        </ul>
                                    </p>
                                </div>
                                <hr/>
                            </li>
                            <li>
                                <img src="assets/templates/gentelella/images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                    <h3 class="date text-error">21</h3>
                                    <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                    <h4 class="heading">Brian Michaels</h4>
                                    <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                    <br />
                                    <p class="url">
                                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                                        <a href="#" data-original-title="">Download</a>
                                    </p>
                                </div>
                            </li>
                            <li>
                                <img src="assets/templates/gentelella/images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                    <h3 class="date text-info">24</h3>
                                    <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                    <h4 class="heading">Desmond Davison</h4>
                                    <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                    <br />
                                    <p class="url">
                                        <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                        <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                    </p>
                                </div>
                            </li>
                        </ul>
                        <!-- end of user messages -->


                    </div>

                </div>

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div>
                        <div class="x_title">
                            <h2>Karyawan Online</h2>
                            <!-- <ul class="nav navbar-right panel_toolbox">
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
                            </ul> -->
                            <div class="clearfix"></div>
                        </div>
                        <ul class="list-unstyled top_profiles belang scroll-view" style="min-height:500px;">
                        <!-- <ul class="list-unstyled top_profiles scroll-view"> -->
                            <li class="media event">
                                <a class=" profile_pic_sn">
                                    <!-- <i class="fa fa-user aero"></i> -->
                                    <img src="assets/templates/gentelella/images/img.jpg" alt="..." class="img-circle profile_img_sn pull-left">
                                </a>
                                <div class="media-body">
                                    <a class="title" href="#">Msr. John</a>
                                    <p><strong>$2300. </strong> Agent Avarage Sales </p>
                                    <p> <small>12 Sales Today</small>
                                    </p>
                                </div>
                            </li>
                            <li class="media event">
                                <a class=" profile_pic_sn">
                                    <!-- <i class="fa fa-user aero"></i> -->
                                    <img src="assets/templates/gentelella/images/picture2.jpg" alt="..." class="img-circle profile_img_sn pull-left">
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

                    <!-- <meta name="_token" content="{{ app('Illuminate\Encryption\Encrypter')->encrypt(csrf_token()) }}" /> -->
                        <script>
                        /*        
                        $(document).ready(function(){
                            $.ajax({
                                type : 'POST',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                                url  : 'sn/store',
                                data : { mess_ori : "satu dua tiga" },
                                dataType  : 'json',
                                success: function(response) {
                                    console.log(response);    
                                }
                            });

                            // $('.scroll-view').niceScroll();
                            sn_status(true);

                        })


                        var timestamp_status = null;
                        function sn_status(pertama) {
                            //alert(pertama);
                            $.ajax({
                                type : 'GET',
                                url  : 'sn/read' ,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                                data : { timestamp : timestamp_status },
                                async : true,
                                cache : false,
                                success : function(data) {
                                            var json = eval('(' + data + ')');
                                            var id_chat;
                                            
                                            if(json['msg'] == ''){
                                                //$('#msg').html('No msg');
                                                console.log('nothing');                 
                                            }else { 
                                                console.log(json['msg']); 
                                                if(pertama) {
                                                    //do nothing;
                                                } else  {
                                                    if(json['jenis'] != ""){
                                                        $('#'+json['jenis']+' li:last-child').before(json['msg']);   
                                                    } else {
                                                        //console.log('_');
                                                        // $('#status_social_network li:eq(0)').after(json['msg']);
                                                    }
                                                    //$("#beepSound").play();

                                                   // _refresh(); 
                                           
                                                }
                                            }
                                            timestamp_status  = json['timestamp'];
                                            setTimeout('sn_status()', 1000);
                                },
                                error : function(XMLHttpRequest, textstatus, error) { 
                                            //alert('Error : '.error);
                                            setTimeout('sn_status()', 15000);
                                }                                                                                                                                                                                                                                                                                                                                           
                            });
                        }
                        */
                        </script>
@stop