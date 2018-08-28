<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\NcrRegistration;
use App\Services\PrintNcr;

class NcrNotifMail extends Mailable
{
    use Queueable, SerializesModels;
    public $pesan,$no_ncr,$disclaimer,$label_link,$link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pesan,$no_ncr,$disclaimer,$link,$label_link)
    {
        $this->pesan = $pesan;
        $this->no_ncr = $no_ncr;
        $this->disclaimer = $disclaimer;
        $this->label_link= $label_link;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         // creaate attachment 
         $ncr = NcrRegistration::where('no_reg_ncr',$this->no_ncr)->first();
         $printer = new PrintNcr();
         $file_ncr = $printer->ncr_pdf($ncr->id);

        return $this->subject(' ONLINE NCR  (Nomor NCR : '. $this->no_ncr.')')
            
            ->attachData($file_ncr->output(), $this->no_ncr .'.pdf')
            ->view('ncr_notif_mail.info');
    }
}
