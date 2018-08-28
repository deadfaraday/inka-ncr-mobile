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
		<td>: {{ $userinspector->inspector_number }}</td>
	</tr>
	<tr>
		<td height="15">Tgl. Terbit (dd/mm/yyyy)</td>
		<td>: {{ $publish_date }}</td>
	</tr>	
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td width="130">Nama Produk/Proses :</td>
		<td width="110" style="border-bottom: 1px solid black; border-left: 1px solid black; border-collapse: collapse;">Nama/Kode Proyek</td>
		<td style="border-bottom: 1px solid black;">: {{ $printpdf->project->project_code }}/{{ $printpdf->project->project_description }}</td>
		<td rowspan="3" width="55" style="border-bottom: 1px solid black; border-left: 1px solid black; border-collapse: collapse;">{{ $printpdf->product->product_description }}</td>
		<!--<td width="15" style="border-bottom: 1px solid black;"><i class="fa fa-check"></i></td>-->
	</tr>
	<tr>
		<td width="130" rowspan="2">{{ $printpdf->process_name }}</td>
		<td style="border-bottom: 1px solid black; border-left: 1px solid black; border-collapse: collapse;">Lokasi/Unit Ketidaksesuaian</td>
		@if(is_null($vendor_name))
			<td style="border-bottom: 1px solid black;">:  {{ $printpdf->division->division_name }}</td>
		@else
			<td style="border-bottom: 1px solid black;">:  {{ $printpdf->division->division_name . '/' . $vendor_name }}</td>
		@endif<!--<td style="border-bottom: 1px solid black; border-left: 1px solid black; border-collapse: collapse;"></td>
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
		<td colspan="6" style="font-weight: bold;">Uraian Ketidaksesuaian :</td>
	</tr>
	<tr>
		<td colspan="6"> {!! $printpdf->description_incompatibility !!}</td>
	</tr>
	<tr>
		<td colspan="6"><i>Person In Charge</i> (PIC) : {{ $printpdf->person_in_charge }}</td>
	</tr>
	<tr>
		<td width="118">Kategori Ketidaksesuaian* : </td>
		
		<td colspan="4" width="74">{{$printpdf->inc_category->description}}</td>
		<td></td> 
	</tr>
	<tr>
		<td colspan="6" style="font-weight: bold;">Disposisi Inspektor : {{ $printpdf->disposition_inspector->disposisi_description }}</td>
	</tr>
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td>Target Tanggal Penyelesaian : {{ $printpdf->completion_target }}</td>
	</tr>
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td align="center" width="50%" style="font-weight: bold;">{{ $printpdf->division->division_name }}</td>
		<td align="center" width="50%" style="font-weight: bold;">QC Inspector</td>
	</tr>
	<tr>
		@if(!is_null($division))
			<td align="center" width="50%" style="font-weight: bold;">{{ $division->division_name }}</td>
			<td align="center" width="50%" style="font-weight: bold;"></td>
		@elseif(is_null($division))
			<td align="center" width="50%" style="font-weight: bold;"></td>
			<td align="center" width="50%" style="font-weight: bold;"></td>
		@endif	
	</tr>
	<tr>
		<td align="center"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(75)->generate($ttd_unit))!!} "></td>
		<td align="center"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(75)->generate($ttd_inspektor))!!} "></td>
	</tr>
	
	<tr>
		<td align="center" style="font-weight: bold;">..........................................</td>
		<td align="center" style="font-weight: bold;">{{ $printpdf->user->name }}</td>
	</tr>
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td>Akar Masalah*:</td>
		<td colspan="10">
		@if(count($resp_problem)>1)
            @foreach($resp_problem as $i => $response)
                {{ ($response->problem_source->description) }}
                @if($i < count($response))
                    ,
                @endif
            @endforeach
        @else
            {{ ($resp_problem->pluck('problem_source.description')->get(0)) }}
        @endif
        </td>
		<!-- <td width="10"><i class="fa fa-square"></i></td>
		<td style="font-weight: bold;">Personil</td>
		<td width="10"><i class="fa fa-square"></i></td>
		<td style="font-weight: bold;">Metode</td>
		<td width="10"><i class="fa fa-square"></i></td>
		<td style="font-weight: bold;">Material</td>
		<td width="10"><i class="fa fa-square"></i></td>
		<td style="font-weight: bold;">Mesin/Tool</td>
		<td width="10"><i class="fa fa-square"></i></td>
		<td style="font-weight: bold;">Lain-lain</td> -->
	</tr>
	<tr>
		<td colspan="11" style="font-weight: bold;">Uraian akar masalah*:</td>
	</tr>
	<tr>
		<td colspan="11">{!! ($ncr_resp->problem_description) !!}</td>
	</tr>
	<tr>
		<td colspan="11" style="font-weight: bold;">Tindakan Perbaikan*:</td>
	</tr>
	<tr>
		<td colspan="11">{!! ($ncr_resp->corrective_act) !!}</td>
	</tr>
	<tr>
		<td colspan="7"></td>
		<td colspan="4">Tanggal Penyelesaian : {{ ($ncr_resp->corrective_est_date) }}</td>
	</tr>
	<tr>
		<td colspan="11" style="font-weight: bold;">Tindakan Pencegahan*:</td>
	</tr>
	<tr>
		<td colspan="11">{!! ($ncr_resp->preventive_act) !!}</td>
	</tr>
	<tr>
		<td colspan="7"></td>
		<td colspan="4">Tanggal Penyelesaian : {{ ($ncr_resp->preventive_est_date) }}</td>
	</tr>
	<tr>
		<td width="120" style="font-weight: bold;">Disposisi Unit yang dituju* :</td>
		{{-- <td colspan="6" style="font-weight: bold;">{{ ($ncr_resp->unit_disposition->description) }}</td> --}}
		@if($ncr_resp->unit_disposition->description == 'MRB')
			<td colspan="2" style="font-weight: bold;"><u>Mayor:</u></td>
			<td colspan="6">{{ ($ncr_resp->unit_disposition->description) }}</td>
		@else
			<td colspan="2" style="font-weight: bold;"><u>Minor:</u></td>
			<td colspan="6">{{ ($ncr_resp->unit_disposition->description) }}</td>
		@endif
		
		<td colspan="2"></td>
	</tr>
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td width="50%">Senior Manager/Manager * : ................................</td>
		<td width="50%">Tanggal * : ...................................</td>
	</tr>
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%;">
	<tr>
		<td style="border-bottom: 1px solid black; font-weight: bold;">Disposisi MRB :</td>
		<td style="border-bottom: 1px solid black"></td>
		@if(is_null($ncr_resp->mrb_disposition))
			<td style="border-bottom: 1px solid black" width="10"><i class="fa fa-square"></i></td>
			<td style="border-bottom: 1px solid black">Use as is</td>
			<td style="border-bottom: 1px solid black" width="10"><i class="fa fa-square"></i></td>
			<td style="border-bottom: 1px solid black">Scrap</td>
			<td style="border-bottom: 1px solid black" width="10"><i class="fa fa-square"></i></td>
			<td style="border-bottom: 1px solid black">Repair</td>
			<td style="border-bottom: 1px solid black" width="10"><i class="fa fa-square"></i></td>
			<td style="border-bottom: 1px solid black">Rework</td>
			<td style="border-bottom: 1px solid black" width="10"><i class="fa fa-square"></i></td>
			<td style="border-bottom: 1px solid black">RTS</td>
		@else
			<td colspan="10" style="border-bottom: 1px solid black; text-align: left;">{{ ($ncr_resp->mrb_disposition->description) }}</td>
		@endif
	</tr>
	<tr>
		<td colspan="6" style="font-weight: bold;">Departemen yang menindaklanjuti hasil MRB :</td>
		<td colspan="6" align="center" style="font-weight: bold;">Disetujui oleh :</td>
	</tr>
	@if(is_null($ncr_resp->mrb_disposition))
		<tr>
			<td colspan="6">1.</td>
			{{-- <td colspan="3"></td> --}}
			<td colspan="6">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="6">2.</td>
			{{-- <td colspan="3"></td> --}}
			<td rowspan="3" colspan="6">GM Pengendalian Kualitas : ..............................
				<br>
				<br>
				Tanggal : ..............................
			</td>
		</tr>
		<tr>
			<td colspan="6">3.</td>
			{{-- <td colspan="3"></td> --}}
			{{-- <td colspan="6">&nbsp;</td> --}}
		</tr>
		<tr>
			<td colspan="6">4.</td>
			{{-- <td colspan="3"></td> --}}
			{{-- <td colspan="6"></td> --}}
		</tr>
	@else
		@if(count($mrb_unit) == 1)
			<tr>
				<td colspan="6">1. {{ ($mrb_unit->pluck('division.division_name'))->get(0) }}</td>
				{{-- <td colspan="3"></td> --}}
				<td colspan="6">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6">2.</td>
				{{-- <td colspan="3"></td> --}}
				<td rowspan="3" colspan="6">GM Pengendalian Kualitas : ..............................
					<br>
					<br>
					Tanggal : ..............................
				</td>
			</tr>
			<tr>
				<td colspan="6">3.</td>
				{{-- <td colspan="3"></td> --}}
				{{-- <td colspan="6">&nbsp;</td> --}}
			</tr>
			<tr>
				<td colspan="6">4.</td>
				{{-- <td colspan="3"></td> --}}
				{{-- <td colspan="6"></td> --}}
			</tr>
		@else
			<tr>
				<td colspan="6">1. {{ ($mrb_unit->pluck('division.division_name'))->get(0) }}</td>
				{{-- <td colspan="3"></td> --}}
				<td colspan="6">&nbsp;</td>
			</tr>
			@foreach($mrb_unit as $i => $unit)
				@if($i>0)
					@if($i==1)
						@if(is_null($count))
							<tr>
								<td colspan="6">{{ ($i+1)." ".($unit->division->division_name) }}</td>
								{{-- <td colspan="3"></td> --}}
								<td rowspan="3" colspan="6">GM Pengendalian Kualitas : ..............................
									<br>
									<br>
									Tanggal : ..............................
								</td>
							</tr>
						@else
							<tr>
								<td colspan="6">{{ ($i+1)." ".($unit->division->division_name) }}</td>
								{{-- <td colspan="3"></td> --}}
								<td rowspan="{{ $count+3 }}" colspan="6">GM Pengendalian Kualitas : ..............................
									<br>
									<br>
									Tanggal : ..............................
								</td>
							</tr>
						@endif
					@elseif($i>1)
						<tr>
							<td colspan="6">{{ ($i+1)." ".($unit->division->division_name) }}</td>
							{{-- <td colspan="3" style="font-weight: bold;"></td>
							<td colspan="6" style="border-left: 1px solid black">&nbsp;</td> --}}
						</tr>
					@endif
				@endif
			@endforeach
		@endif
	@endif
