@extends('layouts.app')

@section('content-title', 'NCR Registration')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('home')}}"> Dashboard </a></li>
            <li class = "active" > NCR Registration </a> </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">NCR Registration</h3>
        </div>
        <div class="box-body">
            @if($inspector_access)
                <p> <a class="btn btn-primary" href="{{ route('ncr_reg.create') }}">Tambah NCR</a> </p>
            @endif
			<div class= "table-responsive">
				{!! $html->table(['class' => 'table-striped', 'width' => '100%']) !!}
			</div>
		</div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    {!! $html->scripts() !!}
@endsection


{{-- @extends('layouts.app')

@section('content')
    <div class = "container">
        <div class = "row">
            <div class = "col-md-12">
                <ul class = "breadcrumb">
                    <li> <a href = "{{ url('home')}}"> Dashboard </a></li>
                    <li class = "active" > NCR Registration </a> </li>
                 </ul>

                 <div class = "panel panel-default">
                    <div class = "panel-heading">
                        <h2 class = "panel title"> NCR Registration </h2>
                    </div>

                    <div class = "panel-body">
                        <p> <a class="btn btn-primary" href="{{ route('ncr_reg.create') }}">Tambah NCR</a> </p>
                         {!! $html->table(['class' => 'table-striped', 'width' => '100%']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! $html->scripts() !!}
@endsection --}}