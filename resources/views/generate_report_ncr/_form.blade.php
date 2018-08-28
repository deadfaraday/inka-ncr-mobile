
<div class="form-group{{ $errors->has('start_date') ? 'has-error': '' }} ">
    {!! Form::label('start_date', 'Sejak Tanggal', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-5">
        {{ Form::text('start_date','', array ('class' => 'form-control', 'id' => 'datepicker')) }} {!! $errors->first('start_date','
        <p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('end_date') ? 'has-error': '' }} ">
    {!! Form::label('end_date', 'Sampai Tanggal', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-md-5">
        {{ Form::text('end_date','', array ('class' => 'form-control', 'id' => 'datepicker1')) }} {!! $errors->first('end_date','
        <p class="help-block">:message</p>') !!}
    </div>
</div>


                                        
<div class="form-group">
    <div class="col-md-4 col-md-offset-4">
        {!! Form::submit ('Cetak',['class'=>'btn btn-primary']) !!}
    </div>
</div>