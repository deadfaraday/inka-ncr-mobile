@extends('layouts.app')

@section('content-title', 'Daftar Project')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('home')}}"> Dashboard </a></li>
            <li class = "active" > Daftar Karyawan </a> </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Daftar Karyawan</h3>
        </div>
        <div class="box-body">
            <p> <a class="btn btn-primary" href="{{ route('employee.create') }}">Tambah Karyawan</a> </p>
            {!! $html->table(['class' => 'table-striped', 'width' => '100%']) !!}
        </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    {!! $html->scripts() !!}
@endsection
