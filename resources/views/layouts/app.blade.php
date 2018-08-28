@extends('admin-lte::layouts.main')

@if (auth()->check())
@section('user-avatar', 'https://www.gravatar.com/avatar/' . md5(auth()->user()->email) . '?d=mm')
@section('user-name', auth()->user()->name)
@endif

@section('sidebar-menu')
<ul class="sidebar-menu">
  	<li class="header">MAIN NAVIGATOR</li>
  	
  	<li class="active">
    	<a href="{{ route('home') }}">
      	<i class="fa fa-home"></i>
      		<span>Home</span>
    	</a>
  	</li>

  	@role('administrator')
        <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>Master</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('project.index') }}"><i class="fa fa-circle-o"></i>Project</a></li>
                <li><a href="{{ route('employee.index') }}"><i class="fa fa-circle-o"></i>Karyawan</a></li> 
                <li><a href="{{ route('inspector.index') }}"><i class="fa fa-circle-o"></i>Inspector</a></li>
            </ul>     
        </li>

        <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>NCR</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('ncr_reg.index') }}"><i class="fa fa-circle-o"></i>NCR Registration</a></li>
                <li><a href="{{ route('ncr_resp.index') }}"><i class="fa fa-circle-o"></i>NCR Response</a></li>
                <li><a href="{{ route('inspector_verification.index') }}"><i class="fa fa-circle-o"></i>Verifikasi NCR</a></li>
            </ul>     
        </li>

         <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>Monitoring</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('report_ncr_reg.index') }}"><i class="fa fa-circle-o"></i>NCR Registration</a></li>
                <li><a href="{{ route('report_ncr_resp.index') }}"><i class="fa fa-circle-o"></i>NCR Response</a></li>  
            </ul>     
        </li>
    @endrole

    @role('inspektor')
        <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>NCR</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('ncr_reg.index') }}"><i class="fa fa-circle-o"></i>NCR Registration</a></li>
                <li><a href="{{ route('ncr_resp.index') }}"><i class="fa fa-circle-o"></i>NCR Response</a></li>
                <li><a href="{{ route('inspector_verification.index') }}"><i class="fa fa-circle-o"></i>Verifikasi NCR</a></li>
            </ul>     
        </li>

         <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>Report NCR</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            
            <ul class="treeview-menu">
                <li><a href="{{ route('generate_report_ncr.create') }}"><i class="fa fa-circle-o"></i>Generate Report NCR</a></li>
            </ul>
        </li>
    @endrole

    @role('admin_pic_response')
        <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>NCR</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('ncr_resp.index') }}"><i class="fa fa-circle-o"></i>NCR Response</a></li>
            </ul>     
        </li>

        <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>Report NCR</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            
            <ul class="treeview-menu">
                <li><a href="{{ route('generate_report_ncr.create') }}"><i class="fa fa-circle-o"></i>Generate Report NCR</a></li>
            </ul>
        </li>
    @endrole

    @role('manager')
        <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>NCR (Manager)</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('ncr_resp.index') }}"><i class="fa fa-circle-o"></i>NCR Response</a></li>
            </ul>
            
            <ul class="treeview-menu">
                <li><a href="{{ route('generate_report_ncr.create') }}"><i class="fa fa-circle-o"></i>Generate Report NCR</a></li>
            </ul>
        </li>

         <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>Report NCR</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            
            <ul class="treeview-menu">
                <li><a href="{{ route('generate_report_ncr.create') }}"><i class="fa fa-circle-o"></i>Generate Report NCR</a></li>
            </ul>
        </li>
    @endrole

    @role('auditor_mmlh')
        <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>NCR</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('auditor_verification.index') }}"><i class="fa fa-circle-o"></i>Verifikasi NCR</a></li>
            </ul>     
        </li>
        <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>Monitoring</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('monitoring_dashboard.index') }}"><i class="fa fa-circle-o"></i>Show Dashboard</a></li>
            </ul>     
        </li>
    @endrole

    
    @role('gm')
         <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>Monitoring</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('monitoring_dashboard.index') }}"><i class="fa fa-circle-o"></i>Show Dashboard</a></li>
                <li><a href="{{ route('report_ncr_reg.index') }}"><i class="fa fa-circle-o"></i>NCR Registration</a></li>
                <li><a href="{{ route('report_ncr_resp.index') }}"><i class="fa fa-circle-o"></i>NCR Response</a></li> 
            </ul>     
        </li>
    @endrole

    @role('struktural')
         <li class="treeview">
            <a href="#">
            <i class="fa fa-book"></i><span>Monitoring</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                @role('senior_manager')
                    <li><a href="{{ route('monitoring_dashboard.index') }}"><i class="fa fa-circle-o"></i>Show Dashboard</a></li>
                @endrole
                <li><a href="{{ route('report_ncr_reg.index') }}"><i class="fa fa-circle-o"></i>NCR Registration</a></li>
                <li><a href="{{ route('report_ncr_resp.index') }}"><i class="fa fa-circle-o"></i>NCR Response</a></li> 
            </ul>     
        </li>

        
    @endrole
    

</ul>
@endsection

@section('scripts')

<script>
    $('#btn_submit').click(function()
    {   
        var btn_submit = document.getElementById("btn_submit");
        btn_submit.disabled =true;
        btn_submit.value="Submitting Data ....";
    });
</script>

@endsection