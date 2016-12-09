<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PagesTest extends TestCase
{
	use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    
    /* 
     * Test contact me page, including validation.
     * Don't actually send an email 
     */
    public function testContactMe(){
    	$this->visit('/about/contact')
    	->assertResponseOK()
    	->see('Send Message')
    	->press('Send Message')
    	->see('email field is required')
    	->see('body field is required')
    	->type('foo@example.com', 'email')
    	->press('Send Message')
    	->dontSee('email field is required')
    	->see('body field is required');
    }
}
