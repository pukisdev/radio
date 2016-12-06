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
                                        <h2>Master Tipe Jurnal</h2>
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
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="formData()">{{ !empty($judul) ? $judul : null }} Baru</button></th>
                                        <!-- <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">{{ !empty($judul) ? $judul : null }} Baru</button></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr  dir-paginate="values in customers | itemsPerPage:5" total-items="totalItems"> -->
                                    <tr  dir-paginate="values in _data | itemsPerPage:5" total-items="totalItems">
                                        <td>[[ values.journal_code ]]</td>
                                        <td>[[ values.journal_desc ]]</td>
                                        <td>
                                            <button class="btn btn-default btn-xs btn-detail" ng-click="formData(values.journal_code)">Edit</button>
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
        <div form-tipe-jurnal>
        
        </div>
    </div>
</div>
<!-- AngularJS Application Scripts -->

{!! Html::script('assets/ng/others/angular-1.5.5/angular-sanitize.min.js') !!}
{!! Html::script('assets/ng/controllers/acc/tipeJurnalMst.min.js') !!}
@endsection
