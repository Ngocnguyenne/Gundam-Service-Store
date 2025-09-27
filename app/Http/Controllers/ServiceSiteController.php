<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Services;
use App\Repositories\Notifications\NotificationInterface;
use App\Repositories\Services\ServicesInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceSiteController extends Controller
{
    private $ServicesRepository, $notificationRepository;

    public function __construct(ServicesInterface $ServicesRepository, NotificationInterface $notificationRepository)
    {
        $this->ServicesRepository = $ServicesRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function index()
    {
        $services = $this->ServicesRepository->getServicesByUser(Auth::id());

        return view('pages.services_order', compact('services'));
    }

    public function checkoutPage($productId)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $product = Product::findOrFail($productId);

        if (!in_array($product->id_category, [1, 4])) {
            return redirect()->route('detail', $product->id);
        }

        return view('pages.services_order_checkout', compact('product'));
    }

    public function createServiesOrder(Request $request, $id) {
        // dd($request);
        $validatedDataOrder = $request->validate([
            'customer' => 'required',
            'total_funds' => 'required',
            'pickup_phone' => 'required',
            'booking_time' => 'required'
        ]);

        $validatedDataOrder['customer'] = $request->customer;
        $validatedDataOrder['order_date'] = Carbon::now();
        $validatedDataOrder['total_funds'] = $request->total_funds;
        $validatedDataOrder['status'] = 0;
        $validatedDataOrder['pickup_phone'] = $request->pickup_phone;
        $validatedDataOrder['email'] = $request->email;
        $validatedDataOrder['booking_time'] = $request->booking_time;
        $validatedDataOrder['id_user'] = Auth::id();
        $validatedDataOrder['product_id'] = $id;

        $newServicesOrder = Services::create($validatedDataOrder);

        $notificationData = [
            'content' => $request->customer . ' vừa đặt lịch dịch vụ!',
            'link' => route('service.order.edit', ['id' => $newServicesOrder->id]),
            'image_path' => 'https://img.upanh.tv/2024/06/30/OIP.jpg',
        ];

        $this->notificationRepository->createAndPushNotificationForAdmin($notificationData);

        return view('pages.orderSuccess', ['type' => 1]);
    }

    public function updateServiesOrder(Request $request, $id)
    {
        $validatedDataOrder = $request->validate([
            'customer' => 'required|string|max:255',
            'pickup_phone' => 'required|string|max:20',
            'booking_time' => 'required|date',
        ]);

        $order = Services::find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng.');
        }

        try {
            $order->customer = $validatedDataOrder['customer'];
            $order->pickup_phone = $validatedDataOrder['pickup_phone'];
            $order->booking_time = \Carbon\Carbon::parse($validatedDataOrder['booking_time']);

            $order->save();

            return back()->with('message', ['content' => 'Cập nhật thông tin thành công!', 'type' => 'success']);
        } catch (\Exception $e) {
             return back()->with('message', ['content' => 'Cập nhật thông tin không thành công!', 'type' => 'error']);
        }
    }

    public function changeStatusServiceOrder(Request $request, $id)
    {
        $order = Services::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return $order;
    }
}