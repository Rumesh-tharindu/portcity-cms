<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Contact\SubmitRequest;
use App\Jobs\Inquiry\AcknowledgementJob;
use App\Jobs\Inquiry\InquiryJob;
use App\Models\Inquiry;
use App\Models\Page;
use App\Repositories\Page\PageRepository;

class ContactController extends Controller
{

    public function __construct(Page $page)
    {
        $this->page = new PageRepository($page);
    }

    public function store(SubmitRequest $request)
    {
        try {
            $inquiry = $request->all();

            if ($request->has('page_id')) {

                $page = $this->page->show($request->page_id);

                $inquiry['model'] = $page->name;

                $pageInquiry = $page->inquiries()->create($inquiry);

                $inquiry['inquiry'] = "Inquiry";

                $inquiry['reference'] = "#{$pageInquiry->reference}";

                $inquiry['submitted_at'] = $pageInquiry->created_at;
            }

            //$address = $page->emails->groupBy('type');

            $inquiry['address']['to'] = [config('app-settings.contact_email')];

/*             $inquiry['address']['cc'] = $inquiry['address']['bcc'] = [];

            if ($address->isNotEmpty()) {
                if (isset($address['TO']) && count($address['TO']) > 0) {
                    $inquiry['address']['to'] = $address['TO'];
                }
                if (isset($address['CC']) && count($address['CC']) > 0) {
                    $inquiry['address']['cc'] = $address['CC'];
                }
                if (isset($address['BCC']) && count($address['BCC']) > 0) {
                    $inquiry['address']['bcc'] = $address['BCC'];
                }
            } */

            // Inquiry email
            $iJob = (new InquiryJob($inquiry))->delay(now()->addSeconds(2));
            $this->dispatch($iJob);

            // Acknowledgement email
            if (isset($inquiry['email'])) {
                $aJob = (new AcknowledgementJob($inquiry))->delay(now()->addSeconds(2));
                $this->dispatch($aJob);
            }

            return response()->json(['message' => __('success')]);

        } catch (\Exception $e) {

            \Log::error($e->getMessage());

            return response()->json(['message' => __('fail')], 400); }
    }

}
