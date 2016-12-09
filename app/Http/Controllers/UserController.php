<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
	// var to hold path where to upload user pics
	var $destinationPath;
	
	/**
	 * Set middleware and destinationPath var
	 */
	public function __construct(){
		$this->middleware('admin')->except(['profile', 'update', 'loginGoogle']);
		$this->destinationPath = public_path() . '/storage/avatars';
	}
	
	/* 
	 * handle login requests from "login with google"
	 * this is called via ajax by the googleapi.js onSignIn function
	 * Input: post via ajax with Google API return info
	 * Return: status, to be used by JS function
	 */
	public function loginGoogle(Request $request){
		if(Auth::guest()){
			$tempUser['name'] = $request->name;
			$tempUser['email'] = $request->email;
			$tempUser['id'] = $request->id;
			$tempUser['password'] = bcrypt($tempUser['id']);
			$tempUser['image'] = $request->image;
			
			if($this->addOrLoginGoogleUser($tempUser))
				return "success";
			else 
				return 'error';
		} else {
			return 'logged in';
		}
	}
	
	/**
	 * Show user profile
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
    public function profile(Request $request){
		$user = Auth::user();
		return view('user.profile', compact('user'));
	}

	/**
	 * Update user profile, can be called as admin or as user updating their own profile
	 * @param Request $request
	 * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request){
		// if normal user set the user to the user logged in
		$user = Auth::user();
		$admin = $user->isAdmin();
		
		// if the user is an admin then get the user ID from the form
		if($admin){
			$user = User::where('id', $request->input('id'))->first();
		}
		
		// different validation depending on whether they are changing their password or not
		if($request->input('password') == ''){
			$this->validate($request, [
				'name' => 'required|max:255',
				'email' => 'required|email|max:255',
			]);
		} else {
			$this->validate($request, [
				'name' => 'required|max:255',
				'email' => 'required|email|max:255',
				'password' => 'required|min:6|confirmed',
			]);
			$user->password = bcrypt($request->input('password'));
			
		}
		// set active based on whether it checkbox defined in form
		if($request->input('active'))
			$active = 1;
		else 
			$active = 0;
		
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->active = $active;
		
		// upload the image, if any
		if($request->hasFile('image')){
			if($request->file('image')->getClientSize() < 5000000){
				$ext = $request->file('image')->getClientOriginalExtension();
	 			$fileName = 'userimage-' . $user->id . '.' . $ext;
				$path = $request->file('image')->move($this->destinationPath, $fileName);
				$user->image = '/storage/avatars/' . $fileName;
			} else {
				$user->save();
				flash()->warning('The image you selected is too large!');
				return redirect('user/profile')->withInput();
			}
		}
		
		// if the user is an admin, we can't let them make themselves not an admin
		// set success messages accordingly
		if($admin){
			if(Auth::user()->id != $request->input('id')){
				$user->type = $request->input('type');
				flash()->success('User updated!');
			} elseif($request->input('type') == 0) {
				flash()->warning('You can\'t make yourself not an admin!');
			} else {
				flash()->success('User updated!');
			}
		}
		// save the user
		$user->save();
		
		// redirect to appropriate page
		if(!$admin)
			return redirect('user/profile');
		else
			return redirect('users');
	}
	
	/**
	 * Show user list, only for admin
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function index(){
		$users = User::orderBy('name', 'asc')->get();		
		return view('user.list', compact('users'));
	}
	
	/**
	 * Show edit page for selected user, only for admin
	 * @param unknown $id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function edit($id){
		$user = User::where('id', $id)->first();
		return view('user.profile', compact('user'));
	}
	
	/**
	 * Called to validate API logins from Google. Takes in tempUser structure containing info returned from Google
	 * Checks if user already exists. If so logs them in. If not adds them to the DB and logs them in.
	 * Returns boolean indicating whether user was successfully logged in or not. 
	 * (Note: the only way it should return false is if the user exists and is marked as inactive.)
	 * 
	 * @param $tempUser
	 * @return boolean
	 */
	private function addOrLoginGoogleUser($tempUser){
		// check if a user exists using the email and the google ID as a password
		$user = User::where('email', $tempUser['email'])->first();
		
		// if no user found create them
		if(!$user){
			$user = new User();
			$user->email = $tempUser['email'];
			$user->password = $tempUser['password'];
			$user->name = $tempUser['name'];
			$user->google = 1;
			$user->image = $tempUser['image'];
			$user->save();
		}
		
		// log the user in to our system
		if(Auth::attempt(['email' => $tempUser['email'], 'active' => 1, 'password' => $tempUser['id']]))
			return true;
		else 
			return false;
	}
}
