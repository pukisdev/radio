<table>
	<tr>
		<td align="right" colspan="2">
			{{ $vData->no_kwitansi }}	
		</td>
	</tr>
	<tr>
		<td align="right" colspan="2">
			{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $vData->tgl_kwitansi)->Format('d/m/Y') }}
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<strong>{{ $vData->nama_customer }}</strong>			
		</td>
	</tr>
	<tr>
		<td colspan="2">
			{{ $vData->terbilang }}
		</td>
	</tr>
	<tr>
		<td colspan="2">
			{{ $vData->deskripsi }}
		</td>
	</tr>
	<tr>
		<td colspan="2">
			{{ $vData->nilai_kwitansi }}
		</td>
	</tr>
	<tr>
		<td>
			<ul>
				<li>Pembayaran dengan Cek/Giro dianggap sah apabila sudah diungkapkan oleh Bank kami.</li>
				<li>
					Rekening
					<ul>
						<li>Bank Mandiri Cabang Wisma Bisnis Indonesia a/c 121-008-008-888-7</li>
						<li>BCA Wisma Asia Jakarta a/c 084-308312-6</li>
						<li>Bank Danamon Cabang Pulogadung a/c 0055139810</li>
					</ul>
				</li>
				<li>Mohon dibayar dengan Bilyet Giro atau Cross Cheque atas nama PT. Aksara Grafika Pratama</li>
			</ul>
		</td>
		<td>
			Jakarta, {{ Carbon::now()->Format('d/m/Y') }}
			<br>		
			<br>		
			<br>		
			{{ $vData->sdm_pegawai_mst[0]->nama }}
		</td>
	</tr>
</table>