<?php
namespace App\Repositories\Services;

use App\Models\Services;

class ServicesRepository implements ServicesInterface
{
    public function getServicesByUser($id) {
        return Services::where('id_user', $id)->orderBy('id', 'desc')->paginate(10);
    }

    public function getAllOrders()
    {
        return Services::orderBy('id', 'desc')->paginate(10);
    }
}
