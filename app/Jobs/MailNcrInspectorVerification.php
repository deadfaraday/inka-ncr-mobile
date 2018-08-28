<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\NcrNotifMail;
use Illuminate\Support\Facades\Mail;

class MailNcrInspectorVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $mail_to, $no_ncr, $created_date , $link;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail_to, $no_ncr, $created_date , $link)
    {
        $this->mail_to = $mail_to;
        $this->no_ncr = $no_ncr;
        $this->created_date = $created_date;
        $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail_to = trim($this->mail_to);

        $message = 'Tindak Lanjut atas NCR dengan nomor : ' . $this->no_ncr . ', telah diverifikasi pada tanggal : ' . $this->created_date;
                    
        $keterangan = 'Email ini dihasilkan oleh sistem Online NCR sebagai media pemberitahuan, 
                        Mohon tidak membalas email ini';
        $label_link = null;
        
        try{
            Mail::to($mail_to)->send(new NcrNotifMail($message,$this->no_ncr,$keterangan,null,null));
        }catch(Exception $e){
        
        }
    }
}
