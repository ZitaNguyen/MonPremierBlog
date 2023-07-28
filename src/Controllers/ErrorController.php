<?php

namespace App\Controllers;

use App\Controllers\AbstractController;

class ErrorController extends AbstractController
{


	/**
	 * Function to return a 404 page.
	 */
	public function get404()
	{
		http_response_code(404);
		$this->twig->display('404.html.twig');
	}
}
