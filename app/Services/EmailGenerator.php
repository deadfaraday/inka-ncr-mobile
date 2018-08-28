<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\NcrNotifMail;
use Carbon\Carbon;
use App\NcrRegistration;
use App\Services\PrintNcr;

class EmailGenerator
{
    public function ncrNew($mail_to,$no_ncr,$reference,$date,$link, $user_cc){
        $message = 'Terdapat NCR baru dengan nomor : ' . $no_ncr . ' dengan acuan pemeriksaan : ' 
                    .$reference .', pada tanggal :' . $date;
        $keterangan = 'Email ini dihasilkan oleh sistem Online NCR sebagai media pemberitahuan, 
                        Mohon tidak membalas email ini';
        $label_link = 'Lihat Informasi NCR';

        $mail_to = trim($mail_to);

        try{
            Mail::to($mail_to)
            ->cc($user_cc)
            ->send(new NcrNotifMail($message,$no_ncr,$keterangan,$link,$label_link));
        }catch(Exception $e){
            // dd($e);
        }
    }

    public function ncrResponse($mail_to,$no_ncr,$date,$link,$est_date){
        $mail_to = trim($mail_to);

        $message = 'Terdapat Tindak Lanjut atas NCR dengan nomor : ' . $no_ncr . ', pada tanggal : ' . $date .
                    ', dengan target penyelesaian : ' . $est_date;
                    
        $keterangan = 'Email ini dihasilkan oleh sistem Online NCR sebagai media pemberitahuan, 
                        Mohon tidak membalas email ini';
        $label_link = 'Lihat Informasi Tindak Lanjut NCR';
        try{
            Mail::to($mail_to)->send(new NcrNotifMail($message,$no_ncr,$keterangan,$link,$label_link));
        }catch(Exception $e){
            // dd($e);
        }
    }

    public function ncrInsVerification($mail_to,$no_ncr,$date,$link){
        $mail_to = trim($mail_to);

        $message = 'Tindak Lanjut atas NCR dengan nomor : ' . $no_ncr . ', telah diverifikasi pada tanggal : ' . $date;
                    
        $keterangan = 'Email ini dihasilkan oleh sistem Online NCR sebagai media pemberitahuan, 
                        Mohon tidak membalas email ini';
        $label_link = 'Lihat Informasi Tindak Lanjut NCR';
        try{
            Mail::to($mail_to)->send(new NcrNotifMail($message,$no_ncr,$keterangan,$link,$label_link));
        }catch(Exception $e){
            // dd($e);
        }
    }
}