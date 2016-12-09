<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use DB;
use App\Http\Requests;

class PhotoController extends Controller
{
	var $destinationPath = '';
	
	/**
	 * Sets middleware, to allow non-admins to view carousel
	 * Also sets destination path to be used in other functions to display or upload photos
	 */
	public function __construct(){
		$this->middleware('admin')->except('carousel');
		$this->destinationPath = public_path() . '/storage/photos';
	}
	
	/**
	 * Page that displays my carousel of photos
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function carousel(){
		$photos = Photo::orderBy('order', 'asc')->active()->get();		
		return view('pages.pictures', compact('photos'));
	}
	
	/**
	 * Index page, shows list of photos to admin
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function index(){
		$photos = Photo::orderBy('order', 'asc')->get();
		return view('photos.index', compact('photos'));
	}
	
	/**
	 * Page to create a new photo
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function create(){
		// 	create a dummy blank photo to pass to form model, set defaults for form fields that need them
		$photo = new Photo();
		$photo->active = 0;
		$photo->order = 0;
		$submitButtonText = 'Add Photo';
		return view('photos.create', compact('photo', 'submitButtonText'));
	}
	
	/**
	 * Stores photos in the database, and uploads the files to the server
	 * @param Request $request
	 * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request){
		// validate request
		$this->validate($request, [
				'title' => 'required',
				'file' => 'required',
				'order' => 'required',
				'active' => 'required',
		]);
		
		// upload the file
		if($request->file('file')->isValid()){
			// generate unique filename
			$ext = $request->file('file')->getClientOriginalExtension();
			$file = $request->file('file')->getClientOriginalName();
			$fileName = $this->uniqueFilename($this->destinationPath, $file, $ext);
			
			// move the file to a permanent location
			$request->file('file')->move($this->destinationPath, $fileName);
			
			// store the data
			$photo = new Photo($request->all());
			$photo->file = $fileName;
			$photo->save();
			
			// reorder the photos to eliminate duplicate order numbers
			$this->reOrderPhotos($request->input('order'), $photo->id);
			return redirect('photoadmin');
		} else {
			// if there is a problem with the file flash a warning and go back to the form
			flash()->warning('There is a problem with the file uploaded.');
			return redirect('photoadmin')->withInput();
		}
	}
	
	/**
	 * Displays edit page for a photo. File can't be changed.
	 * 
	 * @param $id of photo
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function edit($id){
		$photo = Photo::where('id', $id)->first();
		$submitButtonText = 'Update Photo';
		return view('photos.edit', compact('photo', 'submitButtonText'));
	}
	
	/** 
	 * since we don't allow the user to replace the file for a photo, just validate the request and update the DB 
	 * 
	 * @param Photo $id
	 * @param Request $request
	 * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
	 */
	public function update($id, Request $request){
		// validate request
		$this->validate($request, [
				'title' => 'required',
				'order' => 'required',
				'active' => 'required',
		]);
		
		$photo = Photo::findOrFail($id);
		$photo->update($request->all());
		$photo->active = $request->active;
		$photo->save();
		
		$this->reOrderPhotos($request->input('order'), $id);
		
		flash()->success('The photo has been updated!');
		
		return redirect('photoadmin');
	}
	
	/** 
	 * delete the entry from the DB and delete the file from disk 
	 **/
	public function destroy($id){
		// delete the photo from disk (to save space? or just because)
		$photo = Photo::where('id', $id)->first();
		$path = $this->destinationPath . '/' . $photo->file;
		$foo = unlink($path);
		
		// delete the Photo from the DB
		Photo::destroy($id);
		return redirect('photoadmin');
	}
	
	/**
	 * Called via ajax by sortable jquery list in index page.
	 * Contains post with item = array of IDs of photos, in order
	 * Loops through array and updates DB accordingly. 
	 **/
	public function order(Request $request){
		$data = $request->input('item');
		$i = 0;
		
		foreach($data as $value){
			$photo = Photo::find($value);
			$photo->order = $i;
			$photo->save();
			$i++;
		}
	}
	
	/** 
	 * Gets the photos from the DB and assigns them sequential, unique values for order, starting at 1 
	 * Shouldn't be too important since drag and drop interface was implemented.
	 * In fact could entirely be gotten rid of and replaced with a dummy call to order
	 **/
	protected function reOrderPhotos($order, $id){
		// reset everything to min possible values, duplicate orders get assigned at random, I guess
		$photos = Photo::orderBy('order', 'asc')->get();
		$counter = 0;
		foreach($photos as $photo){
			$affected = DB::update('UPDATE photos set `order` = ' . $counter . ' WHERE id = ' . $photo->id);
			$counter++;
		}
	}
	
	/**
	 * Creates a unique filename by appending a number
	 **/
	protected function uniqueFilename($path, $name, $ext) {
	
		$output = $name;
		$basename = basename($name, '.' . $ext);
		$i = 2;
	
		while(file_exists($path . '/' . $output)) {
			$output = $basename . $i . '.' . $ext;
			$i ++;
		}
	
		return $output;
	
	}
}
