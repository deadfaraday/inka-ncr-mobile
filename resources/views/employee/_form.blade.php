@section('styles')
    <style type="text/css">
        .help-block 
        {
            color: #a94442;
        }
    </style>
@endsection

<div class= "form-group{{ $errors->has('name') ? 'has-error': '' }} ">
    {!! Form::label('name', 'Nama', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class= "form-group{{ $errors->has('nip') ? 'has-error': '' }} ">
    {!! Form::label('nip', 'NIP', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::text('nip', null, ['class'=>'form-control']) !!}
        {!! $errors->first('nip', '<p class= "help-block">:message</p>') !!}
    </div>
</div>

<div class= "form-group{{ $errors->has('email') ? 'has-error': '' }} ">
    {!! Form::label('email', 'Email', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::text('email', null, ['class'=>'form-control']) !!}
        {!! $errors->first('email', '<p class= "help-block">:message</p>') !!}
    </div>
</div>

<div class= "form-group{{ $errors->has('unit_kerja_id') ? 'has-error': '' }} ">
    {!! Form::label('unit_kerja_id', 'Unit Kerja', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('unit_kerja_id', [ '' => '' ]+App\Division::pluck('division_name','id')->all(),null,
        [
            'class' => 'js-selectize',
            'placeholder' => 'Pilih Unit Kerja'
        ]) !!}  
        {!! $errors->first('unit_kerja_id', '<p class= "help-block">:message</p>') !!}
    </div>
</div>


<div class = "form-group">
    <div class= "col-md-4 col-md-offset-4">
        {!! Form::submit ('Simpan',['class'=>'btn btn-primary']) !!} 
    </div>
</div>
