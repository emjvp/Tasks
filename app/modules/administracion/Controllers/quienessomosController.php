<?php
/**
* Controlador de Quienessomos que permite la  creacion, edicion  y eliminacion de los Informaci&oacute;n Contenido del Sistema
*/
class Administracion_quienessomosController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos Informaci&oacute;n Contenido
	 * @var modeloContenidos
	 */
	public $mainModel;

	/**
	 * $route  url del controlador base
	 * @var string
	 */
	protected $route;

	/**
	 * $pages cantidad de registros a mostrar por pagina]
	 * @var integer
	 */
	protected $pages ;

	/**
	 * $namefilter nombre de la variable a la fual se le van a guardar los filtros
	 * @var string
	 */
	protected $namefilter;

	/**
	 * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
	 * @var string
	 */
	protected $_csrf_section = "administracion_quienessomos";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador quienessomos .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Quienessomos();
		$this->namefilter = "parametersfilterquienessomos";
		$this->route = "/administracion/quienessomos";
		$this->namepages ="pages_quienessomos";
		$this->namepageactual ="page_actual_quienessomos";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Informaci&oacute;n Contenido con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Aministración de Informaci&oacute;n Contenido";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters =(object)Session::getInstance()->get($this->namefilter);
        $this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "orden ASC";
		$list = $this->mainModel->getList($filters,$order);
		$amount = $this->pages;
		$page = $this->_getSanitizedParam("page");
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
		   	$page = Session::getInstance()->get($this->namepageactual);
		   	$start = ($page - 1) * $amount;
		} else if(!$page){
			$start = 0;
		   	$page=1;
			Session::getInstance()->set($this->namepageactual,$page);
		} else {
			Session::getInstance()->set($this->namepageactual,$page);
		   	$start = ($page - 1) * $amount;
		}
		$this->_view->register_number = count($list);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($list)/$amount);
		$this->_view->page = $page;
		$this->_view->lists = $this->mainModel->getListPages($filters,$order,$start,$amount);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->contenido = $this->_getSanitizedParam("contenido");
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Informaci&oacute;n Contenido  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_quienessomos_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->contenido = $this->_getSanitizedParam("contenido");
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->quienes_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar Informaci&oacute;n Contenido";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear Informaci&oacute;n Contenido";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear Informaci&oacute;n Contenido";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un Informaci&oacute;n Contenido  y redirecciona al listado de Informaci&oacute;n Contenido.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id,$id);
			$data['quienes_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR INFORMACI&OACUTE;N CONTENIDO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$contenido = $this->_getSanitizedParam("quienes_aliado");
		header('Location: '.$this->route.'?contenido='.$contenido.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un Informaci&oacute;n Contenido  y redirecciona al listado de Informaci&oacute;n Contenido.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->quienes_id) {
				$data = $this->getData();
					$this->mainModel->update($data,$id);
			}
			$data['quienes_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR INFORMACI&OACUTE;N CONTENIDO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		$contenido = $this->_getSanitizedParam("quienes_aliado");
		header('Location: '.$this->route.'?contenido='.$contenido.'');
	}

	/**
     * Recibe un identificador  y elimina un Informaci&oacute;n Contenido  y redirecciona al listado de Informaci&oacute;n Contenido.
     *
     * @return void.
     */
	public function deleteAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf ) {
			$id =  $this->_getSanitizedParam("id");
			if (isset($id) && $id > 0) {
				$content = $this->mainModel->getById($id);
				if (isset($content)) {
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR INFORMACI&OACUTE;N CONTENIDO';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		$contenido = $this->_getSanitizedParam("contenido");
		header('Location: '.$this->route.'?contenido='.$contenido.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Quienessomos.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['quienes_titulo'] = $this->_getSanitizedParam("quienes_titulo");
		$data['quienes_descripcion'] = $this->_getSanitizedParamHtml("quienes_descripcion");
		$data['quienes_aliado'] = $this->_getSanitizedParamHtml("quienes_aliado");
		return $data;
	}
	/**
     * Genera la consulta con los filtros de este controlador.
     *
     * @return array cadena con los filtros que se van a asignar a la base de datos
     */
    protected function getFilter()
    {
    	$filtros = " 1 = 1 ";
		$contenido= $this->_getSanitizedParam("contenido");
		$filtros = $filtros." AND quienes_aliado = '$contenido' ";
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->quienes_titulo != '') {
                $filtros = $filtros." AND quienes_titulo LIKE '%".$filters->quienes_titulo."%'";
            }
		}
        return $filtros;
    }

    /**
     * Recibe y asigna los filtros de este controlador
     *
     * @return void
     */
    protected function filters()
    {
        if ($this->getRequest()->isPost()== true) {
        	Session::getInstance()->set($this->namepageactual,1);
            $parramsfilter = array();
					$parramsfilter['quienes_titulo'] =  $this->_getSanitizedParam("quienes_titulo");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}