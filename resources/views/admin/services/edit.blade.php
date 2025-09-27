@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Thông tin đặt lịch</strong></h1>

    <div class="err">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <hr>
    <div class="mb-3">
        <div style="font-size: 16px;"><strong>Khách hàng:</strong> {{ $order->customer }}</div>
        <div style="font-size: 16px;"><strong>Email:</strong> {{ $order->email }}</div>
        <div style="font-size: 16px;"><strong>Số điện thoại:</strong> {{ $order->pickup_phone }}</div>
    </div>
    <hr>
    <div class="mb-3">
        <label for="id_service_order" class="form-label">Mã đặt lịch</label>
        <input type="text" class="form-control" id="id_service_order" name="id_service_order" value="{{ $order->id }}"
            disabled>
    </div>

    <div class="mb-3">
        <label for="order_date" class="form-label">Ngày đặt</label>
        <input type="text" class="form-control" id="order_date" name="order_date" value="{{ $order->order_date }}"
            disabled>
    </div>

    <div class="mb-3">
        @php
            $statusOptions = [
                0 => 'Đã đặt lịch',
                1 => 'Đang dùng dịch vụ',
                2 => 'Đã hoàn thành',
                3 => 'Huỷ hẹn',
            ];
        @endphp

        <label for="status" class="form-label">Trạng thái</label>
        <select class="form-select" id="status" name="status" required>
            @foreach ($statusOptions as $value => $label)
                <option value="{{ $value }}" {{ $order->status == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <div class="d-md-flex justify-content-between gap-2">
            <div class="col-12 col-md-3">
                <img src="{{ asset($order->product->image_path) }}" class="my-2 rounded"
                    style="visibility: visible; width: 100%; height: auto;">
            </div>
            <div class="col-12 col-md-9">
                <h4 class="fw-bold">{{ $order->product->name }}</h4>
                <div>
                    <p class="m-0">Giá gốc:
                        <span class="text-decoration-line-through me-1">
                            {{ number_format($order->product->price, 0, ',', '.') }}₫
                        </span>
                        (-{{ $order->product->discount }}%)
                    </p>
                    <p class="m-0">Giá khuyến mãi:
                        {{ number_format($order->product->promotional_price, 0, ',', '.') }}₫
                    </p>
                </div>
                <div class="my-4">{{ $order->product->description }}</div>
            </div>
        </div>

        <div class="mb-3">
            <h4 class="text-end text-danger fs-2">Tổng tiền: {{ number_format($order->total_funds, 0, ',', '.') }}đ
            </h4>
        </div>

        <a role="button" class="btn btn-success update-order" data-id="{{ $order->id }}">
            Update
        </a>
        &nbsp;<a class="btn btn-secondary" href="{{ URL::to('/admin/servicer-oders') }}">Hủy</a>
    @endsection

    @section('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.update-order').forEach(button => {
                    button.addEventListener('click', function() {
                        const orderId = this.dataset.id;
                        const selectedStatus = document.querySelector('#status').value;

                        fetch(`/services/change-status/${orderId}?status=${selectedStatus}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                body: JSON.stringify({})
                            })
                            .then(res => res.json())
                            .then(order => {
                                showToast('success', 'Thành công',
                                    'Thay đổi trạng thái thành công.', {
                                        position: 'topRight'
                                    });
                                setTimeout(() => location.reload(), 1000);
                            })
                            .catch(error => {
                                console.error(error);
                                showToast('error', 'Lỗi', 'Có lỗi xảy ra khi gửi yêu cầu.', {
                                    position: 'topRight'
                                });
                            });
                    });
                });
            });
        </script>
    @endsection
