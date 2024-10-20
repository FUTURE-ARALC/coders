<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace HyperfTest\Cases\Team;

use App\Model\Team;
use Database\Factories\TeamFactory;
use Hyperf\Testing\Client;
use HyperfTest\HttpTestCase;

use function Hyperf\Collection\collect;
use function Hyperf\Support\make;

/**
 * @internal
 * @coversNothing
 */
class TeamTest extends HttpTestCase
{

    protected $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = make(Client::class);
    }

    public function testTeamIndexSuccess()
    {
        $data = [];
        
        for ($i = 0; $i < 10; $i++) {
            $data[] = TeamFactory::new()->create();
        }

        $response = $this->client->get('/team/',[
            'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

        $collection = collect($data);

        $data_tenant_1 = $collection->where('tenant_id',1)->count();

        $this->assertCount($data_tenant_1,$response['data']);
        $this->assertArrayHasKey('data',$response);
    
    }

    public function testTeamCreate()
    {
        $response = $this->client->post('/team/', [
                'name' => 'Timinho',
                'type' => 'team',
        ]);


        $this->assertArrayHasKey('data',$response);
        $this->assertEquals('Timinho', $response['data']['name']);
        $this->assertEquals('team', $response['data']['type']);
        $this->assertEquals('1', $response['data']['tenant_id']);

    }

}
