@extends('templates.layouts.ng-gentalella')

@section('content')
    <!-- page content -->
    <div ng-controller="dataFormController">
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>User Profile</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
            </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>User Report <small>Activity report</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                            <div class="profile_img">

                                <!-- end of image cropping -->
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <div class="avatar-view" title="Change the avatar">
                                        {!! Html::image('images/profile/picture.jpg', 'Foto Profile') !!}
                                        <!-- <img src="images/picture.jpg" alt="Avatar"> -->
                                    </div>

                                    <!-- Cropping modal -->
                                    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
                                                    <div class="modal-header">
                                                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                                                        <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="avatar-body">

                                                            <!-- Upload image and data -->
                                                            <div class="avatar-upload">
                                                                <input class="avatar-src" name="avatar_src" type="hidden">
                                                                <input class="avatar-data" name="avatar_data" type="hidden">
                                                                <label for="avatarInput">Local upload</label>
                                                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                                                            </div>

                                                            <!-- Crop and preview -->
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <div class="avatar-wrapper"></div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="avatar-preview preview-lg"></div>
                                                                    <div class="avatar-preview preview-md"></div>
                                                                    <div class="avatar-preview preview-sm"></div>
                                                                </div>
                                                            </div>

                                                            <div class="row avatar-btns">
                                                                <div class="col-md-9">
                                                                    <div class="btn-group">
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="-15" type="button">-15deg</button>
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="-30" type="button">-30deg</button>
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button">-45deg</button>
                                                                    </div>
                                                                    <div class="btn-group">
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="15" type="button">15deg</button>
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="30" type="button">30deg</button>
                                                                        <button class="btn btn-primary" data-method="rotate" data-option="45" type="button">45deg</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <button class="btn btn-primary btn-block avatar-save" type="submit">Done</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="modal-footer">
                                      <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                                    </div> -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal -->

                                    <!-- Loading state -->
                                    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                                </div>
                                <!-- end of image cropping -->

                            </div>
                            <h3>Samuel Doe</h3>

                            <ul class="list-unstyled user_data">
                                <li><i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA
                                </li>

                                <li>
                                    <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
                                </li>

                                <li class="m-top-xs">
                                    <i class="fa fa-external-link user-profile-icon"></i>
                                    <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
                                </li>
                            </ul>

                            <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                            <br />

                            <!-- start skills -->
                            <h4>Skills</h4>
                            <ul class="list-unstyled user_data">
                                <li>
                                    <p>Web Applications</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>Website Design</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>Automation & Testing</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>UI / UX</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                    </div>
                                </li>
                            </ul>
                            <!-- end of skills -->

                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <!-- <div class="profile_title">
                                <div class="col-md-6">
                                    <h2>User Activity Report</h2>
                                </div>
                                <div class="col-md-6">
                                    <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                    </div>
                                </div>
                            </div> -->
                            <!-- start of user-activity-graph -->
                            <!-- <div id="graph_bar" style="width:100%; height:280px;"></div> -->
                            <!-- end of user-activity-graph -->

                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Change Password</a>
                                    </li>
                                    <!-- <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                                    </li> -->
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                        <!-- start recent activity -->
                                        <ul class="messages">
                                            <li>
                                                {!! Html::image('images/profile/img.jpg', 'Avatar', array('class' => 'avatar')) !!}
                                                <!-- <img src="images/img.jpg" class="avatar" alt="Avatar"> -->
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
                                            <li>
                                                {!! Html::image('images/profile/img.jpg', 'Avatar', array('class' => 'avatar')) !!}
                                                <!-- <img src="images/img.jpg" class="avatar" alt="Avatar"> -->
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
                                                {!! Html::image('images/profile/img.jpg', 'Avatar', array('class' => 'avatar')) !!}
                                                <!-- <img src="images/img.jpg" class="avatar" alt="Avatar"> -->
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
                                            <li>
                                                {!! Html::image('images/profile/img.jpg', 'Avatar', array('class' => 'avatar')) !!}
                                                <!-- <img src="images/img.jpg" class="avatar" alt="Avatar"> -->
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

                                        </ul>
                                        <!-- end recent activity -->

                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                                        <!-- start user projects -->
                                        <div class="col-md-12">
                                            <form name="frmMstPasswd" class="form-horizontal" novalidate="">
                                                <div ng-show="frmMstPasswd.show">
                                                    <div class="col-md-12">
                                                        <div class="form-group error" ng-class="{ 'has-error' : frmMstPasswd.current_password.$invalid && frmMstPasswd.current_password.$touched }">
                                                            <label for="inputCurrentPassword" class="col-md-3 control-label">Password</label>
                                                            <div class="col-md-4">
                                                                <!-- <div class="input-group"> -->
                                                                    <input type="password" class="form-control" name="current_password" ng-model="dataForm.passwd.current_password" required>
                                                                <!-- </div> -->
                                                            </div>
                                                            <span class="help-inline" ng-messages="frmMstPasswd.current_password.$error" ng-show="frmMstPasswd.current_password.$invalid && frmMstPasswd.current_password.$touched">
                                                                <ng-messages-include src="/assets/ng/views/etc/messages.html"></ng-messages-include>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group error" ng-class="{ 'has-error' : frmMstPasswd.password.$invalid && frmMstPasswd.password.$touched }">
                                                            <label for="inputCurrentPassword" class="col-md-3 control-label">New Password</label>
                                                            <div class="col-md-4">
                                                                <!-- <div class="input-group"> -->
                                                                    <input type="password" class="form-control" name="password" ng-model="dataForm.passwd.password" required>
                                                                <!-- </div> -->
                                                            </div>
                                                            <span class="help-inline" ng-messages="frmMstPasswd.password.$error" ng-show="frmMstPasswd.password.$invalid && frmMstPasswd.password.$touched">
                                                                <ng-messages-include src="/assets/ng/views/etc/messages.html"></ng-messages-include>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group error" ng-class="{ 'has-error' : frmMstPasswd.password_confirmation.$invalid && frmMstPasswd.password_confirmation.$touched }">
                                                            <label for="inputCurrentPassword" class="col-md-3 control-label">Confirm Password</label>
                                                            <div class="col-md-4">
                                                                <!-- <div class="input-group"> -->
                                                                    <input type="password" class="form-control" name="password_confirmation" ng-model="dataForm.passwd.password_confirmation" required ng-pattern="[[dataForm.passwd.password]]">
                                                                <!-- </div> -->
                                                            </div>
                                                            <span class="help-inline" ng-messages="frmMstPasswd.password_confirmation.$error" ng-show="frmMstPasswd.password_confirmation.$invalid && frmMstPasswd.password_confirmation.$touched">
                                                                <ng-messages-include src="/assets/ng/views/etc/messages.html"></ng-messages-include>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr/>
                                                        <div class="col-md-3"></div>
                                                        <div class="pull-left">
                                                            <button type="button" class="btn btn-default" ng-click="toggle('cancel',null)">Cancel</button>
                                                            <button type="button" class="btn btn-primary" id="btn-save" ng-click="setChangePassword()" ng-disabled="frmMstPasswd.$invalid">Save changes</button>
                                                            <!-- <button type="button" class="btn btn-primary" id="btn-save" ng-click="trace()" ng-disabled="frmMstPasswd.$invalid">Save changes</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div ng-show="!frmMstPasswd.show">
                                                    <div class="x_content bs-example-popovers">
                                                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" ng-click="frmMstPasswd.show = true;"><span aria-hidden="true">×</span>
                                                            </button>
                                                            Password <strong> Berhasil</strong> Disimpan
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                            </form>
                                        </div>
                                        <!-- end user projects -->

                                    </div>
                                    <!-- <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                        <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk </p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

{!! Html::script('assets/ng/controllers/sites/profile.min.js') !!}

@endsection
