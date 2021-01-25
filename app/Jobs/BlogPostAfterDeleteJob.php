<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlogPostAfterDeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $blogPostID;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($blogPostID)
    {
        $this->blogPostID = $blogPostID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logs()->warning("Удалена запись в блоге id[{$this->blogPostID}]");
    }
}
