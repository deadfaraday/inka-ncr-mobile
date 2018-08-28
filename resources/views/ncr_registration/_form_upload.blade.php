@section('styles')
    <style type="text/css">
        .help-block 
        {
            color: #a94442;
        }
    </style>
@endsection

<div class= "form-group">
    {!! Form::label('', 'No Registrasi NCR', ['class'=>'col-md-4 control-label']) !!}
    
    <div class = "col-md-5">
        {!! Form::label('',  $ncr_data->no_reg_ncr , ['control-label']) !!}
    </div>
</div>

<div class = "form-group{{ $errors->has('file_bukti.*') ? 'has-error' : '' }}">
    {!! Form::label('file_bukti','Pilih file gambar', ['class'=> 'col-md-4 control-label']) !!}
    
    <div class = "col-md-5">
        {!! Form::file('file_bukti[]', ['multiple' => 'multiple']); !!}
        {!! $errors-> first('file_bukti.*', '<p class= "help-block" >:message</p>') !!}
    </div>
</div>

<div class = "form-group">
    <div class= "col-md-4 col-md-offset-4">
            {!! Form::submit ('Simpan',['class'=>'btn btn-primary']) !!} 
    </div>
</div>

