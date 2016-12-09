<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Photo;

class PhotoTest extends TestCase
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

	public function testPublic(){
		$this->visit('/pictures')
			->see('pictures');		
	}
	
	public function testAdmin(){
		$admin = factory(App\User::class)->create();
		$admin->type = 1;
		$admin->save();
		
		$this->actingAs($admin)
			->visit('/photoadmin')
			->see('Photo Administration')
			->see('Add Photo');
		
		$this->actingAs($admin)
			->visit('/photoadmin/create')
			->see('Add Photo');
		
		$admin->destroy($admin->id);
	}
	
	/** 
	 * test adding photos 
	 * to avoid having to have test files to upload I'm just going to do it directly into the database and then make sure it appears
	 **/
	public function testAddPhoto(){
		$admin = factory(App\User::class)->create();
		$admin->type = 1;
		
		$photo = factory(App\Photo::class)->create();
		
		$this->seeInDatabase('photos', [
				'title' => 'Test Photo',
		]);
		
		$this->actingAs($admin)
			->visit('/photoadmin')
			->see('Test Photo');
	}
}
