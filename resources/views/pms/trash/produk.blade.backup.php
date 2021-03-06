@extends('layouts.app')

@section('content')
<style>
    .glyphicon-refresh-animate {
    -animation: spin .7s infinite linear;
    -webkit-animation: spin2 .7s infinite linear;
    }

    @-webkit-keyframes spin2 {
        from { -webkit-transform: rotate(0deg);}
        to { -webkit-transform: rotate(360deg);}
    }

    @keyframes spin {
        from { transform: scale(1) rotate(0deg);}
        to { transform: scale(1) rotate(360deg);}
    }

    .loader {
       position: fixed;
       top: 0;
       right: 0;
       bottom: 0;
       left: 0;
       z-index: 1100;
       background-color: white;
       opacity: .6;
       padding-top: 20%;
    }
</style>
<div class="container" ng-app="appRoot">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> &nbsp</div>

                <div class="panel-body">
        <div class="loader vcenter text-center" data-loading>
            <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
        </div>
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
                                <button class="btn btn-success btn-xs" ng-click="tarif(values.id_produk)">Tarif</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="/ext/ng-html/dirPagination.html" ></dir-pagination-controls>
                <!-- End of Table-to-load-the-data Part -->
                <!-- Modal (Pop up when detail button clicked) -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabel">[[ form_title ]]</h4>
                            </div>
                            <div class="modal-body">
                                <form name="frmProduk" class="form-horizontal" novalidate="">
                
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">ID Produk</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="ID Otomatis" value="[[ id_produk ]]" ng-model="produk.id_produk" readonly>
                                        <!-- <span class="help-inline" ng-show="frmProduk.id_produk.$invalid && frmProduk.id_produk.$touched">ID produk field is required</span> -->
                                        </div>
                                    </div>
                
                                    <div class="form-group error" ng-class="{ 'has-error' : frmProduk.nama.$invalid && frmProduk.nama.$touched }">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                        <div class="col-sm-9">
                                            <!-- <input type="text" class="form-control has-error" id="name" name="name" placeholder="Fullname" value="[[name]]" ng-model="produk.name" ng-required="true"> -->
                                            <input type="text" class="form-control has-error" placeholder="Fullname" value="[[nama]]" name="nama" ng-model="produk.nama" ng-minlength="5" ng-maxlength="10" maxlength="10" required ><!--ng-required="true">-->
                                            <span class="help-inline" ng-messages="frmProduk.nama.$error" ng-show="frmProduk.nama.$invalid && frmProduk.nama.$touched">
                                                <ng-messages-include src="/ext/ng-html/messages.html"></ng-messages-include>
                                            </span>
                                            <!-- <span class="help-inline" ng-messages="frmProduk.nama.$error" ng-if="userForm.nama.$touched">
                                                <div ng-message="required">This field is required</div>
                                            </span> -->
                                        </div>
                                    </div>
                
                                    <div class="form-group" ng-class="{ 'has-error' : frmProduk.durasi.$invalid && frmProduk.durasi.$touched }">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Durasi</label>
                                        <div class="col-sm-9">
                                            <!-- <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="[[email]]" ng-model="produk.email" ng-required="true"> -->
                                            <input type="durasi" class="form-control" placeholder="Durasi" value="[[durasi]]" name="durasi" ng-model="produk.durasi" required>
                                            <span class="help-inline" ng-messages="frmProduk.durasi.$error" ng-show="frmProduk.durasi.$invalid && frmProduk.durasi.$touched">
                                                <ng-messages-include src="/ext/ng-html/messages.html"></ng-messages-include>
                                            </span>
                                        </div>
                                    </div>
                
                                    <div class="form-group" ng-class="{ 'has-error' : frmProduk.satuan_durasi.$invalid && frmProduk.satuan_durasi.$touched }">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Satuan Durasi</label>
                                        <div class="col-sm-9">
                                            <!-- <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number" value="[[contact_number]]" ng-model="produk.contact_number" ng-required="true"> -->
                                            <select class="form-control" placeholder="Satuan Durasi" ng-model="produk.satuan_durasi" name="satuan_durasi" ng-required="true">
                                                <option value> Pilih </option>
                                                <option value="detik">Detik</option>
                                                <option value="menit">Menit</option>
                                            </select>
                                            <!-- <input type="text" class="form-control" placeholder="Satuan Durasi" value="[[contact_number]]" ng-model="produk.contact_number" ng-required="true"> -->
                                        <span class="help-inline" ng-messages="frmProduk.satuan_durasi.$error" ng-show="frmProduk.satuan_durasi.$invalid && frmProduk.satuan_durasi.$touched">
                                                <ng-messages-include src="/ext/ng-html/messages.html"></ng-messages-include>
                                            </span>
                                        </div>
                                    </div>
                
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id_produk)" ng-disabled="frmProduk.$invalid">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div modal-tarif></div>
            </div>
        </div>

            <script src="<?= asset('app/lib/angular-1.5.5/angular.min.js') ?>"></script>
            <script src="<?= asset('app/lib/angular-1.5.5/angular-messages.min.js') ?>"></script>
            <script src="<?= asset('app/lib/angular-1.5.5/dirPagination.js') ?>"></script>
            <script src="<?= asset('ext/jquery-gritter/js/jquery.gritter.min.js') ?>"></script>
            
            <!-- AngularJS Application Scripts -->
            <script src="<?= asset('app/app.js') ?>"></script>
            <script src="<?= asset('app/controllers/produk.min.js') ?>"></script>
            <script src="<?= asset('app/helpers/myHelper.js') ?>"></script>                

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
