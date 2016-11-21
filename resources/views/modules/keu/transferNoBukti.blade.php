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
                        <form name="frmMst" class="form-horizontal" novalidate="">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group error" ng-class="{ 'has-error' : frmMst.bulan.$invalid && frmMst.bulan.$touched }">
                                    <label for="inputEmail3" class="col-sm-1 control-label">Periode</label>
                                    <div class="col-md-11 col-sm-11 col-xs-11">
                                        <div class="col-md-5 col-sm-5 col-xs-5 form-group has-feedback">
                                        <!-- <div class="input-group"> -->
                                            <select class="form-control" placeholder="Tipe Bayar" name="bulan" ng-model="dataForm.param.bulan" ng-required="true">
                                                <option value> Pilih </option>
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 form-group has-feedback">
                                            <input type="text" class="form-control" placeholder="tahun" name="tahun" ng-model="dataForm.param.tahun" readonly="true">
                                        </div>
                                        <!-- </div> -->
                                        <span class="help-inline" ng-messages="frmMst.bulan.$error" ng-show="frmMst.bulan.$invalid && frmMst.bulan.$touched">
                                            <ng-messages-include src="/assets/ng/views/etc/messages.html"></ng-messages-include>
                                        </span>
                                        <div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
                                            <button type="button" class="btn btn-primary" ng-click="checkRequirement()" ng-disabled="frmMst.$invalid">Pengecekan</button>
                                            <button type="button" class="btn btn-primary" ng-click="transfer()" ng-disabled="btnTransfer && frmMst.$invalid">Transfer</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div ng-show="btnTransfer">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>Coa <small class="bg-red">bermasalah</small></h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Bukti</th>
                                                            <th>Jumlah Coa</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr  dir-paginate="values in dataForm.coa | itemsPerPage:5" total-items="totalItems">
                                                            <th scope="row">[[ $index+1 ]]</th>
                                                            <td>[[ values.no_bukti ]]</td>
                                                            <td>[[ values.total_coa ]]</td>
                                                        </tr>
                                                    </tbody>
                                                </table>                                        
                                            </div>
                                        </div>
                                    </div>                                
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>Faktur <small class="bg-red">bermasalah</small></h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Bukti</th>
                                                            <th>coa_id</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr  dir-paginate="values in dataForm.faktur | itemsPerPage:5" total-items="totalItems">
                                                            <th scope="row">[[ $index+1 ]]</th>
                                                            <td>[[ values.no_bukti ]]</td>
                                                            <td>[[ values.total_coa ]]</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>                                
                                    </div>
                                </div> <!-- end of bukti bermasalah -->
                                <div ng-show="!btnTransfer">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="xpanel">
                                            <div class="x_title">
                                                <h2>Detail Faktur<small class="bg-green"> Tidak ada data yang bermasalah</small></h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                
                                                <div class="form-group error">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Jumlah Bukti</label>
                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control text-right" placeholder="Jumlah Bukti" name="jmlBukti" ng-model="dataForm.jmlBukti" readonly="true">
                                                            <!-- <span class="input-group-btn">
                                                                <button class="btn btn-default" type="button">...</button>
                                                            </span> -->
                                                        </div>
                                                    </div>
                                                </div>        

                                                <div class="form-group error">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">Total Nilai (Rp.)</label>
                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control text-right" currency-mask placeholder="Total Nilai Bukti" name="totalBukti" ng-model="dataForm.totalBukti" readonly="true">
                                                        </div>
                                                    </div>
                                                </div>       
                                                <hr/>
                                                <div>
                                                    <!-- <div class="col-md-2">
                                                        <p>Alternate design</p>
                                                        <input class="knob" data-width="110" data-height="120" data-displayPrevious=true data-fgColor="#26B99A" data-skin="tron" data-thickness=".2" value="75">
                                                    </div> -->
                                                    <!-- <input type='text' class='dial' value='0' data-number='100' />
                                                    <div style="height: 300px">scroll down</div>
                                                    <div class="startKnob">start</div>
                                                     -->
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
<!-- {!! Html::script('assets/ng/others/angular-1.5.5/angular-sanitize.min.js') !!} -->
{!! Html::script('assets/ng/controllers/keu/transferNoBukti.min.js') !!}
<!-- {!! Html::script('assets/ng/controllers/keu/lovBank.min.js') !!} -->
<!-- {!! Html::script('assets/ng/controllers/keu/lovSeri.min.js') !!} -->
<!-- {!! Html::script('assets/ng/controllers/keu/lovAccCoa.min.js') !!} -->
<!-- {!! Html::script('assets/ng/controllers/keu/lovCostCenter.min.js') !!} -->
<!--{!! Html::script('assets/ng/controllers/keu/lovNpb.min.js') !!}
{!! Html::script('assets/ng/controllers/keu/lovApCst.min.js') !!}
{!! Html::script('assets/ng/controllers/acc/lovCoa.min.js') !!} -->
<!-- {!! Html::script('assets/ng/controllers/pms/lovPnwr.min.js') !!} -->

@endsection
