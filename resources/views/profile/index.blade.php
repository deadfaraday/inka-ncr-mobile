@extends('layouts.app')

@section('content-title', 'Edit Profile')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('/home') }}"> Edit Profile</a>
            <li class= "active"> Edit Profile </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Edit Profile</h3>
        </div>
        <div class="box-body">
            {!! Form::model($user , ['url' =>route('profile.update', $user->id),
                'method' =>'put' , 'files' => 'true', 'class' => 'form-horizontal']) !!}
                                
                @include('profile._form')
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
                    <li> <a href = "{{ url('/home') }}"> Edit Profile</a>
                    <li class= "active"> Edit Profile </li>
                </ul>

                <div class= "panel panel-default">
                    <div class= "panel-heading">
                        <h2 class = "panel-title"> Edit Profile</h2>
                    </div>

                    <div class = "panel-body" > 
                        {!! Form::model($user , ['url' =>route('profile.update', $user->id),
                                'method' =>'put' , 'class' => 'form-horizontal']) !!}
                                
                                @include('profile._form')
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 --}}