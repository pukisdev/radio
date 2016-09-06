@extends('templates.layouts.gentalella')

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>{{ $vData['namaType'] }}</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                <input style="padding: 5px 16px;" type="text" placeholder="Search..." class="autocomplete-input input tooltip-button ui-autocomplete-input" data-placement="bottom" title="" name="" data-original-title="Type 'jav' to see the available tags..." autocomplete="off">
                <i class="glyph-icon icon-search"></i>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Module {{ $vData['namaModule'] }} <!-- <small>different icon design elements</small> --></h2>
                    <!-- <ul class="nav navbar-right panel_toolbox">
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
                    </ul> -->
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="bs-docs-section">
                        <!-- <h1 id="glyphicons" class="page-header">Module {{ $vData['namaModule'] }}</h1> -->

                        <!-- <h2 id="glyphicons-glyphs">Available glyphs</h2> -->
                        <!-- <p>Includes 260 glyphs in font format from the Glyphicon Halflings set. <a href="http://glyphicons.com/">Glyphicons</a> Halflings are normally not available for free, but their creator has made them available for Bootstrap free of cost. As a thank you, we only ask that you include a link back to <a href="http://glyphicons.com/">Glyphicons</a> whenever possible.</p> -->
                        <div class="bs-glyphicons">
                            <ul class="bs-glyphicons-list">
								@foreach($vData['menu'] as $value)
                                <li>
                                    <!-- <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> -->
                                    <span class="glyphicon fa {{!empty($value->icon) ? $value->icon : 'fa-anchor'}}" aria-hidden="true"></span>
                                    <span class="glyphicon-class">{{ $value->nama }}</span>
                                </li>
                                @endforeach

<!--                                 <li>
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    <span class="glyphicon-class">glyphicon glyphicon-plus</span>
                                </li>

                                <li>
                                    <span class="glyphicon glyphicon-euro" aria-hidden="true"></span>
                                    <span class="glyphicon-class">glyphicon glyphicon-euro</span>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
