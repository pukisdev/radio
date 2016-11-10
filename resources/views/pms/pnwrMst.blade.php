<!-- extends('layouts.app-angularjs') -->
@extends('templates.layouts.ng-gentalella')

@section('content')
<div class="container">
    <div class="row" ng-controller="dataFormController">
        <!-- <div class="col-md-10 col-md-offset-1"> -->
        <div class="col-md-12">
            <div class="panel panel-default" ng-show="!formTampil">
                <div class="panel-heading"> 
                    <h2>Penawaran Order Iklan</h2>
                </div>
                <div class="panel-body">
                    <div>
                        <h2></h2>
                        <!-- <div ng-controller="dataFormController"> -->
                        <div>
                            <!-- Table-to-load-the-data Part -->
                            <div class="row">
                                <div class="col-lg-12 margin-tb">
                                    <div class="pull-left">
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
                                            <th>Spks</th>
                                            <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Penawaran Baru</button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr  dir-paginate="values in customers | itemsPerPage:5" total-items="totalItems"> -->
                                        <tr  dir-paginate="values in _data | itemsPerPage:5" total-items="totalItems">
                                            <td>[[ values.id_pnwr ]]</td>
                                            <td>[[ values.customer.nama_customer ]]</td>
                                            <td>[[ values.judul_iklan ]]</td>
                                            <td>[[ values.tgl_penawaran.substring(0, 10) ]]</td>
                                            <td>[[ values.pnwr_total | currency : 'Rp.' ]]</td>
                                            <!-- <td>[[ values.sys_status_aktif ]]</td> -->
                                            <td width="23%">
                                                <div ng-if="!values.f_spks" class="form-group error" ng-class="{ 'has-error' : frmMst.listSpks.$invalid && frmMst.listSpks.$touched }">
                                                        <!-- [[$index]] -->
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default" type="button" ng-click="simpanSpks(values.id_pnwr, $index);" ><i class="fa fa-save"></i></button>
                                                            <button class="btn btn-default" type="button" ng-click="lovSpks(values.f_customer, $index);" ><i class="fa fa-edit"></i></button>
                                                        </span>
                                                        <input type="hidden" class="form-control has-error" name="f_spks" ng-model="dataForm[$index].f_spks" required readonly> 
                                                        <input type="text" class="form-control has-error" placeholder="Spks" name="alias_spks" ng-model="dataForm[$index].alias_spks" required readonly>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default" type="button" ng-click="dataForm[$index].alias_spks = null; dataForm[$index].f_spks = null; " ><i class="fa fa-refresh"></i></button>
                                                        </span>
<!--
                                                         <select class="form-control" placeholder="Jenis Bayar" name="listSpks" ng-model="param" required> 
                                                            <option ng-repeat="listSpks in _data[$index].customer.spks" value="[[listSpks.id_spks+','+listSpks.spks]]">[[ listSpks.alias_spks ]]</option>
                                                        </select>
                                                        <select class="form-control" name="listSpks" ng-options="_option as _option.alias_spks for _option in _data[$index].customer.spks" ng-model="listSpks" ng-change="getFilesSpks(listSpks);" required> 
                                                        </select>
 -->

                                                    </div>
                                                    <span class="help-inline" ng-messages="frmMst.listSpks.$error" ng-show="frmMst.listSpks.$invalid && frmMst.listSpks.$touched">
                                                        <ng-messages-include src="/assets/ng/views/etc/messages.html"></ng-messages-include>
                                                    </span>
                                                </div>
                                                <button ng-if="values.f_spks" class="btn btn-info btn-xs" ng-click="getFilesSpks(values.spks.spks)">[[ values.spks.alias_spks ]]</button>
                                            </td>
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
                                <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="/assets/ng/views/etc/dirPagination.html" ></dir-pagination-controls>
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
        <!-- <div class="col-md-12" ng-controller="lovSpksController"> -->
            <!-- <div lov-spks></div> -->
        <!-- </div> -->
        <!-- <div class="col-md-12" ng-controller="lovTayangController"> -->
            <lov-modal></lov-modal>
        <!-- </div> -->
    </div>
</div>
                    <!-- AngularJS Application Scripts -->
<!--
<script src="<?= asset('app/controllers/pnwrMst.min.js') ?>"></script>
<script src="<?= asset('app/controllers/lovProduk.min.js') ?>"></script>
<script src="<?= asset('app/controllers/lovCustomer.min.js') ?>"></script>
<script src="<?= asset('app/controllers/lovSpks.min.js') ?>"></script>
-->

{!! Html::script('assets/ng/controllers/pms/pnwrMst.min.js') !!}
{!! Html::script('assets/ng/controllers/pms/lovProduk.min.js') !!}
{!! Html::script('assets/ng/controllers/pms/lovCustomer.min.js') !!}
{!! Html::script('assets/ng/controllers/hkm/lovSpks.min.js') !!}

@endsection
