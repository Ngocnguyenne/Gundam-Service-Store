<?php

namespace Tests\Feature\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Lớp kiểm thử chức năng Đăng ký (Registration API)
 * Test các kịch bản: Đăng ký thành công, email đã tồn tại, mật khẩu yếu và lỗi validation.
 */
class RegistrationTest extends TestCase
{
    // Sử dụng trait này để reset database sau mỗi lần chạy test
    use RefreshDatabase;

    /**
     * Thiết lập môi trường: Tạo Role cần thiết.
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        // Giả định Role ID 1 là User
        Role::create(['id' => 1, 'name' => 'User']); 
    }

    /**
     * Test case TC-005: Đăng ký thành công với mật khẩu mạnh hợp lệ và email là @gmail.com.
     * Mật khẩu giả định cần: >= 8 ký tự, có hoa, thường, số, ký tự đặc biệt.
     *
     * @return void
     */
    public function test_user_can_register_with_strong_password_and_gmail_email(): void
    {
        // 1. Dữ liệu đăng ký hợp lệ
        $validData = [
            'fullname' => 'Nguyen Van A',
            'email' => 'newuser.test@gmail.com', // Đã sửa để khớp với yêu cầu @gmail.com
            'phone' => '0912345678',
            'password' => 'Pass@1234', // Mật khẩu mạnh
            'password_confirmation' => 'Pass@1234',
        ];

        // 2. Thực thi (Act): Gửi request POST đến endpoint /api/register
        $response = $this->postJson('/api/register', $validData);

        // 3. Kiểm chứng (Assert)
        $response->assertStatus(201); // Mã 201 Created hoặc 200 OK tùy API
        $response->assertJsonStructure([
            'message', // Thông báo đăng ký thành công
            'user' // Trả về thông tin user đã đăng ký
        ]);
        
        // Kiểm tra User đã được lưu vào database
        $this->assertDatabaseHas('user', [
            'email' => 'newuser.test@gmail.com',
            'id_role' => 1,
        ]);
    }

    /**
     * Test case TC-006: Đăng ký thất bại do mật khẩu yếu (giả định backend kiểm tra độ phức tạp).
     * Mật khẩu thiếu ký tự đặc biệt hoặc chữ in hoa.
     *
     * @return void
     */
    public function test_registration_fails_with_weak_password(): void
    {
        // 1. Dữ liệu đăng ký (Mật khẩu yếu: chỉ có chữ thường và số)
        $weakData = [
            'fullname' => 'Nguyen Van B',
            'email' => 'weakpass@gmail.com', // Đã sửa để dùng @gmail.com
            'phone' => '0912345679',
            'password' => 'password123', 
            'password_confirmation' => 'password123',
        ];

        // 2. Thực thi (Act)
        $response = $this->postJson('/api/register', $weakData);

        // 3. Kiểm chứng (Assert)
        $response->assertStatus(422); // Mã 422 Unprocessable Content
        $response->assertJsonValidationErrors(['password']); 
        
        // Giả định thông báo lỗi phức tạp về mật khẩu
        // $response->assertJsonFragment(['The password field must contain at least one uppercase and one symbol.']); 
    }
    
    /**
     * Test case TC-007: Đăng ký thất bại khi email đã tồn tại trong hệ thống (với định dạng @gmail.com).
     *
     * @return void
     */
    public function test_registration_fails_if_email_already_exists(): void
    {
        // 1. Tạo một user tồn tại trước
        $existingUser = User::factory()->make([
            'email' => 'existing@gmail.com', // Đã sửa để dùng @gmail.com
            'password' => Hash::make('123456'), 
            'id_role' => 1,
        ]);
        unset($existingUser->email_verified_at);
        $existingUser->save();
        
        // 2. Dữ liệu đăng ký trùng email
        $duplicateData = [
            'fullname' => 'Nguyen Van C',
            'email' => 'existing@gmail.com', // Trùng email @gmail.com
            'phone' => '0912345680',
            'password' => 'Valid@1234', 
            'password_confirmation' => 'Valid@1234',
        ];

        // 3. Thực thi (Act)
        $response = $this->postJson('/api/register', $duplicateData);

        // 4. Kiểm chứng (Assert)
        $response->assertStatus(422); 
        $response->assertJsonValidationErrors(['email']);
        $response->assertJsonFragment(['The email has already been taken.']);
    }

    /**
     * Test case TC-008: Đăng ký thất bại khi mật khẩu và xác nhận mật khẩu không khớp.
     *
     * @return void
     */
    public function test_registration_fails_if_passwords_do_not_match(): void
    {
        // 1. Dữ liệu đăng ký (Password và Confirmation không khớp)
        $mismatchData = [
            'fullname' => 'Nguyen Van D',
            'email' => 'mismatch@gmail.com', // Đã sửa để dùng @gmail.com
            'phone' => '0912345681',
            'password' => 'Pass@1234', 
            'password_confirmation' => 'Pass@4321', // Khác nhau
        ];

        // 2. Thực thi (Act)
        $response = $this->postJson('/api/register', $mismatchData);

        // 3. Kiểm chứng (Assert)
        $response->assertStatus(422); 
        $response->assertJsonValidationErrors(['password']); // Lỗi validation cho trường password
    }

    /**
     * Test case TC-009: Đăng ký thất bại khi email KHÔNG phải là @gmail.com.
     *
     * @return void
     */
    public function test_registration_fails_if_email_is_not_gmail_domain(): void
    {
        // 1. Dữ liệu đăng ký (Sử dụng domain khác: @hotmail.com)
        $invalidDomainData = [
            'fullname' => 'Nguyen Van E',
            'email' => 'invalid@hotmail.com', 
            'phone' => '0912345682',
            'password' => 'Pass@1234', 
            'password_confirmation' => 'Pass@1234',
        ];

        // 2. Thực thi (Act)
        $response = $this->postJson('/api/register', $invalidDomainData);

        // 3. Kiểm chứng (Assert)
        $response->assertStatus(422); 
        $response->assertJsonValidationErrors(['email']);
        // Giả định rằng validation rule cụ thể (ví dụ: regex) đã được áp dụng ở backend
        // $response->assertJsonFragment(['The email must be a valid @gmail.com address.']); 
    }
}