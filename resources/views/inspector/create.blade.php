@extends('layouts.app')

@section('content-title', 'Tambah Inspektor')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('/home') }}"> Dashboard</a>
            <li> <a href = "{{ url('/inspector') }}"> Inspektor </a>
            <li class= "active"> Tambah Inspektor </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Tambah Inspektor</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['url' => route('inspector.store'),
                'method' => 'post' , 'files' => 'true' , 'class' => 'form-horizontal']) !!}
                @include('inspector._form')

            {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>
@endsection



