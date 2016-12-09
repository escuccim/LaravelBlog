<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Redis;

class BlogTest extends TestCase
{
	use DatabaseTransactions;
	
    /**
     * Test blog pages
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    
    public function testBlogPagesAppear (){
    	// Check if pages are OK with no user
    	$this->visit('/blog')
    		->see('Archives')
    		->dontSee('Add Blog Post');
    	
    	// since I changed middleware so that requests to admin pages return 404 errors instead of redirects, 
    	// this has been updated accordingly
    	$response = $this->call('GET', '/blog/create');
    	$this->assertEquals(404, $response->status());
    		
    	// CHeck if pages are OK with a user
    	$user = factory(App\User::class)->create();
    	
    	$this->actingAs($user)
    		->visit('/blog')
    		->see('Archives')
    		->dontSee('Show/Hide')
    		->dontSee('Add Blog Post');
    	
    	$response = $this->call('GET', '/blog/create');
    	$this->assertEquals(404, $response->status());
    		
    	// Check if pages are OK with admin
    	$user->type = 1;
    	 
    	$this->actingAs($user)
	    	->visit('/blog')
	    	->see('Archives')
	    	->see('Add Blog Post');
	  
//     	$user->destroy($user->id);
    }
    
    public function testBlogAdmin(){
    	$user = factory(App\User::class)->create();
    	$user->type = 1;
    	$user->save();
    	
    	// check that we can make new blogs
    	$this->actingAs($user)
    		->visit('/blog/create')
	    	->see('Write a New Blog Post');
    	
	    // make a new blog, check that it is made, edit it, check that it is edited, change the date	
	    $this->actingAs($user)
	    	->visit('/blog/create')
	    	->type('PHP Unit Test', 'title')
	    	->type('PHP Unit Test', 'slug')
	    	->type('PHP Unit Test', 'body')
	    	->select('3', 'tags')
	    	->press('Add Blog Post')
	    	->see('Your blog has been created')
	    	->seePageIs('/blog')
	    	->see('PHP Unit Test')
	    	->see('No comments');
	    
	    // make sure the new blog appears on the home page
	    $this->actingAs($user)
	    	->visit('/home')
	    	->see('PHP Unit Test');
	   
	    // make sure it appears in the RSS feed
	    $this->visit('/feed')
	    	->see('PHP Unit Test');
	    	
	    // test editing of blog
	    $this->actingAs($user)
	    	->visit('/blog')
	    	->click('PHP Unit Test')
	    	->see('PHP Unit Test')
	    	->see('Edit Blog')
	    	->click('Edit Blog')
	    	->see('Edit:')
	    	->type('Test Content', 'body')
	    	->press('Update Blog')
	    	->see('Your blog post has been edited!')
	    	->seePageIs('/blog/php-unit-test')
	    	->see('PHP Unit Test')
	    	->click('PHP Unit Test')
	    	->click('Edit Blog')
	    	->type('12/31/2019', 'published_at')
	    	->press('Update Blog')
	    	->see('Your blog post has been edited!')
	    	->see('PHP Unit Test');
    	
	   	// see that blog exists in DB
	    $this->seeInDatabase('blogs', [
	    	'title' => 'PHP Unit Test',	
	    ]);	
	    
	    // make sure the new blog does NOT appears on the home page
	    $this->actingAs($user)
	    	->visit('/home')
	   	 ->dontSee('PHP Unit Test');
	    
	    // make sure it doesn't appear in the RSS feed
	    $this->visit('/feed')
	    	->dontSee('PHP Unit Test');
	    
	    // proper links appear as admin
		$this->actingAs($user)
	    	->visit('/blog/php-unit-test')
	    	->see('PHP Unit Test')
	    	->see('Edit Blog')
	    	->see('Delete Blog');
	    
	    // check that label is working
	    $this->actingAs($user)
	    	->visit('/blog/labels/test')
	    	->see('PHP Unit Test');
	    
	    // see that it doesn't appear for non-admins	
	    // it also shouldn't appear because the data is cached
	    $user->type = 0;
	    $user->save();
	    
	    $this->visit('/blog/php-unit-test')
		    ->dontSee('PHP Unit Test')
		    ->dontSee('Edit Blog')
		    ->dontSee('Delete Blog');
		     
	    $this->actingAs($user)
		    ->visit('/blog/php-unit-test')
		    ->dontSee('PHP Unit Test')
		    ->dontSee('Edit Blog')
		    ->dontSee('Delete Blog');
		
	    $this->actingAs($user)
	    	->visit('/blog')
	    	->dontSee('PHP Unit Test');
	    	
	    // change back to admin user, reset date on test article
	    $user->type = 1;
	    $user->save();
	    
	    $this->actingAs($user)
	    	->visit('/blog/php-unit-test')
	    	->click('Edit Blog')
	    	->type('12/31/2015', 'published_at')
	    	->press('Update Blog')
	    	->see('Your blog post has been edited!')
	    	->see('PHP Unit Test');
	   
	    // check that we can see it as no user
    	$user->type = 0;
    	
    	$this->visit('/blog/php-unit-test')
	    	->see('PHP Unit Test')
	    	->dontSee('Edit Blog')
	    	->dontSee('Delete Blog');
	   
     	$user->destroy($user->id);
    	
     	// flush the redis list
     	Redis::flushall();
    }
}
