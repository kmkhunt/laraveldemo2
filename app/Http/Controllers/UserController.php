<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		return view("user.index");
	}

	public function indexJson(Request $request) {

		$response = array();
		$response['draw'] = intval($request->get('draw'));
		$skip = (isset($request['start']) ? intval($request['start']) : 1);
		$columns = $request->get('columns');
		$order = $request->get('order');

		$query = \DB::table('users')->select(
			\DB::raw('CONCAT("tr", "_", users.id) as DT_RowId'),
			'users.id',
			'users.name',
			'users.email',
			'users.created_at'
		);

		$queryTotal = \DB::table('users')->select('*');

		if (!empty($request['search']['value'])) {
			$searchValue = $request['search']['value'];
			$query = $query->where(function ($query) use ($searchValue) {
				$query->orWhere("users.name", "LIKE", "%$searchValue%")
					->orWhere("users.email", "LIKE", "%$searchValue%")
					->orWhere("users.created_at", "LIKE", "%$searchValue%");
			});

			$queryTotal = $queryTotal->where(function ($queryTotal) use ($searchValue) {
				$queryTotal->orWhere("users.name", "LIKE", "%$searchValue%")
					->orWhere("users.email", "LIKE", "%$searchValue%")
					->orWhere("users.created_at", "LIKE", "%$searchValue%");
			});
		}

		$total = $queryTotal->count();

		$response['recordsTotal'] = intval($total);
		$response['recordsFiltered'] = intval($total);
		$response['data'] = array();
		if (is_array($columns)) {
			foreach ($columns as $key => $column) {
				if ($order[0]['column'] == $key) {
					switch ($key) {
					case 0:
						$query = $query->orderBy("users.name", $order[0]['dir']);
						break;
					case 1:
						$query = $query->orderBy("users.email", $order[0]['dir']);
						break;
					default:
						$query = $query->orderBy("users.created_at", $order[0]['dir']);
						break;
					}
				}
			}
		}

		$records = $query->limit(10)->skip($skip)->get()->toArray();
		$response['data'] = $records;
		return response()->json($response);

	}

}
