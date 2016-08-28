<?php

namespace Diskourse\Http\Controllers;

use Illuminate\Http\Request;
use Diskourse\Models\User;
use Diskourse\Models\Files;
use DB;


class ResourceController extends Controller
{
	public function index()
	{
		return view('templates.studymaterials.index');

	}

	public function getUpload()
	{
		return view('templates.studymaterials.upload');
	}

	
public function postUpload(Request $request)
	{
	
		$this->validate($request,[
			'faculty' => 'required|max:50',
			'subject' => 'required|max:50',
			]);

		$filename = $request->file('fileupload')->getClientOriginalName();
		$tempPath = $request->file('fileupload')->getRealPath();
		$fileType = $request->file('fileupload')->getClientOriginalExtension();
		$size = $request->file('fileupload')->getSize();
		$newFileName = str_shuffle('abcdef').mt_rand(11111,99999).".".$fileType;
		$destinationDir = "resources/assets/uploads/";
		$destinationPath = $destinationDir.$newFileName ;

		if ($fileType=="pdf"||$fileType=="docx")
		 {
		
			if (file_exists($destinationPath)) 
			{
			return redirect()->route('templates.studymaterials.upload')->with('info','File couldnot be uploaded, similar filename already exists.');
			}
			
		$store = DB::table('filesinfo')->insert([
			'filepath' => $destinationPath,
			'faculty'  => $request->input('faculty'),
			'subject'  => $request->input('subject'),
			'size'     => $size,
			'extension'=> $fileType,
			'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
			]);

		if ($store) 
			{
				if (move_uploaded_file($tempPath, $destinationPath)) 
				{
				return redirect()->route('templates.studymaterials.inventory')->with('info','File has been uploaded successfully');
				}
			 }
		}
		else{
			return redirect()->route('templates.studymaterials.upload')->with('info','Only word or pdf files are allowed, please choose another file.');
		}
		
		
	}

	public function getInventory()
	{
		$files = Files::paginate(6);
		return view('templates.studymaterials.inventory')->with('files',$files);
	}

	public function getSearchResults(Request $request)
	{
		$query = $request->input('query');
		if (!$query) {
			return redirect()->route('templates.studymaterials.index');
		}

		$files = Files::where('faculty','LIKE',"%{$query}%")
			->orWhere('subject','LIKE',"%{$query}%")
			->get();

		return view('templates.studymaterials.results')->with('files',$files); // to return the view of home page
		
	}

}
