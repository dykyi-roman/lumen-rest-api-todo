<?php

/**
 * @coversDefaultClass \App\Http\Controllers\TodoController
 */
class TodoControllerTest extends TestCase
{
    private const HEADERS = ['Content-Type' => 'application/x-www-form-urlencoded'];

    /**
     * @covers ::store
     */
    public function testStoreSuccess(): void
    {
        $email = 'test' . random_int(1, 10000) . '@gmail.com';
        $password = 'pass' . random_int(1, 10000);

        $this->post('/api/register', $this->generateUserContent($email, $password), self::HEADERS);
        $context = (array)$this->response->getOriginalContent();

        $this->assertArrayHasKey('status', $context);
        $this->assertArrayHasKey('token', $context);

        $value = &$this->getSharedVar();
        $value['email'] = $email;
        $value['password'] = $password;
    }

    /**
     * @covers ::login
     */
    public function testLoginSuccess(): void
    {
        $value = &$this->getSharedVar();
        $this->get(sprintf('/api/login?email=%s&password=%s', $value['email'], $value['password']));
        $context = (array)$this->response->getOriginalContent();

        $value = &$this->getSharedVar();
        $arr = explode(' ', $context['token']);
        $value['token'] = $arr[1];

        $this->assertArrayHasKey('status', $context);
        $this->assertEquals($context['status'], 'success');
    }

    public function testTodoListWithEmptyDataSuccess(): void
    {
        $value = &$this->getSharedVar();
        $this->get(sprintf('/api/todo?api_token=%s', $value['token']));
        $context = (array)$this->response->getOriginalContent();

        $this->assertEquals([
            'status' => 'success',
            'data' => []
        ], $context);
    }

    /**
     * @covers ::store
     */
    public function testTodoStoreSuccess(): void
    {
        $value = &$this->getSharedVar();
        $this->post(sprintf('/api/todo/?api_token=%s', $value['token']), $this->generateTodoContent(), self::HEADERS);
        $context = (array)$this->response->getOriginalContent();

        $this->assertArrayHasKey('uuid', $context);

        $value = &$this->getSharedVar();
        $value['todo_uuid'] = $context['uuid'];
    }

    public function testTodoListWithDataSuccess(): void
    {
        $value = &$this->getSharedVar();
        $this->get(sprintf('/api/todo?api_token=%s', $value['token']));
        $context = (array)$this->response->getOriginalContent();

        $this->assertNotEmpty($context['data']);
    }

    /**
     * @covers ::show
     */
    public function testShowTodoSuccess(): void
    {
        $value = &$this->getSharedVar();
        $this->get(sprintf('/api/todo/%s/?api_token=%s', $value['todo_uuid'], $value['token']));
        $context = (array)$this->response->getOriginalContent();

        $this->assertArrayHasKey('status', $context);
        $this->assertArrayHasKey('data', $context);
        $this->assertNotEmpty($context['data']);
    }

    /**
     * @covers ::delete
     */
    public function testDeleteTodoSuccess(): void
    {
        $value = &$this->getSharedVar();
        $this->delete(sprintf('/api/todo/%s/?api_token=%s', $value['todo_uuid'], $value['token']));
        $context = (array)$this->response->getOriginalContent();
        $this->assertEquals(['status' => 'success'], $context);
    }

    protected function &getSharedVar()
    {
        static $value = null;
        return $value;
    }

    private function generateTodoContent(): array
    {
        return [
            'name' => Faker\Provider\Lorem::sentence(4),
            'description' => Faker\Provider\Base::randomLetter(),
            'datetime' => '2020-01-01',
            'status' => 'new',
            'category' => 'new',
        ];
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
