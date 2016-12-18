<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
    			'name' => 'admin',
    			'email' => 'admin@example.com',
    			'password' => bcrypt('password'),
    			'type' => 1,
    	]);
    	
    	DB::table('tags')->insert([
    		'name' => 'test',
    	]); 
    	
    	DB::table('blogs')->insert([
    		'user_id' => 1,
    		'title' => 'First Post',
    		'slug' => 'first-post',
    		'body' => 'First post. For test purposes.',
    		'published' => 1,
    		'published_at' => Carbon::now(),
    	]);
    
    	DB::table('blog_tag')->insert([
    		'blog_id' => 1,
    		'tag_id' => 1,
    	]);
    }
}
