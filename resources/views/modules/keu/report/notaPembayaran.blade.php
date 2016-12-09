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

@foreach($vData as $index =>$vd)

	<table width="100%">
		<tr>
			<td align="left" colspan="2"><img src="images/solopos-fm.png"></td>
			<td align="right">
				<table>
					<tr>
						<td>Nomor</td>
						<td>: {{ $vd->no_bukti }}</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>: {{ $vd->tgl_cetak }}</td>
					</tr>
					<tr>
						<td>Reff. PPb</td>
						<td>:</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr><td colspan="3" align="center"><h3>NOTA PEMBAYARAN</h3></td></tr>

		<tr>
			<td align="center">
				<input type="checkbox" @if($vd->k == 'X') checked @endif > Kas
			</td>
			<td align="center">
				<input type="checkbox" @if($vd->b == 'X') checked @endif> Bank
			</td>
			<td align="center">
				<input type="checkbox" @if($vd->c_g_tt == 'X') checked @endif> Cek/Giro/TT
			</td>
		</tr>
		
		<tr>
			<td colspan="3">
				<div class="line"></div>
				<br>
				<br>
				<br>
			</td>
		</tr>
		

		<tr>
			<td>Dibayarkan Kepada</td>
			<td>: {{ $vd->di_customer}}</td>
			<td align="right">Rp. {{number_format($vd->total, 0)}}</td>
		</tr>
		
		<tr>
			<td>Terbilang</td>
			<td colspan="2">: {{ $vd->terbilang }}</td>
		</tr>	
		
		<tr>
			<td colspan="3">
				<br>
				<br>
				<br>
			</td>
		</tr>
		

		<tr>
			<td colspan="3">
				<table width="100%" border="1" cellpadding="2" cellspacing="0">
					<tr>
						<td align="center" width="5%">No</td>
						<td align="center">Keterangan</td>
						<td align="center">No. Perkiraan</td>
						<td align="center">Jumlah</td>
					</tr>
					<tr>
						<td align="center">1</td>
						<td colspan="2">{{ $vd->keterangan }}</td>
						<td align="right">{{number_format($vd->total, 0)}}</td>
					</tr>
					<tr>
						<td align="center" colspan="3">Total</td>
						<td align="right">{{number_format($vd->total, 0)}}</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<div class="footer">
		<table width="100%">
		<tr>
			<td colspan="3">
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
								<tr><td align="center">Staf/kasir</td></tr>
							</table>
						</td>
						<td colspan="2">
							<table width="100%">
								<tr><td colspan="2" align="center" width="50%">Disetujui Oleh</td></tr>
								<tr><td colspan="2" width="50%"><br><br><br></td></tr>
								<tr>
									<td align="center">Kabag</td>
									<td align="center">Direktur</td>
								</tr>
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
			</td>
		</tr>
	</table>
	</div>
	
	<div class="page-break"></div>


@endforeach


