@extends('layouts.app')

@section('styles')
    <link href="/css/costum.css" rel="stylesheet">
@endsection

@section('content-title', 'NCR Response Print')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('home')}}"> Dashboard </a></li>
            <li> <a href = "{{ url('/ncr_resp') }}"> NCR Response </a>
            <li class = "active" > NCR Response Print </a> </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">NCR Response Print</h3>
        </div>
        <div class="box-body">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3"><p>No. NCR </p></div>
                    <div class="col-md-9"><p>: {{ ($resp_data->ncr_registration->no_reg_ncr) }}</p></div>
                </div>
                        
                <div class="row">
                    <div class="col-md-3"><p>No Reg Inspektor</p></div>
                    <div class="col-md-9"><p>: {{ ($userinspector->inspector_number) }}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Nama Proses</p></div>
                    <div class="col-md-9"><p>: {{ ($resp_data->ncr_registration->process_name) }}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Kode Proyek</p></div>
                    <div class="col-md-9"><p>: {{ ($resp_data->ncr_registration->project->project_description) }}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Unit</p></div>
                    <div class="col-md-9"><p>: {{ ($resp_data->ncr_registration->division->division_name) }}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Akar Masalah</p></div>
                        <div class="col-md-9"><p>: 
                            @if(count($resp_problem)>1)
                                @foreach($resp_problem as $i => $response)
                                    {{ ($response->problem_source->description) }}
                                    @if($i+1 < count($resp_problem))
                                        ,
                                    @endif
                                @endforeach
                            @else
                                {{ ($resp_problem->pluck('problem_source.description')->get(0)) }}
                            @endif
                            </p>
                        </div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Uraian Akar Masalah</p></div>
                    <div class="col-md-9"><p>: {!! $resp_data->problem_description !!}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Tindakan Perbaikan</p></div>
                    <div class="col-md-9"><p>: {!! $resp_data->corrective_act !!}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Tindakan Pencegahan</p></div>
                    <div class="col-md-9"><p>: {!! $resp_data->preventive_act !!}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Disposisi Unit Yang Dituju</p></div>
                    <div class="col-md-9"><p>: {!! $resp_data->unit_disposition->description !!}</p></div>
                </div>

            </div>

            <div class="col-md-2">
                <div class="row">
                    <div class="col-md-12"><p>File Upload</p></div>
                </div>
                <div class="row">
                        <div class="col-md-12">
                            @if(count($resp_file) > 0)
                                <p>
                                    {{--  {!! Html::image(asset('img/ncr_response/'.$resp_file->get(0)), null, ['class'=>'hover-shadow crosshair', 'alt'=>'$resp_file->get(0)', 'width'=>'90%', 'height'=>'35%', 'onclick'=>'openModal();currentSlide(1)']) !!}  --}}
                                    <img src="{{ route('ncr_resp_preview', $resp_file->pluck('id')->get(0)) }}" class="hover-shadow crosshair" 
                                        alt="No Image" width="90%" height="35%" onclick="openModal();currentSlide(1)">  
                             
                                </p>
                            @endif
                        </div>
                        
                        @php
                            $a = 0;
                            $b = 1;
                        @endphp

                        {{--  @if(count($resp_file) > 0)
                            @foreach ($resp_file as $file_upload)
                                <p>
                                    {!! Html::image(asset('img/ncr_response/'.$file_upload) , null, ['class'=>'hover-shadow crosshair', 'alt'=>'$file_upload', 'width'=>'0%', 'height'=>'0%', 'onclick'=>'openModal();currentSlide('.$a.')']) !!}
                                </p>
                                @php
                                    $a++;
                                @endphp
                            @endforeach
                        @endif  --}}

                        @if(count($resp_file) > 0)       
                            <div id="myModal" class="mod">
                                <span class="close crosshair" onclick="closeModal()">&times;</span>
                                    <div class="mod-content">
                                        @foreach ($resp_file as $file_upload)
                                        <div class="geser">
                                            {{--  {!! Html::image(asset('img/ncr_response/'.$file_upload) , null, [ 'style'=>'width:100%']) !!}  --}}
                                            <img src="{{ route('ncr_resp_preview', $file_upload->id) }}"  width="100%">  
                                            
                                            <span class="unduh">
                                                {{--  <a href="{{URL::to('storage/app')}}/{{ $file_upload->ncr_response_upload }}" 
                                                    download="{{ $file_upload->ncr_response_upload }}">  --}}
                                                <a href="{{ route('ncr_resp_download', $file_upload->id) }}" 
                                                    >
                                                    
                                                    <button type="button" class="btn btn-primary">
                                                        <i class="glyphicon glyphicon-download">Download</i>
                                                    </button>
                                                </a>
                                            </span>
                                        </div>
                                        @endforeach    
                                        <a class="sebelum" onclick="plusSlides(-1)">&#10094;</a>
                                        <a class="lanjut" onclick="plusSlides(1)">&#10095;</a>

                                        <br>

                                        @foreach ($resp_file as $file_upload)
                                        <div class="column">
                                            {{--  {!! Html::image(asset('img/ncr_response/'.$file_upload) , null, [ 'class'=>'demo crosshair', 'style'=>'width:100%', 'onclick'=>'currentSlide('.$b.')']) !!}  --}}
                                            <img src="{{ route('ncr_resp_preview', $file_upload->id) }}" class="demo crosshair" 
                                                alt="No Image" width="100%" onclick="openModal();currentSlide('{{ $b }}')">  
                                
                                        </div>
                                        @php
                                            $b++;
                                        @endphp
                                        @endforeach 
                                    </div>
                            </div>
                        @endif
                </div>
            </div>

            {{--  <div class="box-footer">
                <div class="row">
                    <div class="col-md-5 col-md-offset-5">
                        <a class="btn btn-primary" href="{{ url('ncr_resp/'. $resp_data->id .'/print_pdf') }}"><i class="glyphicon glyphicon-print" aria-hidden="true"> Print</i></a>
                    </div>
                </div>
            </div>  --}}

        </div>
    </div>
  </div>
