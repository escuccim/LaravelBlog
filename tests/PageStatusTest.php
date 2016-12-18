<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageStatusTest extends TestCase
{
	use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
	// Test to see that pages exist and return content
    public function testPagesExist ()
    {
        $this->visit('/')
        	->assertResponseOK();
        
    	$this->visit('/blog')
	    	->assertResponseOK()
    		->see('Archives');
    		
    	$this->visit('/login')
	    	->assertResponseOK()
    		->see('Login')
    		->see('E-Mail Address')
    		->see('Forgot Your Password');
    
    	$this->visit('/register')
	    	->assertResponseOK()
    		->see('Register')
    		->see('Name')
    		->see('Confirm Password');
    }
}
