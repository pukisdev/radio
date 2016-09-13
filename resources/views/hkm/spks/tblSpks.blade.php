@extends('templates.layouts.ng-gentalella')


@section('content')
<div class="container" ng-controller="spksController">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" ng-show="!formTampil">
                <div class="panel-heading"> &nbsp</div>

                <div class="panel-body">
                    <div>
                        <h2></h2>
                            <!-- Table-to-load-the-data Part -->
                        <div >
                            <div class="row">
                                <div class="col-lg-12 margin-tb">
                                    <div class="pull-left">
                                        <h2>Master {{ !empty($judul) ? $judul : null }}</h2>
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
                            <table class="table table-bordered pagin-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Berlaku Awal</th>
                                        <th>Berlaku Akhir</th>
                                        <th>Keterangan</th>
                                        <!-- <th>Status</th> -->
                                        <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">{{ !empty($judul) ? $judul : null }} Baru</button></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr  dir-paginate="values in customers | itemsPerPage:5" total-items="totalItems"> -->
                                    <tr  dir-paginate="values in _data | itemsPerPage:5" total-items="totalItems">
                                        <td>[[ values.id_spks ]]</td>
                                        <td>[[ values.customer.nama_customer ]]</td>
                                        <td>[[ values.tgl_awal ]]</td>
                                        <td>[[ values.tgl_akhir ]]</td>
                                        <td>[[ values.keterangan ]]</td>
                                        <!-- <td>[[ values.sys_status_aktif ]]</td> -->
                                        <td>
                                            <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', values.id_spks)">Edit</button>
                                            <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(values, $index)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <p class="pull-left pagination">Menampilan <strong>[[ table.CurrentItems ]]</strong> Dari <strong>[[ table.TotalItems ]]</strong></p>
                                            <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="/assets/ng/views/etc/dirPagination.html" ></dir-pagination-controls>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div form-spks class="col-md-12"></div>
        <div class="col-md-12" ng-controller="lovCustomerController">
            <div lov-customer></div>
        </div>
        <lov-modal></lov-modal>
    </div>
</div>
<!-- AngularJS Application Scripts -->
<!--
<script src="<?= asset('app/lib/angular-1.5.5/angular-sanitize.min.js') ?>"></script>
<script src="<?= asset('app/lib/uploader/ng-file-upload-bower/ng-file-upload-shim.min.js') ?>"></script>
<script src="<?= asset('app/lib/uploader/ng-file-upload-bower/ng-file-upload.min.js') ?>"></script>
<script src="<?= asset('app/controllers/spks.min.js') ?>"></script>
<script src="<?= asset('app/controllers/lovCustomer.min.js') ?>"></script>
-->

{!! Html::script('assets/ng/others/angular-1.5.5/angular-sanitize.min.js') !!}
{!! Html::script('assets/ng/others/uploader/ng-file-upload-bower/ng-file-upload-shim.min.js') !!}
{!! Html::script('assets/ng/others/uploader/ng-file-upload-bower/ng-file-upload.min.js') !!}
{!! Html::script('assets/ng/controllers/hkm/spks.min.js') !!}
{!! Html::script('assets/ng/controllers/pms/lovCustomer.min.js') !!}

@endsection
