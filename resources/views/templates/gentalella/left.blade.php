<?php
    // print_r(Auth::user());
?>
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-users"></i> <span>RADIS</span></a>
                    
                    </div>
                    <div class="clearfix"></div>
                    @if(Auth::check())
                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="{{ URL::to('/') }}/assets/templates/gentelella/images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,  </span>
                            <h2>
                            {{ Auth::user()->name }}
                            </h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->
                    @endif
                    <br />
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
{{-- {!! $MyNavBar->asUl() !!} --}}
                        <?php $items = !empty($MyNavBar) ? $MyNavBar->roots() : null; ?>
  
                        @if(!empty($items))
                        @foreach($items as $item)
                            <?php //print_r($item)?>
                            <div class="menu_section">
                                <h3>{!! $item->title !!}</h3>
                                @if($item->hasChildren())
                                    <ul class="nav side-menu">
                                    <?php $childrens =  $item->children(); ?> 
                                    @foreach($childrens as $children)
                                        <li><a @if(!$children->hasChildren()) href="{!! $children->url() !!}" @endif>{!! $children->title !!} @if($children->hasChildren()) <span class="fa fa-chevron-down"></span> @endif</a>
                                        @if($children->hasChildren())
                                            <ul class="nav child_menu" style="display: none">
                                            <?php $grandChildrens =  $children->children(); ?> 
                                            @foreach($grandChildrens as $grandChildren)
                                                <li><a href="{!! $grandChildren->url() !!}">{!! $grandChildren->title !!}</a></li>
                                            @endforeach
                                            </ul>
                                        @endif
                                    @endforeach
                                    </ul>
                                 @endif
                            </div>
                        @endforeach
                        @endif
<!--
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="/"><i class="fa fa-home"></i> Home</a>
                                </li>
                                <li><a><i class="fa fa-bank"></i> Company Profile <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.html">Sejarah</a></li>
                                        <li><a href="index2.html">Struktur Organisasi</a></li>
                                        <li><a href="index2.html">Peraturan Perusahaan</a></li>
                                        <li><a href="index3.html">...</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-navicon"></i> Serabutan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.html">Download</a></li>
                                        <li><a href="index2.html">Gallery</a></li>
                                        <li><a href="index2.html">Event</a></li>
                                        <li><a href="index2.html">Extension</a></li>
                                        <li><a href="index3.html">...</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3>JAGO</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-table"></i> Master <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.html">SDM</a></li>
                                        <li><a href="index2.html">Iklan</a></li>
                                        <li><a href="index3.html">Sirkulasi</a></li>
                                        <li><a href="index3.html">Keuangan</a></li>
                                        <li><a href="index3.html">Akunting</a></li>
                                        <li><a href="index3.html">Umum</a></li>
                                        <li><a href="index3.html">Promosi</a></li>
                                        <li><a href="index3.html">Gabungan</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.html">SDM</a></li>
                                        <li><a href="index2.html">Iklan</a></li>
                                        <li><a href="index3.html">Sirkulasi</a></li>
                                        <li><a href="index3.html">Keuangan</a></li>
                                        <li><a href="index3.html">Akunting</a></li>
                                        <li><a href="index3.html">Umum</a></li>
                                        <li><a href="index3.html">Promosi</a></li>
                                        <li><a href="index3.html">Gabungan</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-print"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="index.html">SDM</a></li>
                                        <li><a href="index2.html">Iklan</a></li>
                                        <li><a href="index3.html">Sirkulasi</a></li>
                                        <li><a href="index3.html">Keuangan</a></li>
                                        <li><a href="index3.html">Akunting</a></li>
                                        <li><a href="index3.html">Umum</a></li>
                                        <li><a href="index3.html">Promosi</a></li>
                                        <li><a href="index3.html">Gabungan</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-thumbs-up"></i> Approval <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="displ: ;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ay: none">
                                        <li><a href="index.html">SDM</a></li>
                                        <li><a href="index2.html">Iklan</a></li>
                                        <li><a href="index3.html">Sirkulasi</a></li>
                                        <li><a href="index3.html">Keuangan</a></li>
                                        <li><a href="index3.html">Akunting</a></li>
                                        <li><a href="index3.html">Umum</a></li>
                                        <li><a href="index3.html">Promosi</a></li>
                                        <li><a href="index3.html">Gabungan</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-file"></i> Dokumentasi <span class="fa fa-chevron-down"></span></a>
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
                       
-->
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