</table>
<table style="border: 1px solid black; border-collapse: collapse; font-size: 9.2pt; width: 100%; margin-right: -3px">
	<tr>
		<td colspan="4" style="font-weight: bold; border-right: 1px solid black;">Verifikasi atas tindakan perbaikan : </td>
		<td colspan="4" style="font-weight: bold;">Verifikasi atas tindakan pencegahan :</td>
	</tr>
	<tr>
		<td colspan="4" style="border-right: 1px solid black;">{!! $inspector_verification->verification_description !!}</td>
		<td colspan="4">{!! $auditor_verification->verification_description!!}</td>
	</tr>
	{{-- <tr>
		<td colspan="4" style="border-right: 1px solid black;">&nbsp;</td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4" style="border-right: 1px solid black; border-bottom: 1px solid black;">&nbsp;</td>
		<td colspan="4" style="border-bottom: 1px solid black;">&nbsp;</td>
	</tr> --}}
	<tr>
		<td colspan="4" align="center" style="border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; font-weight: bold;">Verifikasi oleh Inspektor</td>
		<td colspan="4" align="center" style="border-top: 1px solid black; border-bottom: 1px solid black;font-weight: bold;">Verifikasi oleh MMLH</td>
	</tr>
	<tr>
		<td>Tanggal</td>
		<td width="70">: {{ $inspector_ver_date }}</td>
		<td colspan="2" align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; font-weight: bold;">Hasil Verifikasi</td>
		<td>Tanggal</td>
		<td width="70">: {{ $auditor_ver_date }}</td>
		<td colspan="2" align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; font-weight: bold;">Hasil Verifikasi</td>
	</tr>
	<tr>
		<td width="70">Nama & Tanda Tangan</td>
		<td></td>
		{{--  <td width="10" style="border-bottom: 1px solid black; border-left: 1px solid black;"><i class="fa fa-square"></i></td>  --}}
		<td colspan="2" width="130" rowspan="2" style="border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">{{ $inspector_verification->ver_result->description }}</td>
		<td width="70">Nama & Tanda Tangan</td>
		<td></td>
		{{--  <td width="10" style="border-bottom: 1px solid black; border-left: 1px solid black;"><i class="fa fa-square"></i></td>  --}}
		{{--  <td style="border-bottom: 1px solid black; border-right: 1px solid black;">{{ $auditor_verification->ver_result->description }}</td>  --}}
		<td colspan="2" width="130" rowspan="2" style="border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">{{ $auditor_verification->ver_result->description }}</td>
		
	</tr>
	<tr>
		<td colspan="2"></td>
		{{--  <td width="10" style="border-bottom: 1px solid black; border-left: 1px solid black;"><i class="fa fa-square"></i></td>
		<td style="border-bottom: 1px solid black; border-right: 1px solid black;">Tidak Efektif</td>    --}}
		<td colspan="2"></td>
		{{--  <td width="10" style="border-bottom: 1px solid black; border-left: 1px solid black;"><i class="fa fa-square"></i></td>
		<td style="border-bottom: 1px solid black; border-right: 1px solid black;">Tidak Efektif</td>  --}}
	</tr>
	<tr>
		<td colspan="2" align="center">{{ $printpdf->user->name }}</td>
		<td colspan="2" style="border-bottom: 1px solid black; border-left: 1px solid black;border-right: 1px solid black;">Terbit NCR baru no. .................</td>
		<td colspan="2">{{ $auditor_verification->auditor->name }}</td>
		<td colspan="2" style="border-bottom: 1px solid black; border-left: 1px solid black;border-right: 1px solid black;">Terbit CAR baru no. .................</td>
	</tr>
</table>
<table style="font-size: 9.2pt; font-weight: bold;">
	<tr>
		<td>*Diisi oleh Pimpinan Unit yang di NCR (min. Supervisor)</td>
	</tr>
	<tr>
		<td>Form No. : IV-01.012. Rev G</td>
	</tr>
</table>
<table style="font-size: 8pt; width: 100%">
	<tr>
		<td width="55%">Lembar 1 (Warna Putih) : Untuk arsip (Dal Kualitas)</td>
		<td width="45%">Lembar 3 (Warna Kuning) : Untuk arsip inspektor</td>
	</tr>
	<tr>
		<td>Lembar 2 (Warna Hijau) : Untuk arsip Rendal Log/Rendal Prod</td>
		<td>Lembar 4 (Warna Merah) : Untuk pemasok</td>	
	</tr>
</table>

</body>
</html>