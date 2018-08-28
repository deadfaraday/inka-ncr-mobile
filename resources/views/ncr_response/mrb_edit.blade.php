@extends('layouts.app')

@section('content-title', 'Disposisi MRB ')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class = "breadcrumb">
            <li> <a href = "{{ url('/home') }}"> Dashboard</a>
            <li> <a href = "{{ url('/ncr_resp') }}"> NCR Response </a>
            <li class= "active"> Disposisi MRB </li>
        </ul>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Disposisi MRB</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['url' => url('ncr_resp/'.$ncr_resp_id.'/mrb'),
                'method' => 'put' , 'files' => 'true' , 'class' => 'form-horizontal']) !!}
                @include('ncr_response._form_edit_mrb')

            {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
   
    $(document).on('click', '.input-remove-row', function(){ 
        var tr = $(this).closest('tr');
        tr.fadeOut(200, function(){
            tr.remove();
        });
    });

    function check_existing_dept(addedDept)
    {
         
        var tabel = document.getElementById('tabel_dept_mrb');
        var rowCount = tabel.rows.length;
        //alert(rowCount);
            
        for(var r = 0 ; r < rowCount-1 ; r++)
        {
            var existingDept = tabel.rows[r+1].cells[0].innerHTML;
            //alert(existingMachine);
            if (existingDept == addedDept){
                alert("Departemen Sudah Dipilih");
                return 1;
            }
        }
        return 0;
    }

    $(function(){
        $('.preview-add-button').click(function(){
            var form_data = {};
            
            form_data["response_mrb_dept"] = $('.mrb-form #mrb_departemen option:selected').val();
            var addedDept = form_data["response_mrb_dept"];
            form_data["remove-row"] = '<button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></button>';
            var row = $('<tr></tr>');
            
            var exist = check_existing_dept(addedDept);
                if(!exist){
                        
                    $.each(form_data, function( type, value ) {
                        $('<td class="input-'+type+'"></td>').html(value).appendTo(row);
                    });
                    $('.preview-table > tbody:last').append(row);
                
                } 
        });  
        
        $('.submit-button').click(function(){
            
            var tabelku = document.getElementById('tabel_dept_mrb');
            var jumlahRow= tabelku.rows.length;
            //alert(jumlahRow);
            var lists = new Array();

            for (var row=0 ;row< jumlahRow-1; row++){
                lists[row] = new Array();    

                dept = tabelku.rows[row+1].cells[0].innerHTML;
                
                lists[row][1]=dept;
            }
            
            var mrb_id = $('.mrb-form #mrb_disposition option:selected').val();
            var ncr_resp_id = $('.mrb-form input[name="ncr_resp_id"]').val();
            var link = 'ncr_response/' + ncr_resp_id + '/mrb';
            
            
            var link = '{!! url("ncr_resp/'+ncr_resp_id+'/mrb_update'+'") !!}';
          
            if(lists == 0)
            {
                alert('Anda Belum Memilih Departemen');
                return 0;
            }

            $.ajax({
                url: link,
                data: { "_token" : "{{ csrf_token() }}", "lists" : lists, "id" : ncr_resp_id ,"mrb_id" :mrb_id },
                type: "put",
                cache: false,
                success: function (savingStatus) {
                    alert('Berhasil Menyimpan Request');
                    // redirect to previous page
                    window.location.href = '{{ route("ncr_resp.index") }}';
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Gagal Menyimpan Request');
                    //window.location.href = '{{ url("admin/goods_take") }}';
                    // window.location.href = headerLink;
                }
            });
        });
        

    });
</script>
@endsection

{{-- @extends('layouts.app')

@section('content')
    <div class= "container">
        <div class= "row">
            <div class = "col-md-12">
                <ul class = "breadcrumb">
                    <li> <a href = "{{ url('/home') }}"> Dashboard</a>
                    <li> <a href = "{{ url('/ncr_reg') }}"> NCR Registration </a>
                    <li class= "active"> Disposisi MRB </li>
                </ul>

                <div class= "panel panel-default">
                    <div class= "panel-heading">
                        <h2 class = "panel-title"> Disposisi MRB</h2>
                    </div>

                    <div class = "panel-body">

                         {!! Form::open(['url' => url('ncr_resp/'.$ncr_resp_id.'/mrb'),
                            'method' => 'put' , 'files' => 'true' , 'class' => 'form-horizontal']) !!}
                            @include('ncr_response._form_mrb')

                            {!! Form::close() !!}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
   
    $(document).on('click', '.input-remove-row', function(){ 
        var tr = $(this).closest('tr');
        tr.fadeOut(200, function(){
            tr.remove();
        });
    });

    function check_existing_dept(addedDept)
    {
         
        var tabel = document.getElementById('tabel_dept_mrb');
        var rowCount = tabel.rows.length;
        //alert(rowCount);
            
        for(var r = 0 ; r < rowCount-1 ; r++)
        {
            var existingDept = tabel.rows[r+1].cells[0].innerHTML;
            //alert(existingMachine);
            if (existingDept == addedDept){
                alert("Departemen Sudah Dipilih");
                return 1;
            }
        }
        return 0;
    }

    $(function(){
        $('.preview-add-button').click(function(){
            var form_data = {};
            
            form_data["response_mrb_dept"] = $('.mrb-form #mrb_departemen option:selected').val();
            var addedDept = form_data["response_mrb_dept"];
            form_data["remove-row"] = '<button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></button>';
            var row = $('<tr></tr>');
            
            var exist = check_existing_dept(addedDept);
                      if(!exist){
                        
                $.each(form_data, function( type, value ) {
                    $('<td class="input-'+type+'"></td>').html(value).appendTo(row);
                });
                $('.preview-table > tbody:last').append(row);
               
           } 
        });  
        
        $('.submit-button').click(function(){
            
            var tabelku = document.getElementById('tabel_dept_mrb');
            var jumlahRow= tabelku.rows.length;
            //alert(jumlahRow);
            var lists = new Array();

            for (var row=0 ;row< jumlahRow-1; row++){
                lists[row] = new Array();    

                dept = tabelku.rows[row+1].cells[0].innerHTML;
                
                lists[row][1]=dept;
            }
            
            var mrb_id = $('.mrb-form #mrb_disposition option:selected').val();
            var ncr_resp_id = $('.mrb-form input[name="ncr_resp_id"]').val();
            var link = 'ncr_response/' + ncr_resp_id + '/mrb';
            
            
            var link = '{!! url("ncr_resp/'+ncr_resp_id+'/mrb'+'") !!}';
          
            if(lists == 0)
            {
                alert('Anda Belum Memilih Departemen');
                return 0;
            }

            $.ajax({
                url: link,
                data: { "_token" : "{{ csrf_token() }}", "lists" : lists, "id" : ncr_resp_id ,"mrb_id" :mrb_id },
                type: "put",
                cache: false,
                success: function (savingStatus) {
                    alert('Berhasil Menyimpan Request');
                    // redirect to previous page
                    window.location.href = '{{ route("ncr_resp.index") }}';
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Gagal Menyimpan Request');
                    //window.location.href = '{{ url("admin/goods_take") }}';
                    // window.location.href = headerLink;
                }
            });
        });
        

    });
</script>
@endsection --}}