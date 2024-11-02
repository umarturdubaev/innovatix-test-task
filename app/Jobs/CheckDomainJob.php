<?php

namespace App\Jobs;

use App\Contracts\DomainInterface;
use App\Events\DomainChecked;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckDomainJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $domainService;
    protected $domain;
    /**
     * Create a new job instance.
     */
    public function __construct(DomainInterface $domainService, $domain)
    {
        $this->domainService = $domainService;
        $this->domain = $domain;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = $this->domainService->check($this->domain);
        event(new DomainChecked($response));
    }
}
