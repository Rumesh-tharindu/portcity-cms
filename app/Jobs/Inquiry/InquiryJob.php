<?php

namespace App\Jobs\Inquiry;

use App\Mail\InquiryMail;
use App\Mail\InquirySend;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class InquiryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $inquiry;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        \Log::info("InquiryJob");

        Mail::to($this->inquiry['address']['to'])
/*             ->cc($this->inquiry['address']['cc'])
            ->bcc($this->inquiry['address']['bcc']) */
            ->send(new InquirySend($this->inquiry));
    }
}
