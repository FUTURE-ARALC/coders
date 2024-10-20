<?php
namespace Database\Factories;

use App\Model\Team;
use Carbon\Carbon;
use Hyperf\Database\Model\Factory;
use Ramsey\Uuid\Uuid;
use Faker\Generator as FakerGenerator;


class TeamFactory extends Factory
{
    // Especifica o modelo correspondente
    protected $model = Team::class;

    public function __construct(protected FakerGenerator $faker)
    {
        parent::__construct($faker); // Chama o construtor da classe pai
    }


    /**
     * Define o estado padrão do modelo.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'tenant_id' => random_int(1, 2),
            'uuid' => Uuid::uuid4()->toString(),
            'type' => 'team',
            'active' => rand(0, 1),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    


    public static function new(): self
    {
        return new self(\Faker\Factory::create());
    }
    
    public function create(string $class = null, array $attributes = [])
    {
        $class = $class ?: $this->model;
        $attributes = array_merge($this->definition(), $attributes);
        return $class::query()->create($attributes);
    }


}
