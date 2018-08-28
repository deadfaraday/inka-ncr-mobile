{!! Form::model($model, ['url' => $close_url, 'method' => 'get', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message] ) !!}
{!! Form::button('<i class="glyphicon glyphicon-remove" aria-hidden="true"> Close</i>', array('type' => 'submit', 'class' => 'btn btn-xs btn-danger')) !!}
{!! Form::close() !!}
