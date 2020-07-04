<?php


namespace App\Helpers;

use App\Mail\SendMail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;
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
        $this->sendEmail($event, $data, $adminEmails);
    }

    public function sendEmailToCustomer(string $event, object $data)
    {
        $emails = $data->email;
        $this->sendEmail($event, $data, [$emails]);
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

    public function sendEmail(string $event, object $data, array $emailAddresses)
    {
        foreach ($emailAddresses as $email) {
            Mail::to($email)->send(new SendMail($event, $data));
        }
    }
}
