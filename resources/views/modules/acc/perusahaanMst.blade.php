@extends('templates.layouts.ng-gentalella')


@section('content')
<div class="container" ng-controller="dataFormController">
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
                                        <h2>Master COA</h2>
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
                            </div>
                            <table class="table table-bordered pagin-table">
                                <thead>
                                    <tr>
                                        <th>No COA</th>
                                        <th>No Parent</th>
                                        <th>No Account</th>
                                        <th>Nama Account</th>
                                        <th>Deskripsi</th>
                                        <!--<th>Perusahaan</th>-->
                                        <th>Jenis Account</th>
                                        <th>Tipe Account</th>
                                        <th>Lvl Acc</th>
                                        <th>Detail</th>
                                        <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">{{ !empty($judul) ? $judul : null }} Baru</button></th>
                                        <!-- <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">{{ !empty($judul) ? $judul : null }} Baru</button></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr  dir-paginate="values in customers | itemsPerPage:5" total-items="totalItems"> -->
                                    <tr  dir-paginate="values in _data | itemsPerPage:5" total-items="totalItems">
                                        <td>[[ values.coa_id ]]</td>
                                        <td>[[ values.parent_id ]]</td>
                                        <td>[[ values.account_id ]]</td>
                                        <td>[[ values.coa_name ]]</td>
                                        <td>[[ values.coa_desc ]]</td>
                                        <!--<td></td>-->
                                        <td>[[ values.acc_coas_jns_acc.nama_jenis ]]</td>
                                        <td>[[ values.coa_side ]]</td>
                                        <td>[[ values.coa_level ]]</td>
                                        <td>
                                            <ul>
                                                <li ng-if="values.coa_sub_acct == 1">Punya sub account</li>
                                                <li ng-if="values.coa_revaluation == 1">Laba ditahan lalu</li>
                                                <li ng-if="values.coa_revaluation_current == 1">Laba ditahan berjalan</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', values.coa_id)">Edit</button>
                                            <!--
                                            <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(values, $index)">Delete</button>
                                            -->
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="10">
                                            <p class="pull-left pagination">Menampilan <strong>[[ table.CurrentItems ]]</strong> Dari <strong>[[ table.TotalItems ]]</strong></p>
                                            <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="/ext/ng-html/dirPagination.html" ></dir-pagination-controls>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div form-coas-mst>
        
        </div>
    </div>
</div>
<!-- AngularJS Application Scripts -->

{!! Html::script('assets/ng/others/angular-1.5.5/angular-sanitize.min.js') !!}
{!! Html::script('assets/ng/controllers/acc/perusahaanMst.min.js') !!}
@endsection
