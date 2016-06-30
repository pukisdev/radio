@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> &nbsp</div>

                <div class="panel-body">
                <div>
                    <h2></h2>
                    <div ng-controller="customerController">

                        <!-- Table-to-load-the-data Part -->
                        <!-- <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <h2>Master customer</h2>
                                </div>
                                <div class="pull-right" style="padding-top:30px">
                                    <div class="box-tools" style="display:inline-table">
                                      <div class="input-group">
                                          <input type="text" class="form-control input-sm ng-valid ng-dirty" placeholder="Search" ng-change="searchDB()" ng-model="searchText" name="table_search" title="" tooltip="" data-original-title="Min character length is 3">
                                          <span class="input-group-addon">Search</span>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                            <table class="table table-bordered pagin-table" datatable="" class="row-border hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Foo</td>
                                    <td>Bar</td>
                                </tr>
                                <tr>
                                    <td>123</td>
                                    <td>Someone</td>
                                    <td>Youknow</td>
                                </tr>
                                <tr>
                                    <td>987</td>
                                    <td>Iamout</td>
                                    <td>Ofinspiration</td>
                                </tr>
                                <tr>
                                    <td>987</td>
                                    <td>Iamout</td>
                                    <td>Ofinspiration</td>
                                </tr>
                                <tr>
                                    <td>987</td>
                                    <td>Iamout</td>
                                    <td>Ofinspiration</td>
                                </tr>
                                <tr>
                                    <td>987</td>
                                    <td>Iamout</td>
                                    <td>Ofinspiration</td>
                                </tr>
                                <tr>
                                    <td>987</td>
                                    <td>Iamout</td>
                                    <td>Ofinspiration</td>
                                </tr>
                                <tr>
                                    <td>987</td>
                                    <td>Iamout</td>
                                    <td>Ofinspiration</td>
                                </tr>
                                <tr>
                                    <td>987</td>
                                    <td>Iamout</td>
                                    <td>Ofinspiration</td>
                                </tr>
                                <tr>
                                    <td>987</td>
                                    <td>Iamout</td>
                                    <td>Ofinspiration</td>
                                </tr>
                                <tr>
                                    <td>987</td>
                                    <td>Iamout</td>
                                    <td>Ofinspiration</td>
                                </tr>
                                <tr>
                                    <td>987</td>
                                    <td>Iamout</td>
                                    <td>Ofinspiration</td>
                                </tr>
                                <tr>
                                    <td>987</td>
                                    <td>Iamout</td>
                                    <td>Ofinspiration</td>
                                </tr>
                                <tr>
                                    <td>987</td>
                                    <td>Iamout</td>
                                    <td>Ofinspiration</td>
                                </tr>
                                </tbody>
                            </table>
                    </div>
                </div>

            <!-- AngularJS Application Scripts -->
            <!--
            <script src="<?= asset('app/app.js') ?>"></script>
            <script src="<?= asset('app/controllers/customer.min.js') ?>"></script>
            <script src="<?= asset('app/helpers/myHelper.js') ?>"></script>                
            -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    app.controller('customerController', function($scope, $http, API_URL) {
    });
</script>
@endsection
