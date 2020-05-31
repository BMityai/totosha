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

    /**
     * CabinetControllerService constructor.
     * @param MainEloquentRepositoryInterface $mainEloquentRepository
     */
    public function __construct(MainEloquentRepositoryInterface $mainEloquentRepository)
    {
        $this->dbRepository = $mainEloquentRepository;
    }

    /**
     * Get customer all orders
     *
     * @return object
     */
    public function getCustomerOrders(): object
    {
        return Auth::user()->orders;
    }

    /**
     * User personal data update
     *
     * @param array $data
     * @return bool
     */
    public function updateUserData(array $data): bool
    {
        $isNotChangeEmail = $this->checkIsNotChangeEmail($data['email']);
        $this->dbRepository->updateUserData($data, $isNotChangeEmail);
        return $isNotChangeEmail;
    }

    /**
     * Mail change check
     *
     * @param string $email
     * @return bool
     */
    private function checkIsNotChangeEmail(string $email):bool
    {
        return Auth::user()->email == $email;
    }

    /**
     * Change user password
     *
     * @param string $newPassword
     */
    public function changeUserPassword(string $newPassword): void
    {
        $this->dbRepository->changePassword($newPassword);
    }

}
