@extends('layouts.app')

@section('styles')
    <link href="/css/costum.css" rel="stylesheet">
@endsection

@section('content-title', 'NCR Print')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('home')}}"> Dashboard </a></li>
            <li> <a href = "{{ url('/ncr_reg') }}"> NCR Registration </a>
            <li class = "active" > NCR Print </a> </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">NCR Print</h3>
        </div>
        <div class="box-body">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3"><p>No. NCR </p></div>
                    <div class="col-md-9"><p>: {{ ($ncr_data->no_reg_ncr) }}</p></div>
                </div>
                        
                <div class="row">
                    <div class="col-md-3"><p>No Reg Inspektor</p></div>
                    <div class="col-md-9"><p>: {{ ($userinspector->inspector_number) }}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Tanggal Terbit</p></div>
                    <div class="col-md-9"><p>: {{ ($ncr_data->publish_date) }}</p></div>
                </div>

                {{-- <div class="row">
                    <div class="col-md-3"><p>Identitas Produk</p></div>
                    <div class="col-md-9"><p>: {{ ($ncr_data->product_identity->identity_description) }}</p></div>
                </div> --}}

                <div class="row">
                    <div class="col-md-3"><p>Nama Proses</p></div>
                    <div class="col-md-9"><p>: {{ ($ncr_data->process_name) }}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Nama/Kode Proyek</p></div>
                    <div class="col-md-9"><p>: {{ ($ncr_data->project->project_code."/".$ncr_data->project->project_description) }}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Lokasi Ketidaksesuaian</p></div>
                    <div class="col-md-9"><p>: {{ ($ncr_data->division->division_name) }}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Acuan Pemeriksaan</p></div>
                    <div class="col-md-9"><p>: {{ ($ncr_data->reference_inspection) }}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Jenis Produk</p></div>
                    <div class="col-md-9"><p>: {{ ($ncr_data->product->product_description) }}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Uraian Ketidaksesuaian</p></div>
                     <div class="col-md-9"><p>: {!! ($ncr_data->description_incompatibility) !!}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Disposisi Inspektor</p></div>
                    <div class="col-md-9"><p>: {{ ($ncr_data->disposition_inspector->disposisi_description) }}</p></div>
                </div>

                <div class="row">
                    <div class="col-md-3"><p>Target Penyelesaian</p></div>
                    <div class="col-md-9"><p>: {{ ($ncr_data->completion_target) }}</p></div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="row">
                    <div class="col-md-12"><p>File Upload</p></div>
                </div>
                <div class="row">
                        <div class="col-md-12">
                            @if(count($ncr_file) > 0)
                                <p>
                                    {{--  {!! Html::image(asset('img/ncr_reg/'.$ncr_file->get(0)), null, ['class'=>'hover-shadow crosshair', 'alt'=>'$ncr_file->get(0)', 'width'=>'90%', 'height'=>'35%', 'onclick'=>'openModal();currentSlide(1)']) !!}  --}}
                                    <img src="{{ route('ncr_reg_preview', $ncr_file->get(0)) }}" class="hover-shadow crosshair" 
                                        alt="No Image" width="90%" height="35%" onclick="openModal();currentSlide(1)">  
                                </p>
                            @endif
                        </div>
                        
                        @php
                            $a = 0;
                            $b = 1;
                        @endphp

                        {{--  @if(count($ncr_file) > 0)
                            @foreach ($ncr_file as $file_upload)
                                <p>  --}}
                                    {{--  {!! Html::image(asset('img/ncr_reg/'.$file_upload) , null, 
                                    ['class'=>'hover-shadow crosshair', 'alt'=>'$file_upload', 'width'=>'0%', 
                                    'height'=>'0%', 'onclick'=>'openModal();currentSlide('.$a.')']) !!}  --}}
                                    {{--  <img src="{{ route('ncr_reg_preview', $file_upload) }}" class="hover-shadow crosshair" 
                                        alt="No Image" width="0%" height="0%" onclick="openModal();currentSlide('.$a')">  
                                </p>
                                @php
                                    $a++;
                                @endphp
                            @endforeach
                        @endif  --}}

                        @if(count($ncr_file) > 0)       
                        <div id="myModal" class="mod">
                            <span class="close crosshair" onclick="closeModal()">&times;</span>
                                <div class="mod-content">
                                    @foreach ($ncr_file as $file_upload)
                                        <div class="geser">
                                            {{--  {!! Html::image(asset('img/ncr_reg/'.$file_upload) , null, [ 'style'=>'width:100%']) !!}  --}}
                                            <img src="{{ route('ncr_reg_preview', $file_upload) }}"  width="100%">  
                                            
                                            <span class="unduh">
                                                {{--  <a href="{{URL::to('img/ncr_reg')}}/{{ $file_upload }}" download="{{ $file_upload }}">  --}}
                                                 <a href="{{ route('ncr_reg_download', $file_upload) }}">     
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

                                        @foreach ($ncr_file as $file_upload)
                                        <div class="column">
                                            {{--  {!! Html::image(asset('img/ncr_reg/'.$file_upload) , null, 
                                            [ 'class'=>'demo crosshair', 'style'=>'width:100%', 'onclick'=>'currentSlide('.$b.')']) !!}  --}}
                                             <img src="{{ route('ncr_reg_preview', $file_upload) }}" class="demo crosshair" 
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
                    <li> <a href = "{{ url('/ncr_reg') }}"> NCR Registration </a>
                    <li class = "active" > NCR Print </a> </li>
                 </ul>

                 <div class = "panel panel-default">
                    <div class = "panel-heading">
                        <h2 class = "panel title"> NCR Print </h2>
                    </div>

                    <div class = "panel-body">
                    <div id="left">
                        <div class="row">
                            <div class="col-md-3"><p>No. NCR </p></div>
                            <div class="col-md-9"><p>: {{ ($ncr_data->no_reg_ncr) }}</p></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3"><p>No Reg Inspektor</p></div>
                            <div class="col-md-9"><p>: {{ ($userinspector->inspector_number) }}</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><p>Tanggal Terbit</p></div>
                            <div class="col-md-9"><p>: {{ ($ncr_data->publish_date) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Identitas Produk</p></div>
                            <div class="col-md-9"><p>: {{ ($ncr_data->product_identity->identity_description) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Nama Proses</p></div>
                            <div class="col-md-9"><p>: {{ ($ncr_data->process_name) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Nama/Kode Proyek</p></div>
                            <div class="col-md-9"><p>: {{ ($ncr_data->project->project_code."/".$ncr_data->project->project_description) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Lokasi Ketidaksesuaian</p></div>
                            <div class="col-md-9"><p>: {{ ($ncr_data->division->division_name) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Acuan Pemeriksaan</p></div>
                            <div class="col-md-9"><p>: {{ ($ncr_data->reference_inspection) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Jenis Produk</p></div>
                            <div class="col-md-9"><p>: {{ ($ncr_data->product->product_description) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Uraian Ketidaksesuaian</p></div>
                            <div class="col-md-9"><p>: {{ ($ncr_data->description_incompatibility) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Disposisi Inspektor</p></div>
                            <div class="col-md-9"><p>: {{ ($ncr_data->disposition_inspector->disposisi_description) }}</p></div>
                        </div>

                        <div class="row">
                            <div class="col-md-3"><p>Target Penyelesaian</p></div>
                            <div class="col-md-9"><p>: {{ ($ncr_data->completion_target) }}</p></div>
                        </div>
                    </div>
                  
                    <div id="right">
                        <div class="row">
                            <div class="col-md-3"><p>File Upload</p></div>

                            <div class="col-md-4">
                                @if(count($ncr_file) > 0)
                                    <p>
                                        {!! Html::image(asset('img/ncr_reg/'.$ncr_file->get(0)), null, ['class'=>'hover-shadow crosshair', 'alt'=>'$ncr_file->get(0)', 'width'=>'90%', 'height'=>'35%', 'onclick'=>'openModal();currentSlide(1)']) !!}
                                    </p>
                                @endif
                            </div>
                        
                            @php
                                $a = 0;
                                $b = 1;
                            @endphp

                            @if(count($ncr_file) > 0)
                                @foreach ($ncr_file as $file_upload)
                                    <p>
                                        {!! Html::image(asset('img/ncr_reg/'.$file_upload) , null, ['class'=>'hover-shadow crosshair', 'alt'=>'$file_upload', 'width'=>'0%', 'height'=>'0%', 'onclick'=>'openModal();currentSlide('.$a.')']) !!}
                                    </p>
                                    @php
                                        $a++;
                                    @endphp
                                @endforeach
                            @endif

                            @if(count($ncr_file) > 0)       
                                <div id="myModal" class="mod">
                                    <span class="close crosshair" onclick="closeModal()">&times;</span>
                                    <div class="mod-content">
                                        @foreach ($ncr_file as $file_upload)
                                        <div class="geser">
                                            {!! Html::image(asset('img/ncr_reg/'.$file_upload) , null, [ 'style'=>'width:100%']) !!}
                                            <span class="unduh">
                                                <a href="{{URL::to('img/ncr_reg')}}/{{ $file_upload }}" download="{{ $file_upload }}">
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

                                        @foreach ($ncr_file as $file_upload)
                                        <div class="column">
                                            {!! Html::image(asset('img/ncr_reg/'.$file_upload) , null, [ 'class'=>'demo crosshair', 'style'=>'width:100%', 'onclick'=>'currentSlide('.$b.')']) !!}
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
                                    <a class="btn btn-primary" href="{{ url('ncr_reg/'. $ncr_data->id .'/print_pdf') }}"><i class="glyphicon glyphicon-print" aria-hidden="true"> Print</i></a>
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