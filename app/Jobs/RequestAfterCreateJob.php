<?php

namespace App\Jobs;

use App\Mail\EmailForRequests;
use App\Models\Request;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class RequestAfterCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logs()->info('Created new request [$this->request->name]');
        $email = new EmailForRequests($this->request);
        $manager = User::where(function ($query) {
            $query->whereHas('roles', function ($subquery) {
                $subquery->where('slug', 'manager');
            });
        })
        ->with('roles')
        ->first();
        //$email->attach(base_path($this->request->file_path));
        Mail::to($manager->email)->send($email);
    }
}
