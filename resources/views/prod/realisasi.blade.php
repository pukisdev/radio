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
                                            <!-- <th>05</th><th>07</th><th>08</th><th>09</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th> -->
                                            <th ng-repeat="values2 in _jam" class="jam">
                                              [[ (($index+5) < 10) ? '0'+($index+5) : ($index+5) ]]  
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="values in _data" ng-init="sectionIndex = $index">
                                            <!-- <td>[[ values.f_pnwr ]]</td> -->
                                            <td>[[ values.pnwr.customer.nama_customer ]]</td>
                                            <td>[[ values.pnwr.judul_iklan ]]</td>
                                            <!-- <td>[[ values.tayang_tgl ]]</td> -->
                                            <td ng-repeat="values3 in _jam" class="jam">
                                                <!-- <input ng-model="dataModal[$parent.$index].tayang_jam[$index]" ng-if="((values.jam[$parent.$index]).indexOf(values2+5)>-1)" class="form-control input-sm" mask='59' mask-clean='true' restrict="reject"> -->
                                                <!-- <input ng-model="dataModal[$parent.$index].tayang_jam[$index]" ng-if="((values.jam[$parent.$index]).indexOf(values2+5)>-1)" class="form-control input-sm" mask='59' mask-clean='true' restrict="reject"> -->
                                                <!-- <span ng-repeat="values.jam in _frekuensi"> -->
                                                    <!-- <span ng-if="angular.isArray([values.jam[$parent.$index]])"> ok</span> -->
                                                    <!-- [[ angular.isArray([]) ]]  -->
                                                    <!-- [[ angular.isString(values.jam[$parent.$index]) ]]  -->
                                                <!-- <input ng-model="tayang_realisasi[sectionIndex][$index]" ng-change="save(tayang_realisasi, $parent.$index)" ng-if="((values.jam[$parent.$index]).indexOf(values3+5)>-1)" class="form-control input-sm"><!-- mask='59' mask-clean='true' restrict="reject">--> 
                                                    <div class="input-group input-group-sm" style="width:75px;" ng-if="((values.jam[sectionIndex]).indexOf(values3+5)>-1)">
                                                        <div class="input-group-btn" ng-init="tayang_realisasi[sectionIndex][$index+5] = values.realMenit[$index+5]">
                                                            <button class="btn btn-info" type="button" ng-click="tayang_realisasi[sectionIndex][$index+5] = values.menit[$index+5]">[[ values.menit[$index+5] ]]</button>
                                                        </div>
                                                        <input ng-model="tayang_realisasi[sectionIndex][$index+5]" class="form-control" mask='59' mask-clean='true' restrict="reject">
                                                    </div>
                                                <!-- </span> -->
                                                <!-- [[ values.jam[$parent.$index]+ ' #$ ' + sectionIndex +'/'+ (values3+5) + '#' + $parent.$index + '\\' + (values.jam[$parent.$index]).indexOf(values3+5) ]]    -->
                                                <!--
                                                [[ items.splice(index, 1) ]]
                                                -->
                                                <!-- [[ values.jam[$parent.$index].forEach(function(i) { count[i] = (count[i]||0)+1;  }); ]]  -->
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
                                <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(tayang_realisasi)" ng-disabled="frmMst.$invalid">Save changes</button>
                                <!-- <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(_data, _tanggal)" ng-disabled="frmMst.$invalid">Save changes</button> -->
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
