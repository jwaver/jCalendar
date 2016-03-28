<?php namespace \Jwaver\jCalendar\Updates;

use Seeder;
use Storage;
use Faker\Factory as Faker;

class SeedTest extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $file = "";

		foreach(range(0, 5000) as $index)
		{

            $dummy = [
                // 'bothify'           => $faker->bothify(),
                // 'numerify'          => $faker->numerify(),
                // 'lexify'            => $faker->lexify(),
                // 'asciify'           => $faker->asciify(),
                // 'regexify'          => $faker->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'),
                // 'text'              => $faker->text(500),
                // 'realText'          => $faker->realText(500),
                // 'email'             => $faker->email(),
                // 'safeEmail'         => $faker->safeEmail(),
                // 'freeEmail'         => $faker->freeEmail(),
                // 'companyEmail'      => $faker->companyEmail(),
                // 'freeEmailDomain'   => $faker->freeEmailDomain(),
                // 'safeEmailDomain'   => $faker->safeEmailDomain(),
                // 'userName'          => $faker->userName(),
                // 'password'          => $faker->password(),
                // 'domainName'        => $faker->domainName(),
                // 'domainWord'        => $faker->domainWord(),
                // 'tld'               => $faker->tld(),
                // 'url'               => $faker->url(),
                // 'slug'              => $faker->slug(),
                // 'ipv4'              => $faker->ipv4(),
                // 'localIpv4'         => $faker->localIpv4(),
                // 'ipv6'              => $faker->ipv6(),
                // 'uuid'              => $faker->uuid(),
                // 'ean13'             => $faker->ean13(),
                // 'ean8'              => $faker->ean8(),
                // 'isbn13'            => $faker->isbn13(),
                // 'isbn10'            => $faker->isbn10(),
                // 'md5'               => $faker->md5(),
                // 'sha1'              => $faker->sha1(),
                // 'sha256'            => $faker->sha256(),
                'macAddress'        => $faker->macAddress()
            ];
            
            $file .= $dummy['macAddress'];
            
		}
        
        dump($file);

    }
}

