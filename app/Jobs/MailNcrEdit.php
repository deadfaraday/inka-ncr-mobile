<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\NcrNotifMail;
use Illuminate\Support\Facades\Mail;

class MailNcrEdit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $no_ncr,$reference,$date,$link, $user_cc, $mail_to;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($no_ncr, $reference, $date, $link, $user_cc, $mail_to)
    {
        $this->no_ncr = $no_ncr;
        $this->reference = $reference;
        $this->date = $date;
        $this->link = $link;
        $this->user_cc = $user_cc;
        $this->mail_to = $mail_to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = 'Terdapat Perubahan Unit Tujuan NCR dengan nomor : ' . $this->no_ncr . ' dengan acuan pemeriksaan : ' 
            .$this->reference .', pada tanggal :' . $this->date;
        

        $keterangan = 'Email ini dihasilkan oleh sistem Online NCR sebagai media pemberitahuan, 
                        Mohon tidak membalas email ini';
        $label_link = 'Lihat Informasi NCR';

        $mail_to = trim($this->mail_to);
        
        try{
            Mail::to($mail_to)
                ->cc($this->user_cc)
                ->send(new NcrNotifMail($message,$this->no_ncr,$keterangan,$this->link,$label_link));
            }catch(Exception $e){
            echo ($e);    
        }
    }
}
