<?php
namespace App\Repositories\Services;

interface ServicesInterface
{
    public function getServicesByUser($id);
    public function getAllOrders();
}