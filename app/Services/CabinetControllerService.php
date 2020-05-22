<?php


namespace App\Services;


use App\Reposotories\MainEloquentRepository\MainEloquentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CabinetControllerService
{
    /**
     * @var MainEloquentRepositoryInterface
     */
    private $dbRepository;

    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
    }

    public function getCustomerOrders()
    {
        return Auth::user()->orders;
    }

    public function updateUserData(array $data): bool
    {
        $isNotChangeEmail = $this->checkIsNotChangeEmail($data['email']);
        $this->dbRepository->updateUserData($data, $isNotChangeEmail);
        return $isNotChangeEmail;
    }

    private function checkIsNotChangeEmail(string $email):bool
    {
        return Auth::user()->email == $email;
    }

    public function changeUserPassword($newPassword)
    {
        $this->dbRepository->changePassword($newPassword);
    }

}
