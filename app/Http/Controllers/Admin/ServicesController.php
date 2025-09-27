<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Repositories\Notifications\NotificationInterface;
use App\Repositories\Services\ServicesInterface;

class ServicesController extends Controller
{

    private $ServicesRepository, $notificationRepository;

    public function __construct(ServicesInterface $ServicesRepository, NotificationInterface $notificationRepository)
    {
        $this->ServicesRepository = $ServicesRepository;
        $this->notificationRepository = $notificationRepository;
    }
    public function index()
    {
        $orders = $this->ServicesRepository->getAllOrders();

        return view('admin.services.index', ['orders' => $orders]);
    }

    public function edit($id)
    {
        $order = Services::find($id);

        return view('admin.services.edit', compact('order'));
    }
}