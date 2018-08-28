{!! Form::model($model, ['url' => $print_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="glyphicon glyphicon-print" aria-hidden="true"> Print</i>', array('type' => 'submit', 'class' => 'btn btn-xs btn-primary')) !!}
{!! Form::close() !!}
