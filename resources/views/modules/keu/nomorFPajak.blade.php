<!-- extends('layouts.app-angularjs') -->
@extends('templates.layouts.ng-gentalella')

@section('content')

<div class="container">
    <div class="row" ng-controller="dataFormController">
        <!-- <div class="col-md-10 col-md-offset-1"> -->
        <div class="col-md-12">
            <div class="panel panel-default" ng-show="!formTampil">
                <div class="panel-heading"> &nbsp</div>
                <div class="panel-body">
                    <div>
                        <h2></h2>
                        <!-- <div ng-controller="dataFormController"> -->
                        <div>
                            <!-- Table-to-load-the-data Part -->
                            <div class="row">
                                <div class="col-lg-12 margin-tb">
                                    <div class="pull-left">
                                        <h2>Master Nomor Faktur Pajak</h2>
                                    </div>
                                    <div class="pull-right" style="padding-top:30px">
                                        <div class="box-tools" style="display:inline-table">
                                          <div class="input-group">
                                              <input type="text" class="form-control input-sm ng-valid ng-dirty" placeholder="Search" ng-change="searchDB()" ng-model="searchText" name="table_search" title="" tooltip="" data-original-title="Min character length is 3">
                                              <span class="input-group-addon">Search</span>
                                          </div>
                                        </div>
                                        <!-- <button class="btn btn-success" data-toggle="modal" data-target="#create-user">Create New</button> -->
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered pagin-table">
                                    <thead>
                                        <tr>
                                            <th>No Surat</th>
                                            <th>Tanggal</th>
                                            <th>Nomor Depan</th>
                                            <th>Nomor Belakang (min)</th>
                                            <th>Nomor Belakang (max)</th>
                                            <th>Default</th>
                                            <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Buat Baru</button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr  dir-paginate="values in customers | itemsPerPage:5" total-items="totalItems"> -->
                                        <tr  dir-paginate="values in _data | itemsPerPage:5" total-items="totalItems">
                                            <td>[[ values.nomor_surat_pajak ]]</td>
                                            <td>[[ values.tanggal.substring(0,10)]]</td>
                                            <td>[[ values.nomor_depan ]]</td>
                                            <td>[[ values.nomor_belakang ]]</td>
                                            <td>[[ values.nomor_belakang_max  ]]</td>
                                            <td>[[ values.status ]]</td>
                                            <td>
                                                <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', values.nomor_surat_pajak)">Edit</button>
                                                <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(values, $index)">Delete</button>
                                            </td>
                                        </tr>
                                      </tbody>
                                </table>
                            </div>
                            <div>
                                <p class="pull-left pagination">Menampilan <strong>[[ table.CurrentItems ]]</strong> Dari <strong>[[ table.TotalItems ]]</strong></p>
                                <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="/assets/ng/views/etc/dirPagination.html" ></dir-pagination-controls>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div form-Data></div>
        </div>
            <lov-modal></lov-modal>
    </div>
</div>
                    <!-- AngularJS Application Scripts -->
<!-- {!! Html::script('assets/ng/others/angular-1.5.5/angular-sanitize.min.js') !!} -->
{!! Html::script('assets/ng/controllers/keu/nomorFPajak.min.js') !!}
<!-- {!! Html::script('assets/ng/controllers/keu/lovBank.min.js') !!} -->
<!-- {!! Html::script('assets/ng/controllers/keu/lovSeri.min.js') !!} -->
<!-- {!! Html::script('assets/ng/controllers/keu/lovAccCoa.min.js') !!} -->
<!-- {!! Html::script('assets/ng/controllers/keu/lovCostCenter.min.js') !!} -->
<!--{!! Html::script('assets/ng/controllers/keu/lovNpb.min.js') !!}
{!! Html::script('assets/ng/controllers/keu/lovApCst.min.js') !!}
{!! Html::script('assets/ng/controllers/acc/lovCoa.min.js') !!} -->
<!-- {!! Html::script('assets/ng/controllers/pms/lovPnwr.min.js') !!} -->

@endsection
