@extends('layouts.app')

@section('content-title', 'Tindak Lanjut NCR')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('/home') }}"> Dashboard</a>
            <li> <a href = "{{ url('/ncr_resp') }}"> NCR Response </a>
             <li class= "active"> Edit Tindak Lanjut NCR </li>
        </ul>

        <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="box box-primary" >
                        <div class="box-header">
                            <h3 class="box-title">Data NCR</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-md-10" >
                                <div class="row">
                                    <div class="col-md-3"><p>No. NCR </p></div>
                                    <div class="col-md-9"><p>: {{ ($ncr_data->no_reg_ncr) }}</p></div>
                                </div>
                                                    
                                <div class="row">
                                    <div class="col-md-3"><p>No Reg Inspektor</p></div>
                                    <div class="col-md-9"><p>: {{ ($userinspector->inspector_number) }}</p></div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-3"><p>Tanggal Terbit</p></div>
                                    <div class="col-md-9"><p>: {{ ($ncr_data->publish_date) }}</p></div>
                                </div>
        
                                {{--  <div class="row">
                                    <div class="col-md-3"><p>Identitas Produk</p></div>
                                    <div class="col-md-9"><p>: {{ ($ncr_data->product_identity->identity_description) }}</p></div>
                                </div>  --}}
        
                                <div class="row">
                                    <div class="col-md-3"><p>Nama Proses</p></div>
                                    <div class="col-md-9"><p>: {{ ($ncr_data->process_name) }}</p></div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-3"><p>Nama/Kode Proyek</p></div>
                                    <div class="col-md-9"><p>: {{ ($ncr_data->project->project_code."/".$ncr_data->project->project_description) }}</p></div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-3"><p>Lokasi Ketidaksesuaian</p></div>
                                    <div class="col-md-9"><p>: {{ ($ncr_data->division->division_name) }}</p></div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-3"><p>Acuan Pemeriksaan</p></div>
                                    <div class="col-md-9"><p>: {{ ($ncr_data->reference_inspection) }}</p></div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-3"><p>Jenis Produk</p></div>
                                    <div class="col-md-9"><p>: {{ ($ncr_data->product->product_description) }}</p></div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-3"><p>Uraian Ketidaksesuaian</p></div>
                                        <div class="col-md-9">: {!! ($ncr_data->description_incompatibility) !!}</div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-3"><p>Disposisi Inspektor</p></div>
                                    <div class="col-md-9"><p>: {{ ($ncr_data->disposition_inspector->disposisi_description) }}</p></div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-3"><p>Target Penyelesaian</p></div>
                                    <div class="col-md-9"><p>: {{ ($ncr_data->completion_target) }}</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Tindak Lanjut NCR</h3>
        </div>

        

        <div class="box-body">
            {!! Form::model($ncr_response,['url' => url('ncr_resp/edit/'.$ncr_response->id),
                'method' => 'put' , 'files' => 'true' , 'class' => 'form-horizontal']) !!}
                @include('ncr_response._form_edit')

            {!! Form::close() !!}
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