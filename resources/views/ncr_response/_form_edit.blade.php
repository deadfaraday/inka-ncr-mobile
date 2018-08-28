@section('styles')
    <style type="text/css">
        .help-block 
        {
            color: #a94442;
        }
    </style>
@endsection

<div class= "form-group{{ $errors->has('problem_id') ? 'has-error': '' }} ">
    {!! Form::label('problem_id', 'Akar Masalah', ['class'=>'col-md-4 control-label', 'style' => 'margin-right: 15px']) !!}
    @foreach($list_problems as $i => $list_problem)
        {!! Form::checkbox('problem_id[]', $i, 
            (!is_null($problem_status[$i]) ? $problem_status[$i] : null),
            ['style' => 'margin-top: 9px']) !!}
        {!! Form::label('problem_name', $list_problem, ['style' => 'margin-left: 3px; margin-right: 20px']) !!}
    @endforeach
    {!! $errors->first('problem_id', '<p class= "help-block">:message</p>') !!}  
</div>

<div class= "form-group{{ $errors->has('problem_description') ? 'has-error': '' }} ">
    {!! Form::label('problem_description', 'Uraian Akar Masalah', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::textarea('problem_description', null, ['class'=>'form-control']) !!}
        {!! $errors->first('problem_description', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class= "form-group{{ $errors->has('corrective_act') ? 'has-error': '' }} ">
    {!! Form::label('corrective_act', 'Tindakan Perbaikan', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::textarea('corrective_act', null, ['class'=>'form-control']) !!}
        {!! $errors->first('corrective_act', '<p class= "help-block">:message</p>') !!}
        
    </div>
</div>

<div class= "form-group{{ $errors->has('corrective_est_date') ? 'has-error': '' }} ">
    {!! Form::label('corrective_est_date', 'Target Tanggal Penyelesaian Tindakan Perbaikan', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {{ Form::text('corrective_est_date',$ncr_response->corrective_est_date, array ('id' => 'datepicker')) }}
        {!! $errors->first('corrective_est_date', '<p class= "help-block">:message</p>') !!}        
    </div>
</div>


<div class= "form-group{{ $errors->has('preventive_act') ? 'has-error': '' }} ">
    {!! Form::label('preventive_act', 'Tindakan Pencegahan', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::textarea('preventive_act', null, ['class'=>'form-control']) !!}
        {!! $errors->first('preventive_act', '<p class= "help-block">:message</p>') !!}
    </div>
</div>

<div class= "form-group{{ $errors->has('preventive_est_date') ? 'has-error': '' }} ">
    {!! Form::label('preventive_est_date', 'Target Tanggal Penyelesaian Tindakan Pencegahan', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {{ Form::text('preventive_est_date',$ncr_response->corrective_est_date, array ('id' => 'datepicker_form')) }}
        {!! $errors->first('preventive_est_date', '<p class= "help-block">:message</p>') !!}        
    </div>
</div>

<div class= "form-group{{ $errors->has('disp_unit_id') ? 'has-error': '' }} ">
    {!! Form::label('disp_unit_id', 'Disposisi Unit yang Dituju', ['class'=>'col-md-4 control-label']) !!}
    <div class = "col-md-5">
        {!! Form::select ('disp_unit_id', [ '' => '' ]+
                App\UnitDisposition::pluck('description','id')->all(),null,
        [
            'class' => 'js-selectize',
            'placeholder' => 'Pilih Disposisi Unit'
        ]) !!}  
        {!! $errors->first('disp_unit_id', '<p class= "help-block">:message</p>') !!}

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