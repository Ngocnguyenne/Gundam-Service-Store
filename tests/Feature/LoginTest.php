<?php

namespace Tests\Feature\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Lớp kiểm thử chức năng Đăng nhập (Login API)
 * Test các kịch bản: Đăng nhập thành công, sai mật khẩu, email không tồn tại và lỗi validation.
 */
class LoginTest extends TestCase
{
    // Sử dụng trait này để reset database sau mỗi lần chạy test
    use RefreshDatabase;

    protected $user;

    /**
     * Thiết lập môi trường: Tạo Role và User cần thiết cho các test case.
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // 1. Tạo Role cần thiết (Giả định Role ID 1 là User)
        // Đây là bước quan trọng vì mô hình User liên kết với Role
        Role::create(['id' => 1, 'name' => 'User']);

        // 2. Tạo một User để đăng nhập với thông tin đã biết: user@gmail.com / 1234
        $userModel = User::factory()->make([
            'fullname' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('1234'), // Hash mật khẩu
            'id_role' => 1, // Gán Role ID 1
        ]);
        
        // Loại bỏ cột email_verified_at vì nó không có trong bảng 'user' của bạn
        unset($userModel->email_verified_at);
        
        $userModel->save();
        $this->user = $userModel;
    }

    /**
     * Test case TC-001: Đăng nhập thành công với thông tin hợp lệ (user@gmail.com / 1234).
     *
     * @return void
     */
    public function test_user_can_login_with_correct_credentials(): void
    {
        // 1. Dữ liệu đăng nhập
        $loginData = [
            'email' => 'user@gmail.com',
            'password' => '1234',
        ];

        // 2. Thực thi (Act): Gửi request POST đến endpoint /api/login
        $response = $this->postJson('/api/login', $loginData);

        // 3. Kiểm chứng (Assert)
        $response->assertStatus(200); // Mã 200 OK cho đăng nhập thành công
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            // 'expires_in', // Tùy thuộc cấu hình JWT
        ]);

        // Xác nhận người dùng đã được xác thực trong Laravel
        $this->assertAuthenticatedAs($this->user, 'api');
    }

    /**
     * Test case TC-002: Đăng nhập thất bại với mật khẩu không hợp lệ.
     *
     * @return void
     */
    public function test_login_fails_with_invalid_password(): void
    {
        // 1. Dữ liệu đăng nhập (Sai mật khẩu)
        $loginData = [
            'email' => 'user@gmail.com',
            'password' => 'matkhaukhongdung',
        ];

        // 2. Thực thi (Act)
        $response = $this->postJson('/api/login', $loginData);

        // 3. Kiểm chứng (Assert)
        $response->assertStatus(401); // Mã 401 Unauthorized
        $response->assertJson([
            'message' => 'Tên đăng nhập hoặc mật khẩu không đúng.', // Giả định thông báo lỗi từ API
        ]);

        // Đảm bảo người dùng chưa được xác thực
        $this->assertGuest('api');
    }

    /**
     * Test case TC-003: Đăng nhập thất bại với email không tồn tại.
     *
     * @return void
     */
    public function test_login_fails_with_non_existent_email(): void
    {
        // 1. Dữ liệu đăng nhập (Email không có trong DB)
        $loginData = [
            'email' => 'khongtontai@gmail.com',
            'password' => '1234',
        ];

        // 2. Thực thi (Act)
        $response = $this->postJson('/api/login', $loginData);

        // 3. Kiểm chứng (Assert)
        $response->assertStatus(401); // Mã 401 Unauthorized
        $response->assertJson([
            'message' => 'Tên đăng nhập hoặc mật khẩu không đúng.',
        ]);

        $this->assertGuest('api');
    }

    /**
     * Test case TC-004: Đăng nhập thất bại do lỗi Validation (thiếu email hoặc password).
     *
     * @return void
     */
    public function test_login_fails_with_missing_fields(): void
    {
        // 1. Dữ liệu đăng nhập (Thiếu email)
        $loginData = [
            'password' => '1234',
        ];

        // 2. Thực thi (Act)
        $response = $this->postJson('/api/login', $loginData);

        // 3. Kiểm chứng (Assert)
        $response->assertStatus(422); // Mã 422 Unprocessable Content
        $response->assertJsonValidationErrors(['email']);
        
        // Đảm bảo người dùng chưa được xác thực
        $this->assertGuest('api');
    }
}
