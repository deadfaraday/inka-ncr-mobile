@section('styles')
    <style type="text/css">
        .help-block 
        {
            color: #a94442;
        }
    </style>
@endsection

<div class= "form-group{{ $errors->has('inspector_number') ? 'has-error': '' }} ">
    {!! Form::label('inspector_number', 'No Reg Inspektor', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::text('inspector_number', null, ['class'=>'form-control']) !!}
        {!! $errors->first('inspector_number', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class= "form-group{{ $errors->has('pekerjaan') ? 'has-error': '' }} ">
    {!! Form::label('pekerjaan', 'Pekerjaan', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::text('pekerjaan', null, ['class'=>'form-control']) !!}
        {!! $errors->first('pekerjaan', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class= "form-group{{ $errors->has('kompetensi') ? 'has-error': '' }} ">
    {!! Form::label('kompetensi', 'Kompetensi', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::text('kompetensi', null, ['class'=>'form-control']) !!}
        {!! $errors->first('kompetensi', '<p class= "help-block">:message</p>') !!}
    </div>
</div>

<div class= "form-group{{ $errors->has('user_id') ? 'has-error': '' }} ">
    {!! Form::label('user_id', 'NIP', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('user_id', [ '' => '' ]+App\User::pluck('nip','id')->all(),null,
        [
            'class' => 'js-selectize',
            'placeholder' => 'Pilih User'
        ]) !!}  
        {!! $errors->first('user_id', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class= "form-group{{ $errors->has('inspector_group_id') ? 'has-error': '' }} ">
    {!! Form::label('inspector_group_id', 'Grup Inspektor', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('inspector_group_id', [ '' => '' ]+App\UnitInspectorCode::pluck('ui_code','id')->all(),null,
        [
            'class' => 'js-selectize',
            'placeholder' => 'Pilih Group Inspektor'
        ]) !!}  
        {!! $errors->first('inspector_group_id', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class = "form-group">
    <div class= "col-md-4 col-md-offset-4">
        {!! Form::submit ('Simpan',['class'=>'btn btn-primary']) !!} 
    </div>
</div>
