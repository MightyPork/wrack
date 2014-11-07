<?php namespace MightyPork\Wrack;

// include Blade
use Philo\Blade\Blade;

class App
{
	public static $_config;

	/** Blade instance ($blade->view()) */
	protected $view;

	public static function cfg($key, $default=null)
	{
		if(isset(self::$_config->{$key}))
			return self::$_config->{$key};
		else
			return $default;
	}


	public function start()
	{
		$this->init();
		$this->run();
	}


	private function init()
	{
		$blade = new Blade(VIEWS_DIR, CACHE_DIR);
		$this->view = $blade->view();

		// get route.
		if(isset($_GET['route']))
			$this->route = $_GET['route'];
		else
			$this->route = '/';

		// attempt at hijacking the router?
		if(strpos($this->route,'..'))
			$this->route = '/';

	}


	protected function render($view, $vars = array(), $return = false)
	{
		$html = $this->view->make($view, $vars)->render();
		if($return)
			return $html;
		else
			echo $html;
	}


	private function run()
	{
		$path = $this->route;

		if(Resource::isFile($path)) {

			if(isset($_GET['dl']) && $_GET['dl'])
				Resource::download($path);
			else
				Resource::send($path);

		} elseif(Navigator::isArticle($path)) {

			$a = new Article($path);

			$this->recordArticleVisit($a);

			$this->render('article', ['a' => $a]);

		} elseif(Navigator::isGroup($path)) {

			$g = new Group($path);
			$this->render('group', ['g' => $g]);

		} else {
			throw new HtmlException(404, 'File not found: '.$path);
		}

		exit;
	}


	/** Article visited, record it into DB */
	private function recordArticleVisit($a)
	{
		$visits = Util::arrayGetOptional($_COOKIE, 'counter', '{}');
		$visits = (array) @json_decode(@base64_decode($visits));
		if($visits == null) $visits = array();

		$visit_time = Util::arrayGetOptional($visits, $a->canonical, 0);

		if(time() - $visit_time > 86400) { // max visit per day
			MetaDB::recordHit($a);
			$visits[$a->canonical] = time();
		}

		setcookie('counter', base64_encode(json_encode($visits)), time() + (86400 * 7), '/');
	}
}

App::$_config = (object) include(__DIR__ . '/../config.php');
