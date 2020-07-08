<?php


namespace App\Helpers;

use App\Mail\SendMailToAdmin;
use App\Mail\SendMailToCustomer;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailHelper
{
    use DispatchesJobs;
    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;

    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
    }

    public function sendEmailToAdmins(string $event, object $data)
    {
        $adminEmails = $this->getAdminEmails();
        foreach ($adminEmails as $email) {
            Mail::to($email)->send(new SendMailToAdmin($event, $data));
        };
    }

    public function sendEmailToCustomer(string $event, object $data)
    {
        try {
            Mail::to($data->email)->send(new SendMailToCustomer($event, $data));
        } catch (\Exception $e) {
            Log::channel('sendmail')->critical($e);
        }
    }

    private function getAdminEmails():array
    {
        $admins = $this->dbRepository->getAdmins();
        $emails = [];
        foreach ($admins as $admin) {
            array_push($emails, $admin->email);
        }
        return $emails;
    }
}
