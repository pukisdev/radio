@extends('templates.layouts.pdf-gentalella')

@section('content')

<div class="col-md-10 col-sm-10 col-xs-12">
<table align="center">
    <tr><th align="center"><h3>Ringkasan Daftar Pesanan Penjualan</h3></th></tr>
    <tr><th align="center">Dari {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $from)->Format('d M Y') }} ke {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $to)->Format('d M Y') }}</th></tr>
</table>    
<table class="table">
<thead>
    <tr>
        <th>#</th>
        <th>Tanggal Pesan</th>
        <th>No Pesanan</th>
        <th>Account Officer</th>
        <th>Akhir Tayang</th>
        <th>Nama Pelanggan</th>
        <th>Status</th>
        <th>No. PO</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
    </tr>
</thead>
<tbody>
    @foreach($vData as $index=>$isi)
    <tr>
        <th scope="row">{{$index+1}}</th>
        <td>{{$isi->tgl_penawaran}}</td>
        <td>{{$isi->id_pnwr}}</td>
        <td>{{$isi->f_ae}}</td>
        <td></td>
        <td>{{$isi->f_customer}}</td>
        <td>{{$isi->pnwr_status}}</td>
        <td>{{$isi->no_po_customer}}</td>
        <td>{{$isi->keterangan}}</td>
    </tr>
    @endforeach
</tbody>
</table>
@endsection