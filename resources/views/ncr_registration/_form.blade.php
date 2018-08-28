@section('styles')
    <style type="text/css">
        .help-block 
        {
            color: #a94442;
        }
    </style>
@endsection

{{--  <div class= "form-group{{ $errors->has('product_identity_id') ? 'has-error': '' }} ">
    {!! Form::label('product_identity_id', 'Identitas Produk/Proses', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('product_identity_id', [ '' => '' ]+App\ProductIdentity::pluck('identity_description','id')->all(),null,
        [
            'class' => 'js-selectize',
            'placeholder' => 'Pilih Identitas Produk'
        ]) !!}  
        {!! $errors->first('product_identity_id', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>  --}}

<div class= "form-group{{ $errors->has('process_name') ? 'has-error': '' }} ">
    {!! Form::label('process_name', 'Nama Produk/Proses', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::text('process_name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('process_name', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class= "form-group{{ $errors->has('master_project_id') ? 'has-error': '' }} ">
    {!! Form::label('master_project_id', 'Nama/Kode Proyek', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('master_project_id', [ '' => '' ]+$list_project->pluck('label','id_project')->all(),null,
        [
            'class' => 'js-selectize',
            'placeholder' => 'Pilih Nama/Kode Proyek'
        ]) !!}  
        {!! $errors->first('master_project_id', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class= "form-group{{ $errors->has('division_id') ? 'has-error': '' }} ">
    {!! Form::label('division_id', 'Lokasi/Unit Ketidaksesuaian', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('division_id', [ '' => '' ]+$list_unit->pluck('division_name','id')->all(),null,
        [
            'class' => 'js-selectize',
            'placeholder' => 'Pilih Unit Ketidaksesuaian'
        ]) !!}  
        {!! $errors->first('division_id', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

{{--  
<div class= "form-group{{ $errors->has('division_id') ? 'has-error': '' }} ">
    {!! Form::label('division_id', 'Lokasi/Unit Ketidaksesuaian', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('division_id', [ '' => '' ]+App\Division::pluck('division_name','id')->where('parent','<>','0')->all(),null,
        [
            'class' => 'js-selectize',
            'placeholder' => 'Pilih Lokasi/Unit Ketidaksesuaian'
        ]) !!}  
        {!! $errors->first('division_id', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>  --}}

@if ($ui_code->ui_code == 'INC' || $ui_code->ui_code == 'SUB' )
    <div class= "form-group{{ $errors->has('vendor_name') ? 'has-error': '' }} ">
        {!! Form::label('vendor_name', 'Nama Vendor', ['class'=>'col-md-4 control-label']) !!}
        <div class = "col-md-5">
            {!! Form::text('vendor_name', null, 
                [
                    'class'=>'form-control',
                    'placeholder'=>'Isi Nama Vendor (jika diperlukan)'
                ]) !!}
            {!! $errors->first('vendor_name', '<p class= "help-block">:message</p>') !!}
            
        </div>
    </div>
@endif

<div class= "form-group{{ $errors->has('reference_inspection') ? 'has-error': '' }} ">
    {!! Form::label('reference_inspection', 'Acuan Pemeriksaan', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::text('reference_inspection', null, ['class'=>'form-control']) !!}
        {!! $errors->first('reference_inspection', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

{{--  <div class= "form-group{{ $errors->has('master_product_id') ? 'has-error': '' }} ">
    {!! Form::label('master_product_id', 'Lokasi Produk', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('master_product_id', [ '' => '' ]+App\MasterProduct::pluck('product_description','id')->all(),null,
        [
            'class' => 'js-selectize',
            'placeholder' => 'Pilih Jenis Produk'
        ]) !!}  
        {!! $errors->first('master_product_id', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>  --}}

{{-- ini dokumen karena pic akan ditentukan secara auto 
    
{{--  <div class= "form-group{{ $errors->has('default_pic') ? 'has-error': '' }} ">
    {!! Form::label('default_pic', 'PIC Tindak Lanjut', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('default_pic', [ '' => '' ]
                    +App\User::whereRoleIs('admin_pic_response')->pluck('name','id')->all(),null,
        [
            'class' => 'js-selectize',
            'placeholder' => 'Pilih PIC untuk tindak lanjut'
        ]) !!}  
        {!! $errors->first('default_pic', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>  --}}

<div class= "form-group{{ $errors->has('description_incompatibility') ? 'has-error': '' }} ">
    {!! Form::label('description_incompatibility', 'Uraian Ketidaksesuaian', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::textarea('description_incompatibility', null, ['class'=>'form-control']) !!}
        {!! $errors->first('description_incompatibility', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class= "form-group{{ $errors->has('incompatibility_category_id') ? 'has-error': '' }} ">
    {!! Form::label('incompatibility_category_id', 'Kategory Ketidaksesuaian', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('incompatibility_category_id', [ '' => '' ]+App\IncompatibilityCategory::pluck('description','id')->all(),null,
        [
            'class' => 'js-selectize',
            'placeholder' => 'Pilih Kategory Ketidaksesuaian'
        ]) !!}  
        {!! $errors->first('incompatibility_category_id', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class= "form-group{{ $errors->has('person_in_charge') ? 'has-error': '' }} ">
    {!! Form::label('person_in_charge', 'Person In Charge', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::text('person_in_charge', null, ['class'=>'form-control']) !!}
        {!! $errors->first('person_in_charge', '<p class= "help-block">:message</p>') !!}
    </div>
</div>


<div class = "form-group{{ $errors->has('file_bukti.*') ? 'has-error' : '' }}">
    {!! Form::label('file_bukti','Pilih file gambar', ['class'=> 'col-md-4 control-label']) !!}
    
    <div class = "col-md-5">
        {!! Form::file('file_bukti[]', ['multiple' => 'multiple']); !!}
        {!! $errors-> first('file_bukti.*', '<p class= "help-block" >:message</p>') !!}
    </div>
</div> 

<div class= "form-group{{ $errors->has('disposition_inspector_id') ? 'has-error': '' }} ">
    {!! Form::label('disposition_inspector_id', 'Disposisi Inspektor', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('disposition_inspector_id', [ '' => '' ]+App\DispositionInspector::pluck('disposisi_description','id')->all(),null,
        [
            'class' => 'js-selectize',
            'placeholder' => 'Pilih Disposisi Inspektor'
        ]) !!}  
        {!! $errors->first('disposition_inspector_id', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class= "form-group{{ $errors->has('completion_target') ? 'has-error': '' }} ">
    {!! Form::label('completion_target', 'Target Tanggal Penyelesaian', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {{ Form::text('completion_target',$ncr_reg->completion_target, array ('id' => 'datepicker')) }}
        {!! $errors->first('completion_target', '<p class= "help-block">:message</p>') !!}        
    </div>
</div>

<div class = "form-group">
    <div class= "col-md-4 col-md-offset-4">
        {!! Form::submit ('Simpan',['class'=>'btn btn-primary','id'=> 'btn_submit']) !!} 
    </div>
</div>