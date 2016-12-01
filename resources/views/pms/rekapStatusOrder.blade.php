<!-- extends('layouts.app-angularjs') -->
@extends('templates.layouts.ng-gentalella')

@section('content')

<div class="container">
    <div class="row" ng-controller="dataFormController">
        <!-- <div class="col-md-10 col-md-offset-1"> -->
        <div class="col-md-12">
            <div class="panel panel-default" id="idModalMst">
                <div class="panel-heading"> &nbsp</div>
                <div class="panel-body">
                    <!-- Table-to-load-the-data Part -->
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <!-- <h2>Transfer Nota Penerimaan</h2> -->
                            </div>
                            <div class="pull-right" style="padding-top:30px">
                                <div class="box-tools" style="display:inline-table">
                                </div>
                                <!-- <button class="btn btn-success" data-toggle="modal" data-target="#create-user">Create New</button> -->
                            </div>
                        </div>
                    </div>
                    <div>
                        <form name="frmMst" id="frmMst" class="form-horizontal">
                            <div class="row">
                                <div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="xpanel">
                                            <div class="x_title">
                                                <h2>Form Report Status Order</h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Awal</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control text-right" name="tgl_awal" ng-model="dataForm.tgl_awal">
                                                    </div>
                                                </div>
                                            </div>        
                                            <div class="form-group col-sm-12">
                                                <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Akhir</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control text-right" name="tgl_akhir" ng-model="dataForm.tgl_akhir">
                                                    </div>
                                                </div>
                                            </div>     
                                            <div>
                                                <div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
                                                    <button type="button" class="btn btn-primary" ng-click="cetak()">Cetak</button>
                                                    <button type="button" class="btn btn-default" ng-ng-click="toggle('cancel',null)">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
        <lov-modal></lov-modal>
    </div>
</div>
                    <!-- AngularJS Application Scripts -->
{!! Html::script('assets/ng/controllers/pms/rekapStatusOrder.min.js') !!}

@endsection
