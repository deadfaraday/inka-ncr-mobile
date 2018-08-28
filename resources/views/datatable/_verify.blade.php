{!! Form::model($model, ['url' => $verify_url, 'method' => 'get'] ) !!}
{!! Form::button('<i class="glyphicon glyphicon-file" aria-hidden="true">Verifikasi</i>', array('type' => 'submit', 'class' => 'btn btn-xs btn-success')) !!}
{!! Form::close() !!}