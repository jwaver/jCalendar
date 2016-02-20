<?php namespace jwaver\Calendar\Updates;

use Seeder;
use Storage;
use jwaver\Calendar\Models\Event;
use Faker\Factory as Faker;

class SeedEvents extends Seeder
{
    public function run()
    {
        foreach($this->faker() as $dummy){
            echo Event::create($dummy);
        }
    }
    
    public function test(){
        
        dump($this->faker());
        
    }
    
    public function faker()
    {
        $faker = Faker::create();
        $dummy = [];

		foreach(range(1, 500) as $index)
		{

            $dummy[] = [
                'user_id'       => array_rand([1,2,3], 1),
                'title'         => $faker->text(5),
                'description'   => $faker->paragraph(1),
                'start'         => $faker->dateTimeBetween('-1 month','now'),
                'options'       => json_encode([
                    'color'             => $faker->hexcolor(),
                    'textColor'         => $faker->hexcolor(),
                    'backgroundColor'   => $faker->hexcolor()
                ])
            ];
            
		}

        return $dummy;
    }
    
}//

