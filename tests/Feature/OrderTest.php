<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_book_a_schedule_successfully()
    {
        // 1. Tạo user & login
        $user = User::factory()->create();
        $this->actingAs($user);

        // 2. Tạo sản phẩm
        $product = Product::factory()->create([
            'price' => 100000,
        ]);

        // 3. Gửi request đặt lịch
        $response = $this->post('/checkout', [
            'id_product' => $product->id,
            'quantity' => 2,
            'phone' => '0912345678',
            'schedule_time' => now()->addDay()->format('Y-m-d H:i:s'),
        ]);

        // 4. Kiểm tra response
        $response->assertStatus(302); // redirect sau khi đặt lịch
        $response->assertSessionHasNoErrors();

        // 5. Kiểm tra dữ liệu trong DB
        $this->assertDatabaseHas('orders', [
            'id_user' => $user->id,
            'phone' => '0912345678',
        ]);

        $order = Order::first();

        $this->assertDatabaseHas('order_detail', [
            'id_order' => $order->id,
            'id_product' => $product->id,
            'quantity' => 2,
        ]);
    }

    /** @test */
    public function booking_fails_with_missing_phone_number()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post('/checkout', [
            'id_product' => $product->id,
            'quantity' => 1,
            // thiếu phone
            'schedule_time' => now()->addDay()->format('Y-m-d H:i:s'),
        ]);

        $response->assertSessionHasErrors(['phone']);
    }

    /** @test */
    public function booking_fails_with_invalid_schedule_time()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post('/checkout', [
            'id_product' => $product->id,
            'quantity' => 1,
            'phone' => '0912345678',
            'schedule_time' => now()->subDay()->format('Y-m-d H:i:s'), // quá khứ
        ]);

        $response->assertSessionHasErrors(['schedule_time']);
    }
}
