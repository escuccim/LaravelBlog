<?php

function foo(){
	return 'bar';
}

function isUserAdmin(){
	if(Auth::guest())
		return false;
	else {
		return (Auth::user()->isAdmin());
	}
}

function app_name(){
	$default = config('app.name', 'Eric Scuccimarra');
	
	if(isset($_SERVER['SERVER_NAME'])){
		if(strpos($_SERVER['SERVER_NAME'], 'ericscuccimarra') !== false){
			return 'Eric Scuccimarra';
		} else {
			return $default;
		}
	} else {
		return $default;
	}
}

function app_url(){
	$default = env('APP_URL', 'http://www.skoo.ch');
	
	if(isset($_SERVER['SERVER_NAME'])){
		if(strpos($_SERVER['SERVER_NAME'], 'skoo.ch') !== false){
			return 'http://www.skoo.ch';
		}
		elseif(strpos($_SERVER['SERVER_NAME'], 'ericscuccimarra') !== false){
			return 'http://www.ericscuccimarra.net';
		} else {
			return $default;
		}
	} else {
		return $default;
	}
}

function putInCache($key, $content, $time = 720){
	Cache::put($key, $content, $time);
	return $content;
}