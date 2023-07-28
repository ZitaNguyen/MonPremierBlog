<?php

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class AbstractController
{

	protected $twig;


	public function __construct()
	{
		$loader = new FilesystemLoader('templates');
		$this->twig = new Environment($loader);
		$this->twig->addGlobal('session', $_SESSION);
	}
	

	/**
	 * Function to erase message in session.
	 */
	public function unsetSession()
	{
		if (isset($_SESSION['message']))      unset($_SESSION['message']);
		if (isset($_SESSION['error_level']))  unset($_SESSION['error_level']);
	}
}
