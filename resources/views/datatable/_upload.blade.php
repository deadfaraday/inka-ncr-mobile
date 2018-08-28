{!! Form::model($model, ['url' => $upload_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="glyphicon glyphicon-file" aria-hidden="true">Upload</i>', array('type' => 'submit', 'class' => 'btn btn-xs btn-info')) !!}
{!! Form::close() !!}