</div>
@endsection


@section('scripts')
    <script>
    function openModal() {
      document.getElementById('myModal').style.display = "block";
    }

    function closeModal() {
      document.getElementById('myModal').style.display = "none";
    }

    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("geser");
      var dots = document.getElementsByClassName("demo");
      var captionText = document.getElementById("caption");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
      captionText.innerHTML = dots[slideIndex-1].alt;
    }
    </script>
@endsection

{{-- @extends('layouts.app')

@section('css')
    <link href="/css/costum.css" rel="stylesheet">
@endsection

@section('content')
    <div class = "container">
        <div class = "row">
            <div class = "col-md-12">
                <ul class = "breadcrumb">
                    <li> <a href = "{{ url('home')}}"> Dashboard </a></li>
                    <li> <a href = "{{ url('/ncr_resp') }}"> NCR Response </a>
                    <li class = "active" > NCR Response Print </a> </li>
                 </ul>

                 <div class = "panel panel-default">
                    <div class = "panel-heading">
                        <h2 class = "panel title"> NCR Response Print </h2>
                    </div>

                    <div class = "panel-body">
                    <div id="left">
                        <div class="row">
                            <div class="col-md-3"><p>No. NCR </p></div>
                            <div class="col-md-9"><p>: {{ ($resp_data->ncr_registration->no_reg_ncr) }}</p></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3"><p>No Reg Inspektor</p></div>
                            <div class="col-md-9"><p>: {{ ($userinspector->inspector_number) }}</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Nama Proses</p></div>
                            <div class="col-md-9"><p>: {{ ($resp_data->ncr_registration->process_name) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Kode Proyek</p></div>
                            <div class="col-md-9"><p>: {{ ($resp_data->ncr_registration->project->project_description) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Unit</p></div>
                            <div class="col-md-9"><p>: {{ ($resp_data->ncr_registration->division->division_name) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Akar Masalah</p></div>
                            <div class="col-md-9"><p>: 
                                @if(count($resp_problem)>1)
                                    @foreach($resp_problem as $i => $response)
                                        {{ ($response->problem_source->description) }}
                                        @if($i+1 < count($resp_problem))
                                            ,
                                        @endif
                                    @endforeach
                                @else
                                    {{ ($resp_problem->pluck('problem_source.description')->get(0)) }}
                                @endif
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Uraian Akar Masalah</p></div>
                            <div class="col-md-9"><p>: {{ ($resp_data->problem_description) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Tindakan Perbaikan</p></div>
                            <div class="col-md-9"><p>: {{ ($resp_data->corrective_act) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Tindakan Pencegahan</p></div>
                            <div class="col-md-9"><p>: {{ ($resp_data->preventive_act) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Disposisi Unit Yang Dituju</p></div>
                            <div class="col-md-9"><p>: {{ ($resp_data->unit_disposition->description) }}</p></div>
                        </div>

                    </div>

                    <div id="right">
                        <div class="row">
                            <div class="col-md-3"><p>File Upload</p></div>

                            <div class="col-md-4">
                                @if(count($resp_file) > 0)
                                    <p>
                                        {!! Html::image(asset('img/ncr_response/'.$resp_file->get(0)), null, ['class'=>'hover-shadow crosshair', 'alt'=>'$resp_file->get(0)', 'width'=>'90%', 'height'=>'35%', 'onclick'=>'openModal();currentSlide(1)']) !!}
                                    </p>
                                @endif
                            </div>
                        
                            @php
                                $a = 0;
                                $b = 1;
                            @endphp

                            @if(count($resp_file) > 0)
                                @foreach ($resp_file as $file_upload)
                                    <p>
                                        {!! Html::image(asset('img/ncr_response/'.$file_upload) , null, ['class'=>'hover-shadow crosshair', 'alt'=>'$file_upload', 'width'=>'0%', 'height'=>'0%', 'onclick'=>'openModal();currentSlide('.$a.')']) !!}
                                    </p>
                                    @php
                                        $a++;
                                    @endphp
                                @endforeach
                            @endif

                            @if(count($resp_file) > 0)       
                                <div id="myModal" class="mod">
                                    <span class="close crosshair" onclick="closeModal()">&times;</span>
                                    <div class="mod-content">
                                        @foreach ($resp_file as $file_upload)
                                        <div class="geser">
                                            {!! Html::image(asset('img/ncr_response/'.$file_upload) , null, [ 'style'=>'width:100%']) !!}
                                            <span class="unduh">
                                                <a href="{{URL::to('img/ncr_response')}}/{{ $file_upload }}" download="{{ $file_upload }}">
                                                    <button type="button" class="btn btn-primary">
                                                        <i class="glyphicon glyphicon-download">Download</i>
                                                    </button>
                                                </a>
                                            </span>
                                        </div>
                                        @endforeach    
                                        <a class="sebelum" onclick="plusSlides(-1)">&#10094;</a>
                                        <a class="lanjut" onclick="plusSlides(1)">&#10095;</a>

                                        <br>

                                        @foreach ($resp_file as $file_upload)
                                        <div class="column">
                                            {!! Html::image(asset('img/ncr_response/'.$file_upload) , null, [ 'class'=>'demo crosshair', 'style'=>'width:100%', 'onclick'=>'currentSlide('.$b.')']) !!}
                                        </div>
                                        @php
                                            $b++;
                                        @endphp
                                        @endforeach 
                                    </div>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-5 col-md-offset-5">
                                    <a class="btn btn-primary" href="{{ url('ncr_resp/'. $resp_data->id .'/print_pdf') }}"><i class="glyphicon glyphicon-print" aria-hidden="true"> Print</i></a>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    function openModal() {
      document.getElementById('myModal').style.display = "block";
    }

    function closeModal() {
      document.getElementById('myModal').style.display = "none";
    }

    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("geser");
      var dots = document.getElementsByClassName("demo");
      var captionText = document.getElementById("caption");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
      captionText.innerHTML = dots[slideIndex-1].alt;
    }
    </script>
@endsection --}}