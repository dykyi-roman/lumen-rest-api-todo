<?php

/**
 * @coversDefaultClass \App\Http\Controllers\UsersController
 */
class UsersControllerTest extends TestCase
{
    private const HEADERS = ['Content-Type' => 'application/x-www-form-urlencoded'];

    /**
     * @covers ::login
     */
    public function testLoginWithoutParamsFailed(): void
    {
        $this->get('/api/user/login');

        $context = (array)$this->response->getOriginalContent();
        $this->assertEquals($context['status'],'error');
    }

    /**
     * @covers ::login
     */
    public function testLoginWithFakeEmailLoginParamFailed(): void
    {
        $this->get('/api/user/login?email=eeeee');
        $context = (array)$this->response->getOriginalContent();
        $this->assertEquals($context['status'],'error');
    }

    /**
     * @covers ::login
     */
    public function testLoginWithFakeCredentialLoginParamFailed(): void
    {
        $this->get('/api/user/login?email=test@gmail.com&password=dddd');
        $context = (array)$this->response->getOriginalContent();
        $this->assertEquals(['status' => 'error', 'message' => 'User not found'], $context);
    }

    /**
     * @covers ::store
     */
    public function testStoreSuccess(): void
    {
        $email = 'test' . random_int(1, 10000) . '@gmail.com';
        $password = 'pass' . random_int(1, 10000);

        $value = &$this->getSharedVar();
        $value['email'] = $email;
        $value['password'] = $password;

        $this->post('/api/user/register', $this->generateUserContent($email, $password), self::HEADERS);
        $context = (array)$this->response->getOriginalContent();

        $this->assertArrayHasKey('status', $context);
        $this->assertArrayHasKey('token', $context);
    }

    /**
     * @covers ::login
     */
    public function testLoginWithoutPasswordFailed(): void
    {
        $this->get('/api/user/login?email=' . 'test@gmail');
        $context = (array)$this->response->getOriginalContent();
        $this->assertEquals($context['status'],'error');
    }

    /**
     * @covers ::login
     */
    public function testLoginWithFakeCredentialsFailed(): void
    {
        $this->get(sprintf('/api/user/login?email=%s&password=%s', 'test@gmail', 'sssss'));
        $context = (array)$this->response->getOriginalContent();
        $this->assertEquals(['status' => 'error', 'message' => 'User not found'], $context);
    }

    /**
     * @covers ::login
     */
    public function testLoginSuccess(): void
    {
        $value = &$this->getSharedVar();
        $this->get(sprintf('/api/user/login?email=%s&password=%s', $value['email'], $value['password']));
        $context = (array)$this->response->getOriginalContent();

        $this->assertArrayHasKey('status', $context);
        $this->assertEquals($context['status'], 'success');
    }

    /**
     * @covers ::logout
     */
    public function testLogoutSuccess(): void
    {
        $value = &$this->getSharedVar();
        $this->get(sprintf('/api/user/logout?email=%s', $value['email']));
        $context = (array)$this->response->getOriginalContent();

        $this->assertArrayHasKey('status', $context);
        $this->assertEquals($context['status'], 'success');
    }

    protected function &getSharedVar()
    {
        static $value = null;
        return $value;
    }

    private function generateUserContent(string $email, string $password): array
    {
        return [
            'first_name' => Faker\Provider\Person::firstNameFemale(),
            'last_name' => Faker\Provider\Person::titleFemale(),
            'email' => $email,
            'mobile_number' => Faker\Provider\PhoneNumber::asciify(),
            'gender' => 'man',
            'birthday' => '2020-01-01',
            'password' => $password
        ];
    }
}
