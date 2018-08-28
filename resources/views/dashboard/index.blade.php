@extends('layouts.app')

@section('content-title', 'Dashboard')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('home')}}"> Dashboard </a></li>
            <li class = "active" > Dashboard </a> </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Dashboard</h3>
            <h3 class="box-title pull-right">
            {!! Form::open(['url' => route ('dashboard.set_date'), 'method' => 'post']) !!}
                <div class="row">
                    <div class="col-xs-8">
                        {{ Form::text('dashboard_date','', array ('id' => 'monthpicker', 'placeholder' => 'MonthPicker')) }}
                    </div>
                    <div class = "form-group" style="padding-left: 80px;">
                        <div class= "col-xs-2" >
                            {!! Form::button('<i class="fa fa-check-square"></i>', ['type' => 'submit', 'class' => 'btn btn-success submit-button btn-xs'] ) !!}
                        </div>
                    </div>
            {!! Form::close() !!}

            {!! Form::open(['url' => route ('dashboard.reset_date'),'method' => 'post']) !!}
                    <div class = "form-group" style="margin-top: -15px;">
                        <div class= "col-xs-2">
                            {!! Form::button('<i class="fa fa-reply-all"></i>', ['type' => 'submit', 'class' => 'btn btn-warning submit-button btn-xs'] ) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            </h3>

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 id= 'ncr_total'>{!! $resume_ncr_data->total->jumlah !!}</h3>

                        <p style="font-size: 10pt;">{!! $resume_ncr_data->total->label !!}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                        <a href="{{route('dashboard.all_ncr')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> 
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                    <div class="inner">
                        <h3 id="ncr_reg">{!! $resume_ncr_data->registrasi->jumlah !!}</h3>

                        <p style="font-size: 10pt;">{!! $resume_ncr_data->registrasi->label !!}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-log-in"></i>
                    </div>
                    <a href="{{ route('registration_dashboard.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> 
                    </div>
                </div>
                
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 id="ncr_resp">{!! $resume_ncr_data->response->jumlah !!}</h3>

                        <p style="font-size: 10pt;">{!! $resume_ncr_data->response->label !!}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-help-circled"></i>
                    </div>
                    <a href="{{ route('response_dashboard.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> 
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id= "ncr_ver_inspector">{!! $resume_ncr_data->ver_inspector->jumlah !!}</h3>

                        <p style="font-size: 10pt;">{!! $resume_ncr_data->ver_inspector->label !!}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-alert-circled"></i>
                    </div>
                    <a href="{{ route('ins_ver_dashboard.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                
                
                <!-- ./col -->
                
                <!-- ./col -->
                <!-- ./col -->
                {{--  <div class="col-lg-2 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-light-blue">
                    <div class="inner">
                        <h3 id= "ncr_ver_auditor">{!! $resume_ncr_data->ver_auditor->jumlah !!}</h3>

                        <p style="font-size: 10pt;">{!! $resume_ncr_data->ver_auditor->label !!}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-shuffle"></i>
                    </div>
                    <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>  --}}
                </div>
                <!-- /.row -->
            <div class='row'>
                <section class="col-lg-12 connectedSortable">
                        <div class='row'>
                                <section class="col-lg-6 connectedSortable">
                                    <!-- Box -->
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">NCR by Lokasi Ketidaksesuaian</h3>
                                            <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <canvas id="chartTools" height="100%"></canvas>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </section>

                                <section class="col-lg-6 connectedSortable">
                                    <!-- Box -->
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Lokasi Produk</h3>
                                            <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <canvas id="chartTools1" height="100%"></canvas>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </section>
                            </div><!-- /.row -->

                            <div class='row'>
                                <section class="col-lg-6 connectedSortable">
                                    <!-- Box -->
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">NCR by Disposisi Unit</h3>
                                            <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <canvas id="DisposisiUnitChart" height="100%"></canvas>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </section>

                                <section class="col-lg-6 connectedSortable">
                                    <!-- Box -->
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">AkarMasalah</h3>
                                            <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <canvas id="problemSourceChart" height="100%"></canvas>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </section>

                            </div><!-- /.row -->
                </section>
            </div>
            <div class='row'>
                <section class="col-lg-12 connectedSortable">
                    <!-- Box -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">NCR by Project</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                {{-- <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> --}}
                            </div>
                        </div>
                        <div class="box-body" width="50%">
                            <canvas id="ncrProjectChart" width="100%" height="30%"></canvas>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <form action='#'>
                                <!-- <input type='text' placeholder='New task' class='form-control input-sm' /> -->
                            </form>
                        </div><!-- /.box-footer-->
                    </div><!-- /.box -->
                </section>
            </div><!-- /.row -->
        </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    
<script>
var ctx = document.getElementById("ncrProjectChart");
var ncrProjectChart = new Chart(ctx, {
  type: 'horizontalBar',
  data: {
    labels: {!! $project_name !!},
    datasets: {!! $data_graph_ncr !!},
},
  options: {
    scales: {
      yAxes: [{
        stacked: true,
        ticks: {
          beginAtZero: true
        }
      }],
      xAxes: [{
        stacked: true,
        ticks: {
          beginAtZero: true
        }
      }]  
  },
  
}
});
</script>


<script type="text/javascript">
    var data = {
                labels: {!! json_encode($data_graph_unit->labels) !!},
                datasets : [{
                    data : {!! json_encode($data_graph_unit->datasets['data']) !!} ,
                    backgroundColor : {!! json_encode($data_graph_unit->datasets['backgroundColor']) !!},
                    borderColor : {!! json_encode($data_graph_unit->datasets['borderColor']) !!},
                }]
            };
    
    
            var options = {
               responsive: true,
                legend: {
        display: true,
        labels:{
          boxWidth:10,
          fontSize:10,
        }
        
        ,
        position: 'left',
        fullWidth: true, 
        reverse: false
       
    
    },
               animation:{
                   animateScale:true
               }
            };
    
            var ctx = document.getElementById("chartTools").getContext("2d");
    
            var machineChart = new Chart (ctx,{
                type : 'doughnut' ,
                data : data,
                options : options
            });
    
    </script>
    
    <script type="text/javascript">
        
    
    var data = {
                labels: {!! json_encode($data_graph_product->labels) !!},
                datasets : [{
                    data : {!! json_encode($data_graph_product->datasets['data']) !!} ,
                    backgroundColor : {!! json_encode($data_graph_product->datasets['backgroundColor']) !!},
                    borderColor : {!! json_encode($data_graph_product->datasets['borderColor']) !!},
                }]
            };
    
            var options = {
               responsive: true,
                legend: {
        display: true,
        labels:{
          boxWidth:10,
          fontSize:10,
        }
        
        ,
        position: 'right',
        fullWidth: true, 
        reverse: false
       
    
    },
               animation:{
                   animateScale:true
               }
            };
    
            var ctx = document.getElementById("chartTools1").getContext("2d");
    
            var machineChart = new Chart (ctx,{
                type : 'doughnut' ,
                data : data,
                options : options
            });
    
    </script>
    
    
    
    <script type="text/javascript">
        
    
    var data = {
                labels: {!! json_encode($data_problem->labels) !!},
                datasets : [{
                    data : {!! json_encode($data_problem->datasets['data']) !!} ,
                    backgroundColor : {!! json_encode($data_problem->datasets['backgroundColor']) !!},
                    borderColor : {!! json_encode($data_problem->datasets['borderColor']) !!},
                }]
            };
    
            var options = {
               responsive: true,
                legend: {
        display: true,
        labels:{
          boxWidth:10,
          fontSize:10,
        }
        
        ,
        //position: 'right',
        fullWidth: true, 
        reverse: false
       
    
    },
               animation:{
                   animateScale:true
               }
            };
    
            var ctx = document.getElementById("problemSourceChart").getContext("2d");
    
            var machineChart = new Chart (ctx,{
                type : 'doughnut' ,
                data : data,
                options : options
            });
    
    </script>

    <script>
            var data = {
                        labels: {!! json_encode($data_disp_unit->labels) !!},
                        datasets : [{
                            data : {!! json_encode($data_disp_unit->datasets['data']) !!} ,
                            backgroundColor : {!! json_encode($data_disp_unit->datasets['backgroundColor']) !!},
                            borderColor : {!! json_encode($data_disp_unit->datasets['borderColor']) !!},
                        }]
                    };
            
                          var options = {
                       responsive: true,
                        legend: {
                display: true,
                labels:{
                  boxWidth:10,
                  fontSize:10,
                }
                
                ,
                //position: 'left',
                fullWidth: true, 
                reverse: false
               
            
            },
                       animation:{
                           animateScale:true
                       }
                    };
            
            
                    var ctx = document.getElementById("DisposisiUnitChart").getContext("2d");
            
                    var machineChart = new Chart (ctx,{
                        type : 'doughnut' ,
                        data : data,
                        options : options
                    });
            
            </script>
    
@endsection


