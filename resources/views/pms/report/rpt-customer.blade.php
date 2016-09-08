@extends('templates.layouts.pdf-gentalella')

@section('content')
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <!--
                             <div class="x_panel"> 
                                <div class="x_title">
                                    <h2>Basic Tables <small>basic table subtitle</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                            -->

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Customer</th>
                                                <th>Nama Customer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($vData as $index=>$isi)
                                            <tr>
                                                <th scope="row">{{$index+1}}</th>
                                                <td>{{$isi->id_customer}}</td>
                                                <td>{{$isi->nama_customer}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                            <!--
                                </div>
                            </div>
                        </div>
                        -->
@endsection