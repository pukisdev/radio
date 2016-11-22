@extends('templates.layouts.ng-gentalella')

@section('content')

<div class="container">
    <div class="row" ng-controller="dataFormController">
        <div class="col-md-12">
            <div class="panel panel-default" ng-show="!formTampil">
                <div class="panel-heading"> &nbsp</div>
                <div class="panel-body">
                    <div>
                        <h2></h2>

                        <div  >
                            <!-- Table-to-load-the-data Part -->
                            <div class="row">
                                <div class="col-lg-12 margin-tb">
                                    <div class="pull-left">
                                        <h2>Master Customer</h2>
                                    </div>
                                    <div class="pull-right" style="padding-top:30px">
                                        <div class="box-tools" style="display:inline-table">
                                          <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" ng-click="rekap('pdf')"><i class="fa fa-file-pdf-o"></i></button>
                                                    <button class="btn btn-default" type="button" ng-click="rekap('excel')"><i class="fa fa-file-excel-o"></i></button>
                                                </span>
                                                <!-- <input type="text" class="form-control input-sm ng-valid ng-dirty" placeholder="Search" ng-change="searchDB()" ng-model="searchText" name="table_search" title="" tooltip="" data-original-title="Min character length is 3"> -->
                                                <input type="text" class="form-control ng-valid ng-dirty" placeholder="Search" ng-change="searchDB()" ng-model="searchText" name="table_search" title="" tooltip="" data-original-title="Min character length is 3">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" ><i class="fa fa-search"></i></button>
                                                </span>
                                                <!-- <span class="input-group-addon">Search</span> -->
                                          </div>
                                        </div>
                                        <!-- <button class="btn btn-success" data-toggle="modal" data-target="#create-user">Create New</button> -->
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered pagin-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Customer Baru</button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr  dir-paginate="values in customers | itemsPerPage:5" total-items="totalItems"> -->
                                    <tr  dir-paginate="values in _data | itemsPerPage:5" total-items="totalItems">
                                        <td>[[ values.id_customer ]]</td>
                                        <td>[[ values.ket_nama ]]. [[ values.nama_customer ]]</td>
                                        <td>[[ values.sys_status_aktif ]]</td>
                                        <td>
                                            <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', values.id_customer)">Edit</button>
                                            <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(values, $index)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div>
                                <p class="pull-left pagination">Menampilan <strong>[[ table.CurrentItems ]]</strong> Dari <strong>[[ table.TotalItems ]]</strong></p>
                                <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="/assets/ng/views/etc/dirPagination.html" ></dir-pagination-controls>
                            </div>
                            <!--<div modal-customer></div>-->
                        </div>
                    </div>
                </div>
            </div>
            <div form-customer></div>
        </div>
    </div>
</div>

<!-- AngularJS Application Scripts -->
<!--{!! Html::script('assets/ng/others/app.js') !!}-->
{!! Html::script('assets/ng/others/angular-1.5.5/angular-sanitize.min.js') !!}
{!! Html::script('assets/ng/controllers/pms/customer.min.js') !!}

@endsection
