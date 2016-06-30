@extends('layouts.app-angularjs')

@section('content')
<style>
    .jam{
        min-width: 70px;
    }
</style>
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
                                        <h2>Realisasi Tayang per Tanggal : [[ _tanggal | date:'EEEE , dd MMMM yyyy' ]] </h2>
                                    </div>
                                    <div class="pull-right" style="padding-top:30px">
                                        <div class="box-tools" style="display:inline-table">
                                          <div class="input-group">
                                              <!-- <input type="text" class="form-control input-sm ng-valid ng-dirty" placeholder="Search" ng-change="searchDB()" ng-model="searchText" name="table_search" title="" tooltip="" data-original-title="Min character length is 3"> -->
                                              <!-- <span class="input-group-addon">Search</span> -->
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
                                            <!-- <th>No Pnwr</th> -->
                                            <th style="min-width:200px;">Customer</th>
                                            <th style="min-width:250px;">Deskripsi</th>
                                            <!-- <th style="min-width:100px;">Tanggal</th> -->
                                            <!-- <th>00</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th>08</th><th>09</th><th>10</th><th>11</th> -->
                                            <!-- <th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th><th>21</th><th>22</th><th>23</th> -->
                                            <!-- <th>05</th><th>07</th><th>08</th><th>09</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th> -->
                                            <th ng-repeat="values2 in _jam" class="jam">
                                              [[ (($index+5) < 10) ? '0'+($index+5) : ($index+5) ]]  
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="values in _data">
                                            <!-- <td>[[ values.f_pnwr ]]</td> -->
                                            <td>[[ values.pnwr.customer.nama_customer ]]</td>
                                            <td>[[ values.pnwr.judul_iklan ]]</td>
                                            <!-- <td>[[ values.tayang_tgl ]]</td> -->
                                            <td ng-repeat="values2 in _jam" class="jam">
                                                <input ng-model="dataModal[$parent.$index].tayang_jam[$index]" ng-if="((values.jam[$parent.$index]).indexOf(values2+5)>-1)" class="form-control input-sm" mask='59' mask-clean='true' restrict="reject">
                                                <!-- [[ values.jam[$parent.$index] + (values2+5) ]]     -->
                                                <!-- [[ ((values.jam[$parent.$index]).indexOf(values2+5)>0) ]]     -->
                                                <!-- [[ (jQuery.inArray(values2+5, values.jam[$parent.$index])>-1) ]]     -->
                                                <!-- [[ ((values.jam).indexOf(values2)>0) ? 'ada' : '' ]] -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn btn-default" ng-click="toggle('cancel',null)">Cancel</button>
                                <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, idState)" ng-disabled="frmMst.$invalid">Save changes</button>
                                <!-- <p class="pull-left pagination">Menampilan <strong>[[ table.CurrentItems ]]</strong> Dari <strong>[[ table.TotalItems ]]</strong></p> -->
                                <!-- <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="/ext/ng-html/dirPagination.html" ></dir-pagination-controls> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
            <!-- <lov-modal></lov-modal> -->
    </div>
</div>
                    <!-- AngularJS Application Scripts -->
<script src="<?= asset('app/controllers/realisasi.min.js') ?>"></script>

@endsection
