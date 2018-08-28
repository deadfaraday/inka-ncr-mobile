{!! Form::model($model, ['url' => $show_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="glyphicon glyphicon-folder-open" aria-hidden="true"> Show</i>', array('type' => 'submit', 'class' => 'btn btn-xs btn-warning')) !!}
{!! Form::close() !!}
