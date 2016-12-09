<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Job extends Model
{
	protected $fillable = [
			'order',
			'company',
			'position',
			'startdate',
			'enddate',
			'description',
	];
	
	protected $dates = [
		'startdate',
		'enddate',
	];
	
	public function getStartDateAttribute($date){
		return new Carbon($date);
	}
	
	public function getEndDateAttribute($date){
		return new Carbon($date);
	}
	
	public function setStartDateAttribute($date){
		$this->attributes['startdate'] = Carbon::parse($date);
	}
	
	public function setEndDateAttribute($date){
		$this->attributes['enddate'] = Carbon::parse($date);
	}
}
