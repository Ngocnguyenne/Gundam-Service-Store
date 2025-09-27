<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use App\Models\Product; // Giả định bạn có Product Model
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Lớp kiểm thử luồng từ Tìm kiếm đến Thêm vào Giỏ hàng
 */
class ProductToCartTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $product;

    /**
     * Thiết lập môi trường: Tạo User và Sản phẩm cần thiết.
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // 1. Tạo Role và User để xác thực
        Role::create(['id' => 1, 'name' => 'User']); 
        $userModel = User::factory()->make([
            'email' => 'login@gmail.com',
            'password' => Hash::make('1234'),
            'id_role' => 1,
        ]);
        unset($userModel->email_verified_at);
        $userModel->save();
        $this->user = $userModel;

        // 2. Tạo một Sản phẩm để tìm kiếm và thêm vào giỏ hàng
        $this->product = Product::create([
            'name' => 'MGEX Strike Freedom Gundam',
            'sku' => 'MGEX001',
            'price' => 1000000,
            'stock' => 5,
        ]);
    }

    /**
     * Helper để lấy JWT token cho người dùng
     * (Giả định bạn sử dụng endpoint /api/login để lấy token)
     */
    protected function getAuthToken()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'login@gmail.com',
            'password' => '1234',
        ]);
        return $response->json('access_token');
    }

    /**
     * Test case TC-001: Luồng Tìm kiếm -> Xem chi tiết -> Thêm vào Giỏ hàng thành công.
     *
     * @return void
     */
    public function test_search_and_add_to_cart_flow_is_successful(): void
    {
        $token = $this->getAuthToken();
        $headers = ['Authorization' => 'Bearer ' . $token];
        $productSku = $this->product->sku;
        
        // --- BƯỚC 1: TÌM KIẾM SẢN PHẨM ---
        $searchResponse = $this->withHeaders($headers)
                               ->getJson('/api/products/search?q=Strike Freedom');

        // Kiểm tra tìm kiếm thành công
        $searchResponse->assertStatus(200);
        $searchResponse->assertJsonFragment(['sku' => $productSku]);
        
        // --- BƯỚC 2: THÊM VÀO GIỎ HÀNG ---
        $addToCartData = [
            'product_sku' => $productSku,
            'quantity' => 1,
        ];

        $cartResponse = $this->withHeaders($headers)
                             ->postJson('/api/cart/add', $addToCartData);

        // Kiểm tra thêm vào giỏ hàng thành công
        $cartResponse->assertStatus(200); 
        $cartResponse->assertJson([
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng.', // Giả định thông báo
        ]);

        // Kiểm tra giỏ hàng trong database (Nếu giỏ hàng được lưu trong DB)
        // $this->assertDatabaseHas('carts', ['user_id' => $this->user->id, 'product_sku' => $productSku, 'quantity' => 1]);
    }

    /**
     * Test case TC-002: Thêm vào giỏ hàng thất bại khi người dùng chưa đăng nhập.
     *
     * @return void
     */
    public function test_add_to_cart_fails_if_unauthenticated(): void
    {
        $addToCartData = [
            'product_sku' => $this->product->sku,
            'quantity' => 1,
        ];

        // Gửi request mà không có token
        $response = $this->postJson('/api/cart/add', $addToCartData);

        // Kiểm tra mã lỗi 401 (Unauthorized)
        $response->assertStatus(401); 
    }
}
