@extends('layouts.app')

@section('content-title', 'Dashboard Monitoring')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('home')}}"> Dashboard </a></li>
            <li> <a href = "{{ route('monitoring_dashboard.index') }}"> Dashboard Monitoring </a></li>
            <li class = "active" > Dashboard Registration NCR </a> </li>
        </ul>
    
        <div class="row">
            <div class="col-lg-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Data NCR yang belum memiliki diverifikasi oleh inspektor</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Detail Inspektor</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class='row'>
                                <section class="col-lg-9 connectedSortable">
                                    <!-- Box -->
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">NCR by Project</h3>
                                            <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <canvas id="ncrProjectChart" width="100%" height="30%"></canvas>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </section>

                                <section class="col-lg-3 connectedSortable">
                                    <!-- Box -->
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Kategori Ketidaksesuaian</h3>
                                            <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body" style="padding-top: 1px; padding-bottom: 1px;">
                                            <div class="row">
                                                <div class="col-md-12 col-xs-12">
                                                    <!-- small box -->
                                                    <div class="small-box bg-teal">
                                                        <div class="inner">
                                                            <h3 id= 'ncr_total'>{!! $incompatibility_data->mayor->amount!!}</h3>

                                                            <p>{!! $incompatibility_data->mayor->label!!}</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fa fa-cubes"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xs-12">
                                                    <!-- small box -->
                                                    <div class="small-box bg-aqua">
                                                        <div class="inner">
                                                            <h3 id= 'ncr_total'>{!! $incompatibility_data->minor->amount!!}</h3>

                                                            <p>{!! $incompatibility_data->minor->label!!}</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fa fa-cube"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </section>
                            </div><!-- /.row -->

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
                        </div><!-- /.box -->

                        <div class="tab-pane" id="tab_2">
                            <div class='row'>
                                <section class="col-lg-12 connectedSortable">
                                    <!-- Box -->
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">NCR by Project</h3>
                                            <div class="box-tools pull-right">
                                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <canvas id="divProportionChart" height="100%"></canvas>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
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
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            {!! $html->table(['class' => 'table-responsive', 'width' => '100%']) !!}
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                </section>
                            </div>
                        </div><!-- /.box -->

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')

 {!! $html->scripts() !!} 

<script>
var ctx = document.getElementById("ncrProjectChart");
var ncrProjectChart = new Chart(ctx, {
  type: 'horizontalBar',
  data: {
    labels: {!! $project_name !!},
    datasets: {!! $data_graph_ncr_reg !!},
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

<script type="text/javascript">

        
var data = {
            labels: {!! json_encode($data_graph_inspector->labels) !!},
            datasets : [{
                data : {!! json_encode($data_graph_inspector->datasets['data']) !!} ,
                backgroundColor : {!! json_encode($data_graph_inspector->datasets['backgroundColor']) !!},
                borderColor : {!! json_encode($data_graph_inspector->datasets['borderColor']) !!},
            }]
        };

        var options = {
           animation:{
               animateScale:true
           }
        };

        var ctx = document.getElementById("divProportionChart").getContext("2d");

        var machineChart = new Chart (ctx,{
            type : 'doughnut' ,
            data : data,
            options : options
        });

</script>


<script type="text/javascript">

        
@endsection


