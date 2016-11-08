<?php

namespace Diskourse\Http\Controllers;

use DB;
use Diskourse\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller {

	public function getResults(Request $request) {
		$query= $request->input('query');

		if(!$query) {
			return redirect()->route('home');
		}

		$users= User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")
		->orWhere('username', 'LIKE', "%{$query}%")
		->get();

		return view('search.results')->with('users', $users);

                /* likewise, for status or other search options, we can create similar parameters and return a view.
		Don't forget to use the respective models on the "use" section /*

	}
}
