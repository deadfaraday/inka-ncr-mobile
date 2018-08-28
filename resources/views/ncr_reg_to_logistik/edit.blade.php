@extends('layouts.app')

@section('content-title', 'Edit Data NCR ')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('/home') }}"> Dashboard</a>
            <li> <a href = "{{ url('/ncr_reg') }}"> NCR Registration </a>
            <li class= "active"> Edit Data NCR </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Edit NCR (tujuan Divisi Logistik)</h3>
        </div>
        <div class="box-body">
            {!! Form::model($ncr_reg,['url' => route('ncr_reg_log.update',$ncr_reg->id),
                'method' => 'put' , 'files' => 'true' , 'class' => 'form-horizontal']) !!}
                @include('ncr_reg_to_logistik._form')

            {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>
@endsection
