<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Customer;
use App\Models\User;
use App\Providers\AuthServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    protected function signInUserWithPermission($permission, $role)
    {
        $user = User::factory()->create(['role' => $role]);
        Auth::login($user);

        // Mock the userCan method to return the provided permission
        $this->mock(AuthServiceProvider::class, function ($mock) use ($permission) {
            $mock->shouldReceive('userCan')->andReturn($permission);
        });

        return $user;
    }

    /** @test */
    public function admin_can_create_customer()
    {
        // Simulate việc đăng nhập với tài khoản admin có quyền 'crud-customer'
        $this->signInUserWithPermission('crud-customer', 'admin');

        // Định nghĩa dữ liệu của khách hàng để tạo một khách hàng mới
        $customerData = [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'dob' => '1990-01-01',
        ];

        // Mock mô hình Customer
        $customersMock = Mockery::mock(Customer::class);
        $this->app->instance(Customer::class, $customersMock);

        // Gửi một yêu cầu POST đến đường dẫn customers.store với dữ liệu của khách hàng
        $response = $this->post(route('customers.store'), $customerData);

        // Xác nhận rằng phản hồi sẽ chuyển hướng đến đường dẫn customers.index
        $response->assertRedirect(route('customers.index'));
    }

    /** @test */
    public function admin_can_view_customers_list()
    {
        // Simulate việc đăng nhập với tài khoản admin có quyền 'crud-customer'
        $this->signInUserWithPermission('crud-customer', 'admin');

        // Mock mô hình Customer và thiết lập dữ liệu giả lập cho phương thức get
        $customersMock = Mockery::mock(Customer::class);
        $customersMock->shouldReceive('get')
            ->andReturn(collect([
                new Customer([
                    'name' => 'Customer 1',
                    'dob' => '1992-02-03',
                    'email' => 'foo@bar.com',
                    'city_id' => 1
                ]),
                new Customer([
                    'name' => 'Customer 2',
                    'dob' => '1992-02-03',
                    'email' => 'customer2@bar.com',
                    'city_id' => 2
                ]),
                // Thêm dữ liệu giả lập cho các khách hàng khác (nếu cần)
            ]));

        // Mock mô hình City và thiết lập dữ liệu giả lập cho phương thức all
        $cityMock = Mockery::mock(City::class);
        $cityMock->shouldReceive('all')
            ->andReturn(collect([
                new City(['id'=> 1, 'name' => 'City 1']),
                new City(['id'=> 2, 'name' => 'City 2']),
                // Thêm dữ liệu giả lập cho các thành phố khác (nếu cần)
            ]));

        // Gắn đối tượng mock vào container ứng dụng
        $this->app->instance(Customer::class, $customersMock);
        $this->app->instance(City::class, $cityMock);

        // Gửi yêu cầu GET đến đường dẫn customers.index
        $response = $this->get(route('customers.index'));

        // Xác nhận rằng view được hiển thị là "customers.list"
        $response->assertViewIs("customers.list");
    }

    /** @test */
    public function admin_can_delete_customer()
    {
        // Simulate việc đăng nhập với tài khoản admin có quyền 'crud-customer'
        $this->signInUserWithPermission('crud-customer', 'admin');

        // Tạo một khách hàng ảo để xóa
        $customerToDelete = new Customer([
            'id' => 1,
            'name' => 'John Doe',
            'dob' => '1985-05-10',
            'email' => 'john@example.com',
        ]);
        $customerToDelete->save();

        // Mock mô hình Customer và thiết lập dữ liệu giả lập cho phương thức findOrFail
        $customersMock = Mockery::mock(Customer::class);
        $customersMock->shouldReceive('findOrFail')
            ->with($customerToDelete->id)
            ->andReturn($customerToDelete);

        // Gắn đối tượng mock vào container ứng dụng
        $this->app->instance(Customer::class, $customersMock);

        // Gửi yêu cầu DELETE đến đường dẫn customers.delete với id của khách hàng để xóa
        $response = $this->get(route('customers.delete', ['id' => $customerToDelete->id]));

        // Xác nhận rằng sau khi xóa khách hàng, sẽ chuyển hướng đến đường dẫn customers.index
        $response->assertRedirect(route('customers.index'));

        // Kiểm tra rằng khách hàng đã bị xóa trong cơ sở dữ liệu
        $this->assertDatabaseMissing('customers', ['id' => $customerToDelete->id]);
    }

    /** @test */
    public function admin_cannot_delete_nonexistent_customer()
    {
        $this->signInUserWithPermission('crud-customer', 'admin');

        // Giả lập một yêu cầu DELETE với id của khách hàng không tồn tại
        $nonexistentCustomerId = 20; // Giả sử id 999 không tồn tại
        $response = $this->get(route('customers.delete', ['id' => $nonexistentCustomerId]));

        // Xác nhận rằng phản hồi trả về có mã lỗi 404 (Not Found)
        $response->assertStatus(ResponseAlias::HTTP_NOT_FOUND);
    }
}
