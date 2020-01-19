<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Models\Joke;

class JokeController extends BaseController
{
	public function index($page = 1)
	{
		$per_page = 50;
		$total = Joke::query()->count();
		$total_page = ceil($total/$per_page);
		$current_page = $page;

		$offset = ($page - 1) * $per_page;
		$jokes = Joke::query()
			->orderBy('created_at', 'desc')
			->offset($offset)
			->limit($per_page)
			->select(['title', 'content', 'poster', 'created_at'])
			->get();
		return $this->response()->array([
			'per_page' => $per_page,
			'total_num' => $total,
			'total_page' => $total_page,
			'current_page' => $current_page,
			'data' => $jokes
		]);
    }

}
