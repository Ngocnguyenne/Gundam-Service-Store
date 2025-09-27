@extends('admin.layouts.admin_layout')
@section('admin_content')
    <h1 class="h3 mb-3"><strong>Danh sách đơn hàng</strong></h1>

    <div class="">
        @if (session()->has('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="card flex-fill">
        <div class="table-responsive mb-2">
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th class="text-center">Dịch vụ</th>
                        <th class="text-center">Người đặt</th>
                        <th class="text-center">Số điện thoại</th>
                        <th class="text-center">Ngày đặt lịch</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Tổng tiền</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->product->name }}</td>
                            <td class="text-center"> {{ $order->customer }} </td>
                            <td class="text-center d-xl-table-cell">{{ $order->pickup_phone }}</td>
                            <td class="text-center d-xl-table-cell">
                                {{ $order->booking_time }}
                            </td>
                            <td>
                                @php
                                    $statuses = [
                                        0 => ['text' => 'Đã đặt lịch', 'class' => 'bg-primary'],
                                        1 => ['text' => 'Đang dùng dịch vụ', 'class' => 'bg-warning'],
                                        2 => ['text' => 'Đã hoàn thành', 'class' => 'bg-success'],
                                        3 => ['text' => 'Huỷ hẹn', 'class' => 'bg-danger'],
                                    ];

                                    $status = $statuses[$order->status] ?? ['text' => '---', 'class' => 'bg-danger'];
                                @endphp

                                <span class="badge {{ $status['class'] }} text-white">{{ $status['text'] }}</span>
                            </td>
                            <td class="text-center d-xl-table-cell">{{ number_format($order->total_funds, 0, ',', '.') }}đ
                            </td>
                            <td class="d-md-table-cell">
                                <div class="gap-1 d-flex align-center justify-content-center">
                                    <a href="{{ route('service.order.edit', ['id' => $order->id]) }}"
                                        class="btn btn-warning mb-2">Edit</a>
                                    @if ($order->status != 3)
                                        <a role="button" class="btn btn-danger cancel-order"
                                            data-id="{{ $order->id }}">
                                            Huỷ lịch
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <ul class="pagination">
        <li class="page-item @if ($orders->currentPage() === 1) disabled @endif">
            <a class="page-link" href="{{ $orders->previousPageUrl() }}">Trước</a>
        </li>
        @for ($i = 1; $i <= $orders->lastPage(); $i++)
            <li class="page-item @if ($orders->currentPage() === $i) active @endif">
                <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="page-item @if ($orders->currentPage() === $orders->lastPage()) disabled @endif">
            <a class="page-link" href="{{ $orders->nextPageUrl() }}">Sau</a>
        </li>
    </ul>
@endsection
