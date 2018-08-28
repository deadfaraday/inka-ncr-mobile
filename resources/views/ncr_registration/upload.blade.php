@extends('layouts.app')

@section('content-title', 'Upload File Gambar')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('/home') }}"> Dashboard</a>
            <li> <a href = "{{ url('/ncr_reg') }}"> NCR Registration </a>
            <li class= "active"> Upload File Gambar</li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Upload File Gambar</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['url' => url('ncr_reg/'. $ncr_data->id .'/store_img'),
                'method' => 'post' , 'files' => 'true' , 'class' => 'form-horizontal']) !!}
                @include('ncr_registration._form_upload')
            {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>
@endsection


{{-- @extends('layouts.app')

@section('content')
    <div class= "container">
        <div class= "row">
            <div class = "col-md-12">
                <ul class = "breadcrumb">
                    <li> <a href = "{{ url('/home') }}"> Dashboard</a>
                    <li> <a href = "{{ url('/ncr_reg') }}"> NCR Registration </a>
                    <li class= "active"> Upload File Gambar</li>
                </ul>

                <div class= "panel panel-default">
                    <div class= "panel-heading">
                        <h2 class = "panel-title"> Upload File Gambar</h2>
                    </div>

                    <div class = "panel-body" > 
                        {!! Form::open(['url' => url('ncr_reg/'. $ncr_data->id .'/store_img'),
                            'method' => 'post' , 'files' => 'true' , 'class' => 'form-horizontal']) !!}
                            @include('ncr_registration._form_upload')
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
