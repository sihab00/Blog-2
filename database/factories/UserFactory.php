<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'username' =>$faker->unique()->userName,
        'password' => bcrypt(123456),
        'phone_number'=>$faker->unique()->phoneNumber,
        'photo' => $faker->imageUrl(),
        'email_verified'=>1,
        'email_verified_at'=>Carbon::now(),
        'email_verification_token'=>'',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Category::class, function(Faker $faker){

		
		$category = $faker->unique()->name;

	return [
		'name'=>$category,
       	'slug'=>str_slug($category),
	];

});

$factory->define(App\Post::class, function(Faker $faker){

	return [
		'user_id'=> random_int(1, 50),
    	'category_id'=>random_int(1, 50),
    	'title'=>$faker->realText(32),
    	'content' =>$faker->realText(),
    	'thumbnail_path' =>$faker->imageUrl(),
	];

});

