@extends('layouts.app-angularjs')

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
                                        <h2>Master Customer</h2>
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
                                            <th>ID Penawaran</th>
                                            <th>Customer</th>
                                            <th>Judul Iklan</th>
                                            <th>Tanggal</th>
                                            <th>Netto</th>
                                            <th>Status</th>
                                            <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Penawaran Baru</button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr  dir-paginate="values in customers | itemsPerPage:5" total-items="totalItems"> -->
                                        <tr  dir-paginate="values in _data | itemsPerPage:5" total-items="totalItems">
                                            <td>[[ values.id_pnwr ]]</td>
                                            <td>[[ values.customer.nama_customer ]]</td>
                                            <td>[[ values.judul_iklan ]]</td>
                                            <td>[[ values.tgl_penawaran ]]</td>
                                            <td >[[ values.pnwr_total ]]</td>
                                            <td>[[ values.sys_status_aktif ]]</td>
                                            <td>
                                                <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', values.id_pnwr)">Edit</button>
                                                <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(values, $index)">Delete</button>
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
                            <div>
                                <p class="pull-left pagination">Menampilan <strong>[[ table.CurrentItems ]]</strong> Dari <strong>[[ table.TotalItems ]]</strong></p>
                                <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="/ext/ng-html/dirPagination.html" ></dir-pagination-controls>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div form-pnwr-mst></div>
        </div>
        <div class="col-md-12" ng-controller="lovProdukController">
            <div lov-produk></div>
        </div>
        <div class="col-md-12" ng-controller="lovCustomerController">
            <div lov-customer></div>
        </div>
        <!-- <div class="col-md-12" ng-controller="lovTayangController"> -->
            <lov-modal></lov-modal>
        <!-- </div> -->
    </div>
</div>
                    <!-- AngularJS Application Scripts -->
<script src="<?= asset('app/controllers/pnwrMst.min.js') ?>"></script>
<script src="<?= asset('app/controllers/lovProduk.min.js') ?>"></script>
<script src="<?= asset('app/controllers/lovCustomer.min.js') ?>"></script>
@endsection
