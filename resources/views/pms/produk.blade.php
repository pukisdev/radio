<!-- extends('layouts.app-angularjs') -->
@extends('templates.layouts.ng-gentalella')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> &nbsp</div>

                <div class="panel-body">
        <div>
            <h2></h2>
            <div  ng-controller="produkController">

                <!-- Table-to-load-the-data Part -->
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Master Produk</h2>
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>Position</th>
                                <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Produk Baru</button></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr ng-repeat="values in produks" total-items="totalItems"> -->
                            <tr  dir-paginate="values in produks | itemsPerPage:5" total-items="totalItems">
                                <td>[[ values.id_produk ]]</td>
                                <td>[[ values.nama ]]</td>
                                <td>[[ values.durasi ]]</td>
                                <td>[[ values.satuan_durasi ]]</td>
                                <td>[[ values.sys_status_aktif ]]</td>
                                <td>
                                    <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', values.id_produk)">Edit</button>
                                    <!-- <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', produk.id_produk)">Edit</button> -->
                                    <!-- <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', 'BRG-00001')">Edit</button> -->
                                    <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(values, $index)">Delete</button>
                                    <button class="btn btn-success btn-xs" ng-click="tarif(values.nama, values.id_produk)">Tarif</button>
                                </td>
                            </tr>
                        </tbody>
                        <!-- <tfoot>
                            <tr>
                                <td colspan="7">
                                    <p class="pull-left pagination">Menampilan <strong>[[ table.CurrentItems ]]</strong> Dari <strong>[[ table.TotalItems ]]</strong></p>
                                    <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="/ext/ng-html/dirPagination.html" ></dir-pagination-controls>
                                </td>
                            </tr>
                        </tfoot> -->
                    </table>
                </div>
                    <p class="pull-left pagination">Menampilan <strong>[[ table.CurrentItems ]]</strong> Dari <strong>[[ table.TotalItems ]]</strong></p>
                    <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="/assets/ng/views/etc/dirPagination.html" ></dir-pagination-controls>                    
                <div modal-produk></div>
                <div modal-tarif></div>
            </div>
        </div>

            <!-- AngularJS Application Scripts -->
            <!-- <script src="<?= asset('app/app.js') ?>"></script> -->
            <!-- <script src="<?= asset('app/controllers/produk.min.js') ?>"></script> -->
            <!-- <script src="<?= asset('app/helpers/myHelper.js') ?>"></script>                 -->
            {!! Html::script('assets/ng/others/app.js') !!}
            {!! Html::script('assets/ng/controllers/pms/produk.min.js') !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
