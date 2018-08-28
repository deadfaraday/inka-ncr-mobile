@section('styles')
    <style type="text/css">
        .help-block 
        {
            color: #a94442;
        }
    </style>
@endsection

<div class="panel-body form-horizontal mrb-form">

    <div class= "form-group{{ $errors->has('mrb_disposition') ? 'has-error': '' }} ">
        {!! Form::label('mrb_disposition', 'Disposisi Mrb', ['class'=>'col-md-4 control-label']) !!}
        <div class = "col-md-5">
            {!! Form::select ('mrb_disposition', [ '' => '' ]+App\MrbDisposition::pluck('description','id')->all(),null,
            [
                'class' => 'js-selectize',
                'placeholder' => 'Pilih Disposisi MRB'
            ]) !!}  
            {!! $errors->first('mrb_disposition', '<p class= "help-block">:message</p>') !!}

        </div>
    </div>

    <div class= "form-group{{ $errors->has('mrb_departemen') ? 'has-error': '' }} ">
        {!! Form::label('mrb_departemen', 'Departemen yang menindaklanjuti', ['class'=>'col-md-4 control-label']) !!}
        <div class = "col-md-5">
            {!! Form::select ('mrb_departemen', [ '' => '' ]+App\Division::pluck('division_name','division_name')->where('parent','<>','0')->all(),null,
            [
                'class' => 'js-selectize',
                'placeholder' => 'Pilih Departemen'
            ]) !!}  
            {!! $errors->first('mrb_departemen', '<p class= "help-block">:message</p>') !!}
            
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-3 col-md-offset-8">
            <button type="button" class="btn btn-success preview-add-button">
                <span class="glyphicon glyphicon-plus"></span> Add
            </button>
        </div>
    </div>

    <div class="form-group">
    <div class="col-xs-5 col-xs-offset-4">
        <div class="table-responsive">
            <table class="table preview-table" id="tabel_dept_mrb">
                <thead>
                    <tr>
                        <th>Departemen yang Menindaklanjuti</th>
                    </tr>
                </thead>
                <tbody></tbody> <!-- preview content goes here-->
            </table>
        </div>                            
    </div>
    </div>

    
    <input type="hidden" name="ncr_resp_id" value="{{ $ncr_resp_id }}">
 
    <div class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <button type="button" class="btn btn-primary submit-button">
                Simpan
            </button>
        </div>
    </div>


</div>