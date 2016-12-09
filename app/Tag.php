<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = [
			'name',
	];

	/* Get the articles associated with this tag */
	public function blogs(){
		return $this->belongsToMany('App\Blog');
	}
}
