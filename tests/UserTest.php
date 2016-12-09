<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;

class UserTest extends TestCase
{
	use DatabaseTransactions;
    /**
     * Test user pages
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    
    public function testBlogPermissions(){
    	$user = factory(App\User::class)->create();
    	
    	$this->actingAs($user)
    		->visit('/blog')
    		->dontSee('Show/Hide')
    		->dontSee('Add Blog Post');
    	
    	$user->type = 1;
    	
    	$this->actingAs($user)
    		->visit('/blog')
    		->see('Add Blog Post');
    	
    	$user->destroy($user->id);
    }
    
   
    
    public function testRegistration(){
    	$this->visit('/register')
    		->see('Name')
    		->see('E-Mail Address')
    		->see('Password')
    		->type('Test User', 'name')
    		->press('Register')
    		->see('Register')
    		->type('test@example.com', 'email')
    		->type('test', 'password')
    		->type('test', 'password_confirmation')
    		->press('Register')
    		->see('6 characters')
    		->type('password', 'password')
    		->type('password', 'password_confirmation')
    		->press('Register')
    		->see('Test User');
    	
    	$this->seeInDatabase('users', [
    		'email' => 'test@example.com',	
    	]);
    		
		//     	log user out
    	Auth::logout();
    	
    	// test login
    	// incorrect password
    	$this->visit('/login')
    		->type('test@example.com', 'email')
    		->type('password111', 'password')
    		->press('Login')
    		->see('These credentials do not match our records')
    		->seePageIs('/login');
    	
    	// correct password
    	$this->visit('/login')
    		->type('test@example.com', 'email')
    		->type('password', 'password')
    		->press('Login')
    		->seePageIs('/home');
    		
    	// delete the user we just created
    	$user = \App\User::where('email', 'test@example.com')->first();
    	$user->destroy($user->id);
    }
    
    public function testHomePermissions(){
    	$this->visit('/home')
    		->dontSee('User Management');
    	
    	$admin = factory(App\User::class)->create();
		$admin->type = 1;
		
		$this->actingAs($admin)
			->visit('/home')
			->see('User Management');

		$admin->destroy($admin->id);
    }
}
