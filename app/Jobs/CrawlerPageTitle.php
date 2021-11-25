<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ShortUrl;

class CrawlerPageTitle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $shortUrl;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ShortUrl $shortUrl)
    {
        $this->shortUrl = $shortUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load($this->shortUrl->url);

        if (!empty($response)) {
            $this->shortUrl->title = $response->find('title', 0)->plaintext;

            $this->shortUrl->save();
        }
    }
}
