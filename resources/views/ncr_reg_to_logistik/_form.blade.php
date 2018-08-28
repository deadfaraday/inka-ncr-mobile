@section('styles')
<style type="text/css">
    .help-block {
        color: #a94442;
    }
</style>
@endsection


<div class="form-group{{ $errors->has('process_name') ? 'has-error': '' }} ">
    {!! Form::label('process_name', 'Nama Produk/Proses', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('process_name', null, ['class'=>'form-control']) !!} {!! $errors->first('process_name', '
        <p class="help-block">:message</p>') !!}

    </div>
</div>

<div class="form-group{{ $errors->has('master_project_id') ? 'has-error': '' }} ">
    {!! Form::label('master_project_id', 'Nama/Kode Proyek', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-5">
        {!! Form::select ('master_project_id', [ '' => '' ]+$list_project->pluck('label','id_project')->all(),null, [ 'class' =>
        'js-selectize', 'placeholder' => 'Pilih Nama/Kode Proyek' ]) !!} {!! $errors->first('id_project', '
        <p class="help-block">:message</p>') !!}

    </div>
</div>

<div class="form-group{{ $errors->has('vendor_name') ? 'has-error': '' }} ">
    {!! Form::label('vendor_name', 'Nama Vendor', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('vendor_name', null, [ 'class'=>'form-control', 'placeholder'=>'Isi Nama Vendor (jika diperlukan)' ]) !!}
        {!! $errors->first('vendor_name', '
            <p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('acuan_po') ? 'has-error': '' || $errors->has('acuan_id') ? 'has-error': ''  }} ">
    {!! Form::label('acuan_id', 'Nomor PO', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-2 ">
        {!! Form::select ('acuan_id', [ '' => '' ]
        +App\DocReferenceDivision::pluck('doc_number_head','id')->all(),
        $ncr_reg->doc_reference_id,
        [ 'class' => 'js-selectize', 'placeholder' => 'ID' ]) !!} 
        
    </div>
    {{--  <div class="form-group{{ $errors->has('acuan_po') ? 'has-error': '' }} ">  --}}
        <div class="col-md-3">
            {!! Form::text('acuan_po', $ncr_reg->doc_reference, 
                [ 'class'=>'form-control', 'placeholder'=>'Isi Nomor PO' ]) !!}
            {!! $errors->first('acuan_id','<p class="help-block">:message</p>') !!}
            {!! $errors->first('acuan_po','<p class="help-block">:message</p>') !!}
            
        </div>
    {{--  </div>  --}}
</div>

<div class="form-group{{ $errors->has('description_incompatibility') ? 'has-error': '' }} ">
    {!! Form::label('description_incompatibility', 'Uraian Ketidaksesuaian', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-5">
        {!! Form::textarea('description_incompatibility', null, ['class'=>'form-control']) !!} {!! $errors->first('description_incompatibility',
        '
        <p class="help-block">:message</p>') !!}

    </div>
</div>

<div class="form-group{{ $errors->has('incompatibility_category_id') ? 'has-error': '' }} ">
    {!! Form::label('incompatibility_category_id', 'Kategory Ketidaksesuaian', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-5">
        {!! Form::select ('incompatibility_category_id', [ '' => '' ]+App\IncompatibilityCategory::pluck('description','id')->all(),null,
        [ 'class' => 'js-selectize', 'placeholder' => 'Pilih Kategory Ketidaksesuaian' ]) !!} {!! $errors->first('incompatibility_category_id',
        '
        <p class="help-block">:message</p>') !!}

    </div>
</div>

<div class="form-group{{ $errors->has('person_in_charge') ? 'has-error': '' }} ">
    {!! Form::label('person_in_charge', 'Person In Charge', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('person_in_charge', null, ['class'=>'form-control']) !!} {!! $errors->first('person_in_charge', '
        <p
            class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group{{ $errors->has('file_bukti.*') ? 'has-error' : '' }}">
    {!! Form::label('file_bukti','Pilih file gambar', ['class'=> 'col-md-4 control-label']) !!}

    <div class="col-md-5">
        {!! Form::file('file_bukti[]', ['multiple' => 'multiple']); !!} {!! $errors-> first('file_bukti.*', '
        <p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('disposition_inspector_id') ? 'has-error': '' }} ">
    {!! Form::label('disposition_inspector_id', 'Disposisi Inspektor', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-5">
        {!! Form::select ('disposition_inspector_id', [ '' => '' ]+App\DispositionInspector::pluck('disposisi_description','id')->all(),null,
        [ 'class' => 'js-selectize', 'placeholder' => 'Pilih Disposisi Inspektor' ]) !!} {!! $errors->first('disposition_inspector_id',
        '
        <p class="help-block">:message</p>') !!}

    </div>
</div>

<div class="form-group{{ $errors->has('completion_target') ? 'has-error': '' }} ">
    {!! Form::label('completion_target', 'Target Tanggal Penyelesaian', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-5">
        {{ Form::text('completion_target',$ncr_reg->completion_target, array ('id' => 'datepicker')) }} {!! $errors->first('completion_target',
        '
        <p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4 col-md-offset-4">
        {!! Form::submit ('Simpan',['class'=>'btn btn-primary', 'id'=> 'btn_submit']) !!}
    </div>
</div>