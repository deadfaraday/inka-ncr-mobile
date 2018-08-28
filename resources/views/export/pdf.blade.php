<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="{{ asset('/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<style>
	.fa-check:before {
	            font-family: DejaVu Sans;
	            content: "\2611";
	            color:black;
	            font-size:1.2rem;
	}
	.fa-square:before {
	            font-family: DejaVu Sans;
	            content: "\2610";
	            color:black;
	            font-size:1.2rem;
	}
	table {
		margin-left: -15px;
		margin-right: -15px;
	}
	</style>
</head>
<body>

<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%; font-weight: bold;">
	<tr>
		<td rowspan="3" width="130" height="15" style="border: 1px solid black; border-collapse: collapse; text-align: center;"><img src="{{ public_path().'/images/cropped-logo3.png' }}" width="160" height="45"></td>
		<td rowspan="3" style="border: 1px solid black; border-collapse: collapse; text-align: center; font-size: 10pt">LAPORAN KETIDAKSESUAIAN PRODUK <br> <i style="font-size: 8pt"> NONCONFORMITY REPORT FOR PRODUCT (NCR)</i> </td>
		<td width="103">No. NCR (xxx)</td>
		<td width="100">: {{ $printpdf->no_reg_ncr }}</td>
	</tr>
	<tr>	
		<td height="15">No. Reg. Inspektor</td>
		<td>: {{ $printpdf->user_id }}</td>
	</tr>
	<tr>
		<td height="15">Tgl. Terbit (dd/mm/yyyy)</td>
		<td>:  {{ $printpdf->publish_date }}</td>
	</tr>	
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td width="65">Identitas Produk</td>
		<td width="110">: {{ $printpdf->product_identity->identity_description }}</td>
		<td width="110" style="border-bottom: 1px solid black; border-left: 1px solid black; border-collapse: collapse;">Nama/Kode Proyek</td>
		<td style="border-bottom: 1px solid black;">: {{ $printpdf->project->project_code }}</td>
		<td rowspan="3" width="55" style="border-bottom: 1px solid black; border-left: 1px solid black; border-collapse: collapse;">{{ $printpdf->product->product_description }}</td>
		<!--<td width="15" style="border-bottom: 1px solid black;"><i class="fa fa-check"></i></td>-->
	</tr>
	<tr>
		<td rowspan="2">Nama Proses</td>
		<td rowspan="2">: {{ $printpdf->process_name }}</td>
		<td style="border-bottom: 1px solid black; border-left: 1px solid black; border-collapse: collapse;">Lokasi/Unit Ketidaksesuaian</td>
		<td style="border-bottom: 1px solid black;">:  {{ $printpdf->division->division_name }}</td>
		<!--<td style="border-bottom: 1px solid black; border-left: 1px solid black; border-collapse: collapse;"></td>
		<td style="border-bottom: 1px solid black;"><i class="fa fa-square"></i></td>-->
	</tr>
	<tr>
		<td style="border-bottom: 1px solid black; border-left: 1px solid black; border-collapse: collapse;">Acuan Pemeriksaan</td>
		<td style="border-bottom: 1px solid black;">: {{ $printpdf->reference_inspection }}</td>
		<!--<td style="border-bottom: 1px solid black; border-left: 1px solid black; border-collapse: collapse;"></td>
		<td style="border-bottom: 1px solid black;"><i class="fa fa-square"></i></td>-->
	</tr>
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td style="font-weight: bold;">Uraian Ketidaksesuaian :</td>
	</tr>
	<tr>
		<td> {{ $printpdf->description_incompatibility }}&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="font-weight: bold;">Disposisi Inspektor : {{ $printpdf->disposition_inspector->disposisi_description }}</td>
	</tr>
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td style="font-weight: bold;">Target Tanggal Penyelesaian : {{ $printpdf->completion_target }}</td>
	</tr>
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td align="center" width="50%" style="font-weight: bold;">Unit yang dituju*</td>
		<td align="center" width="50%" style="font-weight: bold;">QC Inspektor</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td align="center" style="font-weight: bold;">Text</td>
		<td align="center" style="font-weight: bold;">{{ $printpdf->user->name }}</td>
	</tr>
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td style="font-weight: bold;">Akar Masalah*:</td>
		<td width="10"><i class="fa fa-check"></i></td>
		<td style="font-weight: bold;">Personil</td>
		<td width="10"><i class="fa fa-square"></i></td>
		<td style="font-weight: bold;">Metode</td>
		<td width="10"><i class="fa fa-square"></i></td>
		<td style="font-weight: bold;">Material</td>
		<td width="10"><i class="fa fa-square"></i></td>
		<td style="font-weight: bold;">Mesin/Tool</td>
		<td width="10"><i class="fa fa-square"></i></td>
		<td style="font-weight: bold;">Lain-lain</td>
	</tr>
	<tr>
		<td colspan="11" style="font-weight: bold;">Uraian akar masalah*:</td>
	</tr>
	<tr>
		<td colspan="11">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="11">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="11">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="11" style="font-weight: bold;">Tindakan Perbaikan*:</td>
	</tr>
	<tr>
		<td colspan="11">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="11">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="11">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="11" style="font-weight: bold;">Tindakan Pencegahan*:</td>
	</tr>
	<tr>
		<td colspan="11">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="11">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="11">&nbsp;</td>
	</tr>
	<tr>
		<td width="100" style="font-weight: bold;">Disposisi unit yang dituju</td>
		<td width="10"><i class="fa fa-check"></i></td>
		<td style="font-weight: bold;">Repair</td>
		<td width="10"><i class="fa fa-square"></i></td>
		<td style="font-weight: bold;">Reject</td>
		<td width="10"><i class="fa fa-square"></i></td>
		<td style="font-weight: bold;">MRB</td>
		<td colspan="4"></td>
	</tr>
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td style="border-bottom: 1px solid black; font-weight: bold;">Disposisi MRB :</td>
		<td style="border-bottom: 1px solid black"></td>
		<td style="border-bottom: 1px solid black" width="10"><i class="fa fa-check"></i></td>
		<td style="border-bottom: 1px solid black; font-weight: bold;">Use as is</td>
		<td style="border-bottom: 1px solid black" width="10"><i class="fa fa-square"></i></td>
		<td style="border-bottom: 1px solid black; font-weight: bold;">Scrap</td>
		<td style="border-bottom: 1px solid black" width="10"><i class="fa fa-square"></i></td>
		<td style="border-bottom: 1px solid black; font-weight: bold;">Repair</td>
		<td style="border-bottom: 1px solid black" width="10"><i class="fa fa-square"></i></td>
		<td style="border-bottom: 1px solid black; font-weight: bold;">Rework</td>
		<td style="border-bottom: 1px solid black" width="10"><i class="fa fa-square"></i></td>
		<td style="border-bottom: 1px solid black; font-weight: bold;">RTS</td>
	</tr>
	<tr>
		<td colspan="6" style="font-weight: bold;">Departemen Yang Menindaklanjuti :</td>
		<td colspan="6" align="center" style="border-left: 1px solid black; font-weight: bold;">Disetujui oleh :</td>
	</tr>
	<tr>
		<td colspan="3" style="font-weight: bold;">1.</td>
		<td colspan="3" style="font-weight: bold;">5.</td>
		<td colspan="6" align="center" style="border-left: 1px solid black; font-weight: bold;">GM Pengendalian Kualitas</td>
	</tr>
	<tr>
		<td colspan="3" style="font-weight: bold;">2.</td>
		<td colspan="3" style="font-weight: bold;">6.</td>
		<td colspan="6" style="border-left: 1px solid black">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" style="font-weight: bold;">3.</td>
		<td colspan="3" style="font-weight: bold;">7.</td>
		<td colspan="6" style="border-left: 1px solid black">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" style="font-weight: bold;">4.</td>
		<td colspan="3" style="font-weight: bold;">8.</td>
		<td colspan="6" style="border-left: 1px solid black">&nbsp;</td>
	</tr>
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td style="font-weight: bold;">Verifikasi atas tindakan perbaikan</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%; margin-right: -3px;">
	<tr>
		<td colspan="4" align="center" style="border-bottom: 1px solid black; border-right: 1px solid black; font-weight: bold;">Verifikasi oleh inspektor</td>
		<td colspan="1" width="257" style="font-weight: bold;">Lampiran :</td>
	</tr>
	<tr>
		<td width="50" style="border-bottom: 1px solid black; font-weight: bold;">Tanggal</td>
		<td style="border-bottom: 1px solid black;">: Text</td>
		<td colspan="2" align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; font-weight: bold;">Hasil Verifikasi</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" style="font-weight: bold;">Nama & Tanda Tangan</td>
		<td width="10" style="border-bottom: 1px solid black; border-left: 1px solid black;"><i class="fa fa-check"></i></td>
		<td width="130" style="border-bottom: 1px solid black; border-right: 1px solid black; font-weight: bold;">Efektif</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td style="border-bottom: 1px solid black; border-left: 1px solid black;"><i class="fa fa-square"></i></td>
		<td style="border-bottom: 1px solid black; border-right: 1px solid black; font-weight: bold;">Tidak Efektif</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td colspan="2" style="border-bottom: 1px solid black; border-left: 1px solid black;border-right: 1px solid black; font-weight: bold;">Terbit NCR baru no.</td>
		<td>&nbsp;</td>
	</tr>
</table>
<table style="font-size: 9.2pt; font-weight: bold;">
	<tr>
		<td>*Diisi oleh Pimpinan unit(min. Supervisor)</td>
	</tr>
	<tr>
		<td>Form No. : IV-01.012. Rev E</td>
	</tr>
</table>
<table style="font-size: 8pt; width: 100%">
	<tr>
		<td width="65%">Lembar 1 (warna putih)  : untuk arsip (Dal Kualitas)</td>
		<td width="35%">Lembar 2 (warna merah)  : untuk pemasok</td>
	</tr>
	<tr>
		<td>Lembar 3 (warna hijau)  : untuk arsip Rendal/Log/Rendal/Prod</td>
		<td>Lembar 4 (warna kuning) : untuk arsip inspektor</td>	
	</tr>
</table>

</body>
</html>