@section('styles')
    <style type="text/css">
        .help-block 
        {
            color: #a94442;
        }
    </style>
@endsection

<div class= "form-group{{ $errors->has('verification_result_id') ? 'has-error': '' }} ">
    {!! Form::label('verification_result_id', 'Hasil Verifikasi', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('verification_result_id', [ '' => '' ]+App\VerificationResult::pluck('description','id')->all(),null,
            [
                'class' => 'js-selectize',
                'placeholder' => 'Pilih Hasil Verifikasi'
            ])         
        !!}  
        {!! $errors->first('verification_result_id', '<p class= "help-block">:message</p>') !!}
    </div>
</div>

<div class= "form-group{{ $errors->has('verification_description') ? 'has-error': '' }} ">
    {!! Form::label('verification_description', 'Catatan Verifikasi', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::textarea('verification_description', null, ['class'=>'form-control']) !!}
        {!! $errors->first('verification_description', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

{{--  <div class = "form-group{{ $errors->has('file_bukti.*') ? 'has-error' : '' }}">
    {!! Form::label('file_bukti','Pilih file gambar', ['class'=> 'col-md-4 control-label']) !!}
    
    <div class = "col-md-5">
        {!! Form::file('file_bukti[]', ['multiple' => 'multiple']); !!}
        {!! $errors-> first('file_bukti.*', '<p class= "help-block" >:message</p>') !!}
    </div>
</div>   --}}


<div class = "form-group">
    <div class= "col-md-4 col-md-offset-4">
        {!! Form::submit ('Simpan',['class'=>'btn btn-primary']) !!} 
    </div>
</div>