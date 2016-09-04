                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>HRIS System!</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="assets/templates/gentelella/images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>
                                <?=!empty($user_data[0]['nama']) ? ucwords(strtolower($user_data[0]['nama'])) : 'Unknown';?> 
                            </h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                </li>
                                <li><a><i class="fa fa-table"></i> Master <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.html">Master Jabatan</a></li>
                                        <li><a href="index2.html">Master OU</a></li>
                                        <li><a href="index3.html">Master Shift</a></li>
                                        <li><a href="index3.html">Master Golongan</a></li>
                                        <li><a href="index3.html">Master Agama</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-table"></i> Data Pegawai <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.html">Daftar Pegawai</a></li>
                                        <li><a href="index3.html">Daftar Keluarga</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i> Cuti & Absensi <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="form.html">Data Absen</a></li>
                                        <li><a href="form_advanced.html">Data Cuti</a></li>
                                        <li><a href="form_validation.html">Data Izin</a></li>
                                        <li><a href="form_wizards.html">Data Lembur</a></li>
                                        <li><a href="index2.html">Laporan</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-desktop"></i> Sosial Media <span class="fa fa-chevron-down"></span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3>System</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-bug"></i> Setting <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="projects.html">Master Module</a></li>
                                        <li><a href="projects.html">Master Perusahaan</a></li>
                                        <li><a href="projects.html">Master Negara</a></li>
                                        <li><a href="projects.html">Master Provinsi</a></li>
                                        <li><a href="project_detail.html">Master Kota</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-windows"></i> Akses Kontrol <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="page_404.html">Master User</a>
                                        </li>
                                        <li><a href="page_500.html">Master Aplikasi</a>
                                        </li>
                                        <li><a href="plain_page.html">User Akses</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                       

                    </div>

                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
<script type="text/javascript">
    $(document).ready(function(){
        // $("#sidebar-menu").niceScroll();
    })
</script>
