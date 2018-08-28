@extends('layouts.app')

@section('content-title', 'Tambah NCR')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('/home') }}"> Dashboard</a>
            <li> <a href = "{{ url('/ncr_reg') }}"> NCR Registration </a>
            <li class= "active"> Tambah NCR </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Tambah NCR</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['url' => route('ncr_reg.store'),
                'method' => 'post' , 'files' => 'true' , 'class' => 'form-horizontal']) !!}
                @include('ncr_registration._form')

            {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>
@endsection



