@section('styles')
    <style type="text/css">
        .help-block 
        {
            color: #a94442;
        }
    </style>
@endsection

<div class= "form-group{{ $errors->has('project_code') ? 'has-error': '' }} ">
    {!! Form::label('project_code', 'Project Code', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::text('project_code', null, ['class'=>'form-control']) !!}
        {!! $errors->first('project_code', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class= "form-group{{ $errors->has('project_description') ? 'has-error': '' }} ">
    {!! Form::label('project_description', 'Project Description', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::text('project_description', null, ['class'=>'form-control']) !!}
        {!! $errors->first('project_description', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class = "form-group">
    <div class= "col-md-4 col-md-offset-4">
        {!! Form::submit ('Simpan',['class'=>'btn btn-primary']) !!} 
    </div>
</div>
