@extends('layouts.app')

@section('content-title', 'Cetak Data NCR')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('home')}}"> Dashboard </a></li>
            <li class = "active" > Cetak Data NCR </a> </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Cetak Data NCR</h3>
        </div>

        <div class="box-body">
            {!! Form::open(['url' => route('generate_report_ncr.store'),
                'method' => 'post', 'class' => 'form-horizontal']) !!}
                @include('generate_report_ncr._form')

            {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>
@endsection
