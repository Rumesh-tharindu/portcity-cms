<?php

namespace App\Jobs\Inquiry;

use App\Mail\AcknowledgementMail;
use App\Mail\InquiryFeedback;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use Mail;

class AcknowledgementJob implements ShouldQueue
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
        $inquiry = $this->inquiry;

        $to = [['email' => $inquiry['email'], 'name' => "{$inquiry['first_name']} {$inquiry['last_name']}"]];

        Log::info("InquiryAcknowledgementJob");

        Mail::to($to)->send(new InquiryFeedback($this->inquiry));
    }
}
