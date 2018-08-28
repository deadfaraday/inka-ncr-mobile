@section('styles')
    <style type="text/css">
        .help-block 
        {
            color: #a94442;
        }
    </style>
@endsection

<div class=" form-group{{ $errors->has('new_password') ? ' has-error' : '' }} " >
    {!! Form:: label ( 'new_password' , 'Password baru' , [ 'class' => 'col-md-4 control-label' ]) !!}
    <div class=" col-md-5" >
        {!! Form:: password( 'new_password' , [ 'class' => 'form-control' ]) !!}
        {!! $errors-> first( 'new_password' , '<p class="help-block">:message</p>' ) !!}
    </div>
</div>

<div class=" form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }} " >
    {!! Form:: label ( 'new_password_confirmation' , 'Konfirmasi password baru' , [ 'class' => 'col-md-4 control-label' ]) !!}
    <div class=" col-md-5" >
        {!! Form:: password( 'new_password_confirmation' , [ 'class' => 'form-control' ]) !!}
        {!! $errors-> first( 'new_password_confirmation' , '<p class="help-block">:message</p>' ) !!}
    </div>
</div>

<div class = "form-group{{ $errors->has('profpict') ? 'has-error' : '' }}">
    {!! Form::label('profpict','Pilih foto profil', ['class'=> 'col-md-4 control-label']) !!}
    
    <div class = "col-md-5">
        {!! Form::file('profpict') !!}
        {!! $errors-> first('profpict', '<p class= "help-block" >:message</p>') !!}
    </div>
</div> 

<div class = "form-group">
    <div class= "col-md-4 col-md-offset-4">
        {!! Form::submit ('Simpan',['class'=>'btn btn-primary']) !!} 
    </div>
</div>
