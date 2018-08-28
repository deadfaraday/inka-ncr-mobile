@extends('layouts.master_mail')

@section('content')
    <h1>Sistem Online NCR PT INKA (Persero)</h1>
    <br>
    <h2>{{$pesan}}</h2>
    <h3><i></i></h3>
    
    @if(!is_null($link))
        <p> <a class="btn btn-primary" href={{$link}}>{{$label_link}}</a> </p>
    @endif
@endsection