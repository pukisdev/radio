<head>
	<style>
		.page-break {
		    page-break-after: always;
		    page-break-inside: avoid;
		}
		.footer{
			position: fixed; bottom: 200px;
		}
		.line{
			border-top:1px solid gray;
		}
	</style>
</head>

<body>

<?php 
	$no_bukti 	= ''; 
	$id 		= 1;
?>
@foreach($vData as $index =>$vd)


<?php
	// Beda no bukti, tampilkan ujung view
	if($no_bukti !== $vd->bukti && $no_bukti !== '') {
	$id = 1; 
?>
		<tr>
			<td align="center" colspan="2">Total</td>
			<td align="right">{{number_format($vd->total, 0)}}</td>
		</tr>
	</table>


	<div class="footer">
		<table width="100%" border="1" cellpadding="2" cellspacing="0">
			<tr>
				<td width="48%" align="center" colspan="3">Keuangan</td>
				<td width="20%" align="center">Diterima Oleh</td>
				<td width="32%" align="center" colspan="1">Akuntansi</td>
			</tr>
			<tr>
				<td>
					<table width="100%">
						<tr><td align="center">Dibuat Oleh</td></tr>
						<tr><td><br><br><br></td></tr>
						<tr><td align="center">Data Entry</td></tr>
					</table>
				</td>
				<td>
					<table width="100%">
						<tr><td align="center">Diketahui Oleh</td></tr>
						<tr><td><br><br><br></td></tr>
						<tr><td align="center">Kasir Pembendaharaan</td></tr>
					</table>
				</td>
				<td>
					<table width="100%">
						<tr><td align="center">Disetujui Oleh</td></tr>
						<tr><td><br><br><br></td></tr>
						<tr><td align="center">Kabag</td></tr>
					</table>
				</td>
				<td></td>
				<td>
					<table width="100%">
						<tr>
							<td align="center">Dibukukan Oleh</td>
							<td align="center">Diperiksa Oleh</td>
						</tr>
						<tr><td colspan="2" width="50%"><br><br><br></td></tr>
						<tr>
							<td align="center">Staff</td>
							<td align="center">Kabag</td>
						</tr>
					</table>						
				</td>
			</tr>	
		</table>
	</div>
	
	<div class="page-break"></div>
<?php
	}
?>

<?php
	// awal view & jika no bukti tidak sama
	if($no_bukti !== $vd->bukti) { 
	//if(1==1){
?>		
	<table width="100%">
		<tr>
			<td align="left" rowspan="3"><img src="images/solopos-fm.png"></td>
			<td>Nomor</td>
			<td>: {{ $vd->bukti }}</td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: {{ $vd->tgl_terima }}</td>
		</tr>
	</table>
	

	<div class="line"><h3>NOTA PENERIMAAN</h3></div>
	<br>
	<br>
	<br>

		
	<table width="100%">
		<tr>
			<td>Keterangan</td>
			<td>: </td>
			<td align="right">Rp. {{number_format($vd->total, 0)}}</td>
		</tr>
		
		<tr>
			<td>Jenis Transaksi</td>
			<td colspan="2">: TUNAI</td>
		</tr>

		<tr>
			<td>Relasi</td>
			<td colspan="2">: {{ $vd->kode_customer }}/{{ $vd->customer }}</td>
		</tr>

		<tr>
			<td>Katerori</td>
			<td colspan="2">: {{ $vd->keterangan }}</td>
		</tr>

		<tr>
			<td>Terbilang</td>
			<td colspan="2">: {{ $vd->terbilang }}</td>
		</tr>	
	</table>	

	<br>
	<br>
	<br>

	Untuk Penerimaan sebagai berikut : 


	<table width="100%" border="1" cellpadding="2" cellspacing="0">
		<tr>
			<td align="center" width="5%">No</td>
			<td align="center" width="70%">Keterangan</td>
			<td align="center">Jumlah</td>
		</tr>

		<tr>
			<td align="center">{{ $id }}</td>
			<td>{{ $vd->keterangan }}</td>
			<td align="right">{{number_format($vd->jumlah, 0)}}</td>
		</tr>

			

	<?php
		}
		// jika no bukti sama, tambah detail view
		else{
	?>
		<tr>
			<td align="center">{{ $id }}</td>
			<td>{{ $vd->keterangan }}</td>
			<td align="right">{{number_format($vd->jumlah, 0)}}</td>
		</tr>
	<?php
		}
	?>

	<?php	
		$no_bukti = $vd->bukti;
		$id++;
	?>

@endforeach

<tr>
			<td align="center" colspan="2">Total</td>
			<td align="right">{{number_format($vd->total, 0)}}</td>
		</tr>
	</table>


	<div class="footer">
		<table width="100%" border="1" cellpadding="2" cellspacing="0">
			<tr>
				<td width="48%" align="center" colspan="3">Keuangan</td>
				<td width="20%" align="center">Diterima Oleh</td>
				<td width="32%" align="center" colspan="1">Akuntansi</td>
			</tr>
			<tr>
				<td>
					<table width="100%">
						<tr><td align="center">Dibuat Oleh</td></tr>
						<tr><td><br><br><br></td></tr>
						<tr><td align="center">Data Entry</td></tr>
					</table>
				</td>
				<td>
					<table width="100%">
						<tr><td align="center">Diketahui Oleh</td></tr>
						<tr><td><br><br><br></td></tr>
						<tr><td align="center">Kasir Pembendaharaan</td></tr>
					</table>
				</td>
				<td>
					<table width="100%">
						<tr><td align="center">Disetujui Oleh</td></tr>
						<tr><td><br><br><br></td></tr>
						<tr><td align="center">Kabag</td></tr>
					</table>
				</td>
				<td></td>
				<td>
					<table width="100%">
						<tr>
							<td align="center">Dibukukan Oleh</td>
							<td align="center">Diperiksa Oleh</td>
						</tr>
						<tr><td colspan="2" width="50%"><br><br><br></td></tr>
						<tr>
							<td align="center">Staff</td>
							<td align="center">Kabag</td>
						</tr>
					</table>						
				</td>
			</tr>	
		</table>
	</div>