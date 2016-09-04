
                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt=""> {{ ucFirst(Auth::user()->name) }}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="javascript:;">  Profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Help</a>
                                    </li>
                                    <li><a href="{{ URL::to('/') }}/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" rel="tooltip" title="Pengumuman">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="notif_umum_rianday" class="dropdown-menu list-unstyled msg_list animated fadeInDown notif_umum" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong><a href="inbox.html">See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>                            

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false"  rel="tooltip" title="Chats">
                                    <i class="fa fa-comments-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="notif_chats_rianday" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong><a href="inbox.html">See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>                            

                            <li role="presentation" class="dropd own">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" rel="tooltip" title="Social Media">
                                    <i class="fa fa-user"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="notif_sn_rianday" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                                <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                            </span>
                                            <span>
                                                <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where... 
                                                </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong><a href="inbox.html">See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                    Log in
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <!-- <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" rel="tooltip" title="Pengumuman">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a> -->
                                <ul id="notif_umum_rianday" class="dropdown-menu list-unstyled msg_list animated fadeInDown notif_umum" role="menu">
                                    <li>
                                        <div>
                                            <br />
                                            <form class="form-horizontal form-label-left input_mask" method="POST" action="{{ url('/login') }}">
                                                {{ csrf_field() }}

                                                <div class="col-xs-12 form-group has-feedback">
                                                    <input type="email" class="form-control has-feedback-left" name="email" placeholder="Email">
                                                    <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                                </div>

                                                <div class="col-xs-12 form-group has-feedback">
                                                    <input type="password" class="form-control has-feedback-left" name="password" placeholder="Password">
                                                    <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                                                </div>
                                                <div class="col-xs-12 form-group has-feedback">
                                                    <button type="submit" class="btn btn-primary pull-right">Login</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- <a>
                                            <span class="image">
                                                <img src="assets/templates/gentelella/images/img.jpg" alt="Profile Image" />
                                            </span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were where... 
                                            </span>
                                        </a> -->
                                    </li>
                                </ul>
                            </li>
                        @endif
                        </ul>
                    </nav>
                </div>
