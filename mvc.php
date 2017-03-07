<?php

class Model
{	
	public $menu;
	public $main_title;
	public $browser_title;

	public function __construct(){

		$this->menu = array (	
	'home'	=> array ('linkname' => 'Home','message' => 'Welcome to the MVC home!','title' => 'MVC Home Page'),
	'more'	=> array ('linkname' => 'More','message' => 'Thanks for asking for more!','title' => 'MVC More Page'),
	'about'	=> array ('linkname' => 'About','message' => 'Thanks for looking about!','title' => 'MVC About Page'));
		
		$this->main_title = "Welcome To The MVC Demo!";
	}
}

class View
{
	private $model;
	private $controller;
	
	public function __construct($controller,$model) {
		$this->controller = $controller;
		$this->model = $model;
	}
	
	public function display_html_headerinfo() {
                echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
		echo '<html>';
	
		echo '<head>';
                echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
		echo '<title>' . $this->model->menu[$_GET['action']]['title'] . '</title>';
		echo '<link rel="stylesheet" type="text/css" href="css/master.css">';
		echo '</head>';
	
		echo '<body>';
		echo '<div id="wrap">';
	}
	
	public function display_title() {
		echo '<h1>' . $this->model->main_title . '</h1>';
	}
	
	public function display_menubar() {
		echo '<ul id="nav">';
		foreach ($this->model->menu as $key => $details) {
			echo '<li><a href="' . basename(__FILE__) . '?action=' .$key . '">' . $details['linkname']  . '</a></li>';
		}
		echo '</ul>';

	}
	
	public function display_mainscreen() {
		echo '<div id="content">';
		echo '<p>' . $this->model->menu[$_GET['action']]['message'] . '</p>';
		echo '</div>';
	}
	
	public function display_html_footerinfo() {
		echo '</div>';
		echo '</body>';
		echo '</html>';
	}

	public function output() {
		$this->display_html_headerinfo();
		$this->display_title();
		$this->display_menubar();
		$this->display_mainscreen();
		$this->display_html_footerinfo();
	}
}

class Controller
{
	private $model;

	public function __construct($model){
		
		$this->model = $model;	
		if(!isset($_GET['action']) || empty($_GET['action'])) { 	# if no action then default to 'home'
			
			$_GET['action'] = 'home';

		}

	}
	
}

$model = new Model();						# create all 3 mvc object instances
$controller = new Controller($model);
$view = new View($controller, $model);

$view->output();

?>
