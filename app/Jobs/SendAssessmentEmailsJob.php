<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\HelperFunctions;
use App\Models\JobOpening;

class SendAssessmentEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $applications;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($applications)
    {
        $this->applications = $applications;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd($this->applications);
        $application_emails = [];
        foreach($this->applications as $application) {
           
            try {
                $user = User::where('id', $application->user_id)->first();
                $job_opening_id = $application->job_opening_id;

              
                if($user) {

                    $user->role_id = 8;
                    $user->role_name = 'candidate';
                    $user->save();
                  
                }
                // $application->user_id = $user->id;
                // if($application->status < 3) {
                    $application->status = 2;
                // }
                $application->save();

                $application_emails[] = $application->external_user_email;
            } catch (\Exception $e) {
                // Exception handling
                \Log::error('An error occurred while creating external user in the system: ' . $e->getMessage());
            }
           
        }       

        // Send Email
        $subject = 'Assessment Email';
        $message = 'This is the assessment email';
        $mailableClass = 'SendAssessmentEmail';

        $job_opening = JobOpening::find($job_opening_id);

        $data['job_title'] = $job_opening->job_title ?? '';
        $data['company_name'] = $job_opening->company->name ?? '';

        HelperFunctions::sendEmails($application_emails, $subject, $message, $mailableClass, $data);
    }
}
