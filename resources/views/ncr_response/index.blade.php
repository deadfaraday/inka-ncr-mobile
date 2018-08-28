@extends('layouts.app')

@section('content-title', 'NCR Response')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('home')}}"> Dashboard </a></li>
            <li class = "active" > NCR Response </a> </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">NCR Response</h3>
        </div>
        <div class="box-body">
            {{-- {!! $dataTable->table(['class' => 'table-striped', 'width' => '100%']) !!} --}}
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
                    <li class = "active" > NCR Response </a> </li>
                 </ul>

                 <div class = "panel panel-default">
                    <div class = "panel-heading">
                        <h2 class = "panel title"> NCR Response </h2>
                    </div>

                    <div class = "panel-body">
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