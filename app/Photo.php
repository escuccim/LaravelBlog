<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
    	'order',
    	'file',
    	'title',
    	'caption',
    ];
    
    public function scopeActive($query){
    	$query->where('active', '=', '1');
    }

	public function statusText(){
		if($this->active == 1){
			return 'panel-default';
		} else {
			return 'panel-warning';
		}
	}
}
