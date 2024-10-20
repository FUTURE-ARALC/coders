<?php

namespace HyperfTest\Cases;

use Hyperf\Database\Schema\Schema;
use Hyperf\DbConnection\Db;
use HyperfTest\HttpTestCase;

/**
 * Class AbstractTest.
 * @method get($uri, $data = [], $headers = [])
 * @method post($uri, $data = [], $headers = [])
 * @method postWithStatusCode($uri, $data = [], $headers = [])
 * @method json($uri, $data = [], $headers = [])
 * @method file($uri, $data = [], $headers = [])
 * @method request($method, $path, $options = [])
 */
abstract class AbstractTest extends HttpTestCase
{
    
    public function __construct(){}

    public function setUp(): void
    {
        // Schema::disableForeignKeyConstraints();
        $table = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        foreach ($table as $name) {
            if ($name == 'migrations') {
                continue;
            }
            Db::table($name)->truncate();
        }
        // Schema::enableForeignKeyConstraints();

        
        
    }

    
    
    

    
    
}
