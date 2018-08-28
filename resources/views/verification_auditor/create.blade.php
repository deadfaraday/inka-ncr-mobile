@extends('layouts.app') 
@section('content-title', 'Tindak Lanjut NCR') 
@section('content-subtitle', 'Dashboard') 
@section('content')

<div class="row">
    <div class="col-md-12">
        <ul class="breadcrumb">
            <li>
                <a href="{{ url('/home') }}"> Dashboard</a>
                <li>
                    <li> <a href = "{{ url('home')}}"> Dashboard </a></li>
                    <li> <a href = "{{ url('/auditor_verification') }}"> NCR Auditor Verification </a>
        </ul>

        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Data NCR</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <p>No. NCR </p>
                                </div>
                                <div class="col-md-9">
                                    <p>: {{ ($ncr_data->no_reg_ncr) }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <p>No Reg Inspektor</p>
                                </div>
                                <div class="col-md-9">
                                    <p>: {{ ($userinspector->inspector_number) }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <p>Tanggal Terbit</p>
                                </div>
                                <div class="col-md-9">
                                    <p>: {{ ($ncr_data->publish_date) }}</p>
                                </div>
                            </div>
{{-- 
                            <div class="row">
                                <div class="col-md-3">
                                    <p>Identitas Produk</p>
                                </div>
                                <div class="col-md-9">
                                    <p>: {{ ($ncr_data->product_identity->identity_description) }}</p>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-md-3">
                                    <p>Nama Proses</p>
                                </div>
                                <div class="col-md-9">
                                    <p>: {{ ($ncr_data->process_name) }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <p>Nama/Kode Proyek</p>
                                </div>
                                <div class="col-md-9">
                                    <p>: {{ ($ncr_data->project->project_code."/".$ncr_data->project->project_description)
                                        }}
                                    </p>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-3">
                                    <p>Lokasi Ketidaksesuaian</p>
                                </div>
                                <div class="col-md-9">
                                    <p>: {{ ($ncr_data->division->division_name) }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <p>Acuan Pemeriksaan</p>
                                </div>
                                <div class="col-md-9">
                                    <p>: {{ ($ncr_data->reference_inspection) }}</p>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-3">
                                    <p>Jenis Produk</p>
                                </div>
                                <div class="col-md-9">
                                    <p>: {{ ($ncr_data->product->product_description) }}</p>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-md-3">
                                    <p>Uraian Ketidaksesuaian</p>
                                </div>
                                <div class="col-md-9">: {!! ($ncr_data->description_incompatibility) !!}</div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <p>Disposisi Inspektor</p>
                                </div>
                                <div class="col-md-9">
                                    <p>: {{ ($ncr_data->disposition_inspector->disposisi_description) }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <p>Target Penyelesaian</p>
                                </div>
                                <div class="col-md-9">
                                    <p>: {{ ($ncr_data->completion_target) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="row">
            <section class="col-lg-6 connectedSortable">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Data Tindak Lanjut NCR</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <p>No. NCR </p>
                            </div>
                            <div class="col-md-9">
                                <p>: {{ ($resp_data->ncr_registration->no_reg_ncr) }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <p>No Reg Inspektor</p>
                            </div>
                            <div class="col-md-9">
                                <p>: {{ ($userinspector->inspector_number) }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <p>Akar Masalah</p>
                            </div>
                            <div class="col-md-9">
                                <p>: @if(count($resp_problem)>1) @foreach($resp_problem as $i => $response) {{ ($response->problem_source->description)
                                    }} @if($i+1
                                    < count($resp_problem)) , @endif @endforeach @else {{ ($resp_problem->pluck('problem_source.description')->get(0)) }} @endif
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <p>Uraian Akar Masalah</p>
                            </div>
                            <div class="col-md-9">: {!! ($resp_data->problem_description) !!}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <p>Tindakan Perbaikan</p>
                            </div>
                            <div class="col-md-9">: {!! ($resp_data->corrective_act) !!}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <p>Tindakan Pencegahan</p>
                            </div>
                            <div class="col-md-9">: {!! ($resp_data->preventive_act) !!}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <p>Disposisi Unit Yang Dituju</p>
                            </div>
                            <div class="col-md-9">
                                <p>: {{ ($resp_data->unit_disposition->description) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="col-lg-6 connectedSortable">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Data Verifikasi Inspektor</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <p>Hasil Verifikasi Inspektor</p>
                            </div>
                            <div class="col-md-9">
                                <p>: {{ ($inspector_verification->ver_result->description) }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <p>Keterangan</p>
                            </div>
                            <div class="col-md-9">
                                <p>: {!! $inspector_verification->verification_description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Verifikasi NCR oleh MMLH</h3>
            </div>
            <div class="box-body">

                {!! Form::open(['url' => url('auditor_verification/'.$ncr_id), 'method' => 'put' , 'files' => 'true' , 'class' => 'form-horizontal'])
                !!} @include('verification_auditor._form') {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection 
 
@section('scripts')
<script>
    $('#datepicker_form').datepicker({
        format: "yyyy-mm-dd",
        daysOfWeekHighlighted: "0,6",
        language: "id",
        autoclose: true,
        todayHighlight: true
    });
</script>
@endsection