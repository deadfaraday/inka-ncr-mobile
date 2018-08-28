@extends('layouts.app')

@section('content-title', 'All NCR')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('home')}}"> Dashboard </a></li>
            <li class = "active" > All NCR </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">All NCR</h3>
        </div>
        <div class="box-body">
            {!! $html->table(['class' => 'table-responsive', 'width' => '100%']) !!}
        </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    {!! $html->scripts() !!}
@endsection