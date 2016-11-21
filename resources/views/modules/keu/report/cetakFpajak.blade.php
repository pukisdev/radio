
<table>
	<tr>
		<td align="center">FAKTUR PAJAK</td>
	</tr>
</table>

<table border="1" cellpadding="1" cellspacing="0">
	<tr>
		<td colspan="4">Nomor Seri Faktur Pajak : {{ $vData[0]['depan_fpajak'] }}-{{ substr($vData[0]['no_kwitansi'], -2) }}.{{ $vData[0]['no_fpajak'] }}</td>
	</tr>
	<tr>
		<td colspan="4"><strong>Pengusaha Kena Pajak</strong></td>
	</tr>
	<tr>
		<td colspan="4">
			<table>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>{{ $vData2->nama_perusahaan }}</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td>{{ $vData2->alamat }}</td>
				</tr>
				<tr>
					<td>NPWP</td>
					<td>:</td>
					<td>{{ $vData2->npwp }}</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4"><strong>Pembeli Kena Pajak / Penerima Jasa Kena Pajak</strong></td>
	</tr>
	<tr>
		<td colspan="4">
			<table>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>{{ $vData[0]['nama_customer']}}</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td>{{ $vData[0]['alamat1']}}</td>
				</tr>
				<tr>
					<td>NPWP</td>
					<td>:</td>
					<td>{{ $vData[0]['npwp']}}</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><strong>No Urut</strong></td>
		<td colspan="2"><strong>Nama Barang Kena Pajak / Jasa Kena Pajak</strong></td>
		<td><strong>Harga Jual / Penggantian / Uang Muka / Termin (Rp.)</strong></td>
	</tr>
	<?php
		$total 				= 0; 
		$total_uang_muka	= 0;
		$total_potongan		= 0;
		$total_pajak		= 0;
		$total_ppn			= 0;
	?>	
	@foreach($vData as $index => $vD)
		<tr>
			<td>{{ $index+1 }}</td>
			<td colspan="2">{{ $vD['keterangan'] }}</td>
			<td align="right">{{ number_format($vD['nilai_hpp'], 2) }}</td>
		</tr>
		<?php
			$total = $total + $vD['nilai_hpp'];	
			$total_uang_muka = $total_uang_muka;	
			$total_potongan = $total_potongan + $vD['nilai_potongan'];	
			$total_pajak = $total_pajak + ($vD['nilai_hpp'] - $vD['nilai_potongan']);	
			$total_ppn = $total_ppn + $vD['nilai_ppn'];
		?>	
	@endforeach
	<tr>
		<td></td>
		<td colspan="2" >No Kwitansi : {{ $vD['no_kwitansi'] }}</td>
		<td></td>
	</tr>
	<tr>
		<td colspan="3">Harga Jual</td>
		<td align="right">{{ $total }}</td>
	</tr>
	<tr>
		<td colspan="3">Dikurangi Potongan Harga</td>
		<td align="right">{{ $total_potongan }}</td>
	</tr>
	<tr>
		<td colspan="3">Dikurangi Uang Muka yang telah diterima</td>
		<td align="right">{{ $total_uang_muka }}</td>
	</tr>
	<tr>
		<td colspan="3">Dasar Pengenaan Pajak</td>
		<td align="right">{{ $total_pajak }}</td>
	</tr>
	<tr>
		<td colspan="3">PPN = 10% x Dasar Pengenaan Pajak</td>
		<td align="right">{{ $total_ppn }}</td>
	</tr>
</table>

<br>
<br>
Pajak Penjualan Atas Barang Mewah

<table width="100%">
	<tr>
		<td>
			<table border="1" cellpadding="1" cellspacing="0">
				<tr>
					<td>Tarif</td>
					<td>DPP</td>
					<td>PPn BM</td>
				</tr>			
				<tr>
					<td>....%</td>
					<td>Rp. ....</td>
					<td>Rp. ....</td>
				</tr>			
				<tr>
					<td colspan="2">Total</td>
					<td>Rp. ....</td>
				</tr>			
			</table>
		</td>
		<td>
			Jakarta, {{ Carbon::now()->Format('d/m/Y') }}



		</td>
	</tr>
</table>