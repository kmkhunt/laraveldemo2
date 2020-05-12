<?php
namespace App\Http\Controllers;
use App\User;
use Datatables;

class YajraDataController extends Controller {
	public function index() {
		//exit("test");
		return Datatables::of(User::query())
			->addColumn('action', function ($row) {
				return '<a href="/prodicts/' . $row->id . '/edit" class="btn btn-primary">Edit</a>';
			})
			->editColumn('delete', function ($row) {
				return '<a href="/products/show/1">delete</a>';
			})
			->rawColumns(['delete' => 'delete', 'action' => 'action'])
			->make(true);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function yajralist() {
		return view('user/yajradata');
	}
}
