<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Laravel 5 AngularJS CRUD Example</title>

        <!-- Load Bootstrap CSS -->
        <link href="<?= asset('ext/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= asset('ext/jquery-gritter/css/jquery.gritter.css') ?>" rel="stylesheet">
    </head>
    <body>
        <div ng-app="produkRecords">
            <h2>Employees Database</h2>
            <div  ng-controller="produkController">

                <!-- Table-to-load-the-data Part -->
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>Position</th>
                            <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Add New Employee</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="values in produks">
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
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- End of Table-to-load-the-data Part -->
                <!-- Modal (Pop up when detail button clicked) -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabel">[[form_title]]</h4>
                            </div>
                            <div class="modal-body">
                                <form name="frmProduk" class="form-horizontal" novalidate="">
                
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">ID Produk</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="ID Otomatis" value="[[id_produk]]" ng-model="produk.id_produk" readonly>
                                        <!-- <span class="help-inline" ng-show="frmProduk.id_produk.$invalid && frmProduk.id_produk.$touched">ID produk field is required</span> -->
                                        </div>
                                    </div>
                
                                    <div class="form-group error">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                        <div class="col-sm-9">
                                            <!-- <input type="text" class="form-control has-error" id="name" name="name" placeholder="Fullname" value="[[name]]" ng-model="produk.name" ng-required="true"> -->
                                            <input type="text" class="form-control has-error" placeholder="Fullname" value="[[nama]]" ng-model="produk.nama" ng-required="true">
                                            <span class="help-inline" 
                                            ng-show="frmProduk.nama.$invalid && frmProduk.nama.$touched">Name field is required</span>
                                        </div>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Durasi</label>
                                        <div class="col-sm-9">
                                            <!-- <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="[[email]]" ng-model="produk.email" ng-required="true"> -->
                                            <input type="durasi" class="form-control" placeholder="Durasi" value="[[durasi]]" ng-model="produk.durasi" ng-required="true">
                                            <span class="help-inline" 
                                            ng-show="frmProduk.durasi.$invalid && frmProduk.durasi.$touched">Valid Email field is required</span>
                                        </div>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Satuan Durasi</label>
                                        <div class="col-sm-9">
                                            <!-- <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number" value="[[contact_number]]" ng-model="produk.contact_number" ng-required="true"> -->
                                            <select class="form-control" placeholder="Satuan Durasi" ng-model="produk.satuan_durasi" ng-required="true">
                                                <option value> Pilih </option>
                                                <option value="detik">Detik</option>
                                                <option value="menit">Menit</option>
                                            </select>
                                            <!-- <input type="text" class="form-control" placeholder="Satuan Durasi" value="[[contact_number]]" ng-model="produk.contact_number" ng-required="true"> -->
                                        <span class="help-inline" 
                                            ng-show="frmProduk.contact_number.$invalid && frmProduk.contact_number.$touched">Contact number field is required</span>
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
            </div>
        </div>

            <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
            <script src="<?= asset('app/lib/angular-1.5.5/angular.min.js') ?>"></script>
            <script src="<?= asset('js/jquery-1.12.3.js') ?>"></script>
            <script src="<?= asset('ext/bootstrap/js/bootstrap.min.js') ?>"></script>
            <script src="<?= asset('ext/jquery-gritter/js/jquery.gritter.min.js') ?>"></script>
            
            <!-- AngularJS Application Scripts -->
            <script src="<?= asset('app/app.js') ?>"></script>
            <script src="<?= asset('app/controllers/produk.js') ?>"></script>
            <script src="<?= asset('app/helpers/myHelper.js') ?>"></script>
    </body>
</html>