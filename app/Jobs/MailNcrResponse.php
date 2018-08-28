<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\NcrNotifMail;
use Illuminate\Support\Facades\Mail;

class MailNcrResponse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $no_ncr,$mail_to,$created_date,$link, $est_date;

    // $ncr_creator->email,$ncr->no_reg_ncr,$created_date,$link,$est_date
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail_to, $no_ncr, $created_date,$link,$est_date)
    {
        $this->mail_to = $mail_to;
        $this->no_ncr = $no_ncr;
        $this->created_date = $created_date;
        $this->link = $link;
        $this->est_date = $est_date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail_to = trim($this->mail_to);

        // dd($mail_to);

        $message = 'Terdapat Tindak Lanjut atas NCR dengan nomor : ' . $this->no_ncr . ', pada tanggal : ' . 
                    $this->created_date . ', dengan target penyelesaian : ' . $this->est_date;
                    // dd($message);
        $keterangan = 'Email ini dihasilkan oleh sistem Online NCR sebagai media pemberitahuan, 
                        Mohon tidak membalas email ini';
        $label_link = 'Lihat Informasi Tindak Lanjut NCR';

        // dd($message);

        try{
            Mail::to($mail_to)->send(new NcrNotifMail($message,$this->no_ncr,$keterangan,$this->link,$label_link));
        }catch(Exception $e){
            dd($e);
        }
    }
}
