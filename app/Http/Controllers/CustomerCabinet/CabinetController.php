<?php

namespace App\Http\Controllers\CustomerCabinet;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateUserDataRequest;
use App\Reposotories\MainEloquentRepository\MainEloquentRepository;
use App\Services\CabinetControllerService;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    /**
     * @var CabinetControllerService
     */
    private $service;

    public function __construct()
    {
        $this->service = new CabinetControllerService(new MainEloquentRepository());
    }

    public function getOrders()
    {
        $orders = $this->service->getCustomerOrders();
        return view('CustomerCabinet.ordersHistory', ['orders' => $orders]);
    }

    public function getBonus()
    {
        $orders = $this->service->getCompletedOrders();
        return view('CustomerCabinet.bonusHistory', ['orders' => $orders]);
    }

    public function getFormForUpdateUserData()
    {
        return view('CustomerCabinet.userDataUpdate');
    }

    public function updateUserData(UpdateUserDataRequest $request)
    {
       if($this->service->updateUserData($request->all())){
           session()->flash('updateData', 'Изменение прошло успешно');
           return redirect()->back();
       };
        session()->flash('updateData', 'Необходимо верифицировать email адрес');
        return redirect()->route('verification.notice');
    }

     public function getFormForChangePassword()
     {
         return view('CustomerCabinet.changePassword');
     }

     public function changeUserPassword(ChangePasswordRequest $request)
     {
         $this->service->changeUserPassword($request->get('newPassword'));
         session()->flash('updateData', 'Пароль успешно изменен');
         return redirect()->back();
     }
}
