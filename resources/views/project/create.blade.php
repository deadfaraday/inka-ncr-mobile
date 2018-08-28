@extends('layouts.app')

@section('content-title', 'Tambah Project')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('/home') }}"> Dashboard</a>
            <li> <a href = "{{ url('/project') }}"> Projects </a>
            <li class= "active"> Tambah Project </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Tambah Project</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['url' => route('project.store'),
                'method' => 'post' , 'files' => 'true' , 'class' => 'form-horizontal']) !!}
                @include('project._form')

            {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>
@endsection

