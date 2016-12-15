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
			<td width="25%" align="left" rowspan="3"><img width="240" height="80" src="images/solopos-fm.png"></td>
			<td width="50%"></td>
			<td width="25%"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td align="left"><h3>NOTA SETORAN BANK</h3></td>
			<td></td>
		</tr>
	</table>

	<div class="line"></div>
	
	<br>
	<br>
	<br>

	<table width="100%">
		<tr>
			<td>Waktu Cetak</td>
			<td width="60%">: {{ $vd->tgl_cetak }}</td>
			<td align="center" valign="top" rowspan="4">
				<strong><p>NOMOR BUKTI</p>{{ $vd->no_bukti }}</strong>
			</td>
		</tr>
		<tr>
			<td>Nama Bank</td>
			<td>: {{ $vd->nama_bank }}</td>
		</tr>
		<tr>
			<td>No. Rekening</td>
			<td>: {{ $vd->coa_id_bank }}</td>
		</tr>
		<tr>
			<td>Coa. ID</td>
			<td>: {{ $vd->coa_id }}</td>
		</tr>
	</table>
		
	<br>
	<br>
	<br>

	<table width="100%" border="1" cellpadding="2" cellspacing="0">
		<tr>
			<td align="center" width="5%">NO</td>
			<td align="center">BANK PENERBIT</td>
			<td align="center">NOMOR SERI</td>
			<td align="center">JATUH TEMPO</td>
			<td align="center">JUMLAH</td>
		</tr>
		<tr>
			<td align="center">1</td>
			<td align="center">{{ $vd->nama_bank }}</td>
			<td align="center">{{ $vd->no_seri }}</td>
			<td align="center">{{ $vd->jatuh_tempo }}</td>
			<td align="right">{{number_format($vd->kredit, 0)}}</td>
		</tr>
		<tr>
			<td align="center" colspan="4">Total</td>
			<td align="right">{{number_format($vd->kredit, 0)}}</td>
		</tr>
	</table>

	<table width="100%" border="1" cellpadding="2" cellspacing="0">
		<tr>
			<td><b>Terbilang : {{ $vd->terbilang }}</b></td>
		</tr>
	</table>

	<div class="footers">
		<table width="100%" border="1" cellpadding="2" cellspacing="0">
			<tr>
				<td width="65%" align="center">Keuangan</td>
				<td width="35%" align="center">Akuntansi</td>
			</tr>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td align="center">Diterima, </td>
							<td align="center">Disetor, </td>
							<td align="center">Diketahui, </td>
							<td align="center">Disetujui, </td>
						</tr>

						<tr>
							<td colspan="4">
								<br><br><br>
							</td>
						</tr>

						<tr>
							<td align="center">Data Entry</td>
							<td align="center">Penerimaan</td>
							<td align="center">Asmen Bendahara</td>
							<td align="center">Manager</td>
						</tr>
					</table>
				</td>
				<td>
					<table width="100%">
						<tr>
							<td align="center">Diterima, </td>
							<td align="center">Dibukukan, </td>
							<td align="center">Diperiksa, </td>
						</tr>

						<tr>
							<td colspan="3">
								<br><br><br>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>	
		</table>
	</div>
	
	<div class="page-break"></div>


@endforeach


