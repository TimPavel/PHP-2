<?php


namespace App\View;

use Twig_Environment;
use Twig_Loader_Filesystem;

class Page
{
	private $twig;
	private $template;

	public function __construct($template){
		$loader = new Twig_Loader_Filesystem('views');

		$this -> twig = new Twig_Environment($loader);
		$this -> template = $template.'.twig';
	}

	/**
	 * @param $data
	 * @return string
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function render($data) {
		return $this -> twig -> render(
			$this -> template,
			$data
		);
	}
}


//echo $twig->render('index.html', array('name' => 'Fabien'));