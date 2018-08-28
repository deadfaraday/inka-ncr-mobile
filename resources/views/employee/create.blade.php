@extends('layouts.app')

@section('content-title', 'Tambah Project')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('/home') }}"> Dashboard</a>
            <li> <a href = "{{ url('/employee') }}"> Karyawan </a>
            <li class= "active"> Tambah Karyawan </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Tambah Karyawan</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['url' => route('employee.store'),
                'method' => 'post' , 'files' => 'true' , 'class' => 'form-horizontal']) !!}
                @include('employee._form')

            {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>
@endsection

