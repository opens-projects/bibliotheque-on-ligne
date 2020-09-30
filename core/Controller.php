 <?php 
	
	/**
	 * Controller
	 */
	class Controller
	{
		public $page;
		public $model;
		public $vars = [];
		public $action;
		public $request;
		public $user;

		public function __construct($model, $action, $vars)
		{
			$this->model = $this->loadModel($model);
			$this->action = $action;
			$this->vars = $vars;
			$this->page = new Page;
			$this->page->setContentFile($model.'/'.$action);
			$this->request = new Request;
			$this->user = new User;
			$this->page->addVar('user', $this->user);

			$method = $this->action;

			if (is_callable([$this, $method])) {
				$this->$method();
			}
			
		}

		public function loadModel($model)
		{
			$mod = ucfirst($model).'Model';
			$fileModel = 'models/'.$mod.'.php';

			

			require $fileModel;

			$m = new $mod;
			// $table = strtolower(trim($model, 's'));
			// $m->table = $table;

			return $m;
			
		}
	}


 ?>