<?php
declare(strict_types=1);

namespace Tests\Feature\Api;

use Acme\Point\Application\Eloquents\EloquentCustomer;
use Acme\Point\Application\Eloquents\EloquentCustomerPoint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddPointTest extends TestCase
{
    use RefreshDatabase;

    const CUSTOMER_ID = 1;

    protected function setUp()
    {
        parent::setUp();

        // (2) テストに必要なレコードを登録
        factory(EloquentCustomer::class)->create([
            'id' => self::CUSTOMER_ID,
        ]);
        factory(EloquentCustomerPoint::class)->create([
            'customer_id' => self::CUSTOMER_ID,
            'point'       => 100,
        ]);
    }

    /**
     * @test
     */
    public function put_add_point()
    {
        $response = $this->putJson('/api/customers/add_point', [
            'customer_id' => self::CUSTOMER_ID,
            'add_point'   => 10,
        ]);

        $response->assertStatus(200);
        $expected = ['customer_point' => 110];
        $response->assertExactJson($expected);

        $this->assertDatabaseHas('customer_points', [
            'customer_id' => self::CUSTOMER_ID,
            'point'       => 110,
        ]);
    }

    /**
     * @test
     */
    public function put_add_point_バリデーションエラー_customer_id()
    {
        $response = $this->putJson('/api/customers/add_point', [
            'customer_id' => 'a',
            'add_point'   => 10,
        ]);

        $response->assertStatus(422);
        $expected = [
            'message' => 'The given data was invalid.',
            'errors'  => [
                'customer_id' => [
                    'The customer id must be an integer.',
                ],
            ],
        ];
        $response->assertExactJson($expected);
    }

    /**
     * @test
     */
    public function put_add_point_customer_id事前条件エラー()
    {
        $response = $this->putJson('/api/customers/add_point', [
            'customer_id' => 999,
            'add_point'   => 10,
        ]);

        $response->assertStatus(400);
        $expected = [
            'message' => 'customer_id:999 does not exists',
        ];
        $response->assertExactJson($expected);
    }

    /**
     * @test
     * @dataProvider dataProvider_put_add_point_add_point事前条件エラー
     */
    public function put_add_point_add_point事前条件エラー(int $addPoint)
    {
        $response = $this->putJson('/api/customers/add_point', [
            'customer_id' => self::CUSTOMER_ID,
            'add_point'   => $addPoint,
        ]);

        $response->assertStatus(400);
        $expected = [
            'message' => 'add_point should be equals or greater than 1',
        ];
        $response->assertExactJson($expected);
    }

    public function dataProvider_put_add_point_add_point事前条件エラー()
    {
        return [
            [0],
            [-1],
        ];
    }
}
