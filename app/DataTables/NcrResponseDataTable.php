<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;

use Illuminate\Support\Facades\Auth;
use App\NcrRegistration;

class NcrResponseDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            
            ->addColumn('response', function($ncr){
                if($ncr->is_response == 1)
                {
                    return view ('datatable._response_disabled');
                }
                else
                {
                    return view ('datatable._response',[
                            'model'    => $ncr,
                            'response_url' => route('ncr_resp.show', $ncr->id),
                        ]);             
                }    
            })

            ->addColumn('edit', function($ncr){    
                if($ncr->is_response==1){
                    return view ('datatable._edit',[
                        'model'    => $ncr,
                        'edit_url' => route('ncr_resp.edit', $ncr->id),
                    ]);
                }
                else{
                    return view ('datatable._edit_disabled');
                }
                             
            })

            ->addColumn('print', function($ncr){    
                if($ncr->is_response==1){
                    return view ('datatable._print',[
                        'model'    => $ncr,
                        'print_url' => route('ncr_resp.print', $ncr->id),
                    ]); 
                }
                else{
                    return view('datatable._print_disabled');
                }            
            })

        
            ->rawColumns(['response','edit','print','upload'])
            ->make('true');
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $user = Auth::user();
        // $uid = User::find($user->id);

        // $divisi_id = $uid->divisi_id;
        $query = NcrRegistration::with('division','user','product_identity','project','product')
                ->where('division_id', $user->divisi_id)        
                ->orWhere(function($choose_pic){
                // ini oleh inspektor pembuat
                $choose_pic->where('user_id', Auth::id());
                // oleh sekdiv unit yang dituju
                $choose_pic->orWhere('id_pic_respon',Auth::id());
                })
            // ini oleh manager unit terkait, pembatasan manager ada di middleware , lihat route
            // ->where('division_id', $user->divisi_id)
            ->whereNull('is_cancel');
            
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->columns([
            (['data' => 'no_reg_ncr', 'name' => 'no_reg_ncr' , 'title' => 'No NCR']),
            (['data' => 'user.name', 'name' => 'user.name' , 'title' => 'Nama Inspektor']),
            (['data'=> 'publish_date' ,'name' => 'publish_date' , 'title' => 'Tanggal Terbit']),
            (['data'=> 'process_name' ,'name' => 'process_name' , 'title' => 'Nama Proses']),
            (['data'=> 'division.division_name' ,'name' => 'division.division_name' , 'title' => 'Unit']),
            (['data'=> 'project.project_code' ,'name' => 'project.project_code' , 'title' => 'Kode Proyek']),
            (['data'=> 'response' ,'name' => 'response' , 'title' => '' ,'orderable' => false,'searchable' => false, 'width' => '25px']),
            (['data'=> 'edit' ,'name' => 'edit' , 'title' => '' ,'orderable' => false,'searchable' => false, 'width' => '25px']),
            (['data'=> 'print' ,'name' => 'print' , 'title' => '' ,'orderable' => false,'searchable' => false, 'width' => '25px'])
        ])
        
        ->parameters([
            'buttons' => ['excel', 'reset', 'reload'],
            'dom' => '<"row"<"col-sm-4"l><"col-sm-5"B><"col-sm-3"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',  
        ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            (['data' => 'no_reg_ncr', 'name' => 'no_reg_ncr' , 'title' => 'No NCR']),
            (['data' => 'user.name', 'name' => 'user.name' , 'title' => 'Nama Inspektor']),
            (['data'=> 'publish_date' ,'name' => 'publish_date' , 'title' => 'Tanggal Terbit']),
            (['data'=> 'process_name' ,'name' => 'process_name' , 'title' => 'Nama Proses']),
            (['data'=> 'division.division_name' ,'name' => 'division.division_name' , 'title' => 'Unit']),
            (['data'=> 'project.project_code' ,'name' => 'project.project_code' , 'title' => 'Kode Proyek']),
            (['data'=> 'response' ,'name' => 'response' , 'title' => '' ,'orderable' => false,'searchable' => false, 'width' => '25px']),
            (['data'=> 'edit' ,'name' => 'edit' , 'title' => '' ,'orderable' => false,'searchable' => false, 'width' => '25px']),
            (['data'=> 'print' ,'name' => 'print' , 'title' => '' ,'orderable' => false,'searchable' => false, 'width' => '25px'])
   
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ncr_tindak_lanjut' . time();
    }
}
