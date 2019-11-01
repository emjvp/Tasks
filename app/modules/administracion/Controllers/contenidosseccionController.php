<?php
/**
* Controlador de Contenidosseccion que permite la  creacion, edicion  y eliminacion de los Administrar Acuerdos Comerciales del Sistema
*/
class Administracion_contenidosseccionController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos Administrar Acuerdos Comerciales
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
	protected $_csrf_section = "administracion_contenidosseccion";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador contenidosseccion .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Contenidosseccion();
		$this->namefilter = "parametersfiltercontenidosseccion";
		$this->route = "/administracion/contenidosseccion";
		$this->namepages ="pages_contenidosseccion";
		$this->namepageactual ="page_actual_contenidosseccion";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Administrar Acuerdos Comerciales con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Aministración de Administrar Acuerdos Comerciales";
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
		$this->_view->list_seccion_id = $this->getSeccionid();
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Acuerdos Comerciales  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_contenidosseccion_".date("YmdHis");
		$seccionModel = new Administracion_Model_DbTable_Seccion();
		$this->_view->seccion = $seccionModel->getList("", "orden ASC");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_seccion_id = $this->getSeccionid();
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->contenidos_sec_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar Acuerdos Comerciales";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear Acuerdos Comerciales";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear Acuerdos Comerciales";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un Acuerdos Comerciales  y redirecciona al listado de Administrar Acuerdos Comerciales.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$uploadImage =  new Core_Model_Upload_Image();
			if($_FILES['contenidos_sec_imagen']['name'] != ''){
				$data['contenidos_sec_imagen'] = $uploadImage->upload("contenidos_sec_imagen");
			}
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id,$id);
			$data['contenidos_sec_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR ACUERDOS COMERCIALES';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un Acuerdos Comerciales  y redirecciona al listado de Administrar Acuerdos Comerciales.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->contenidos_sec_id) {
				$data = $this->getData();
				$uploadImage =  new Core_Model_Upload_Image();
				if($_FILES['contenidos_sec_imagen']['name'] != ''){
					if($content->contenidos_sec_imagen){
						$uploadImage->delete($content->contenidos_sec_imagen);
					}
					$data['contenidos_sec_imagen'] = $uploadImage->upload("contenidos_sec_imagen");
				} else {
					$data['contenidos_sec_imagen'] = $content->contenidos_sec_imagen;
				}
				$this->mainModel->update($data,$id);
			}
			$data['contenidos_sec_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR ACUERDOS COMERCIALES';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y elimina un Acuerdos Comerciales  y redirecciona al listado de Administrar Acuerdos Comerciales.
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
					$uploadImage =  new Core_Model_Upload_Image();
					if (isset($content->contenidos_sec_imagen) && $content->contenidos_sec_imagen != '') {
						$uploadImage->delete($content->contenidos_sec_imagen);
					}
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR ACUERDOS COMERCIALES';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Contenidosseccion.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['contenidos_sec_titulo'] = $this->_getSanitizedParam("contenidos_sec_titulo");
		$data['contenidos_sec_descripcion'] = $this->_getSanitizedParamHtml("contenidos_sec_descripcion");
		if($this->_getSanitizedParam("seccion_id") == '' ) {
			$data['seccion_id'] = '0';
		} else {
			$data['seccion_id'] = $this->_getSanitizedParam("seccion_id");
		}
		$data['contenidos_sec_imagen'] = "";
		return $data;
	}

	/**
     * Genera los valores del campo Acuerdo Comercial rel.
     *
     * @return array cadena con los valores del campo Acuerdo Comercial rel.
     */
	private function getSeccionid()
	{
		$modelData = new Administracion_Model_DbTable_Dependseccion();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->seccion_id] = $value->seccion_id;
		}
		return $array;
	}

	/**
     * Genera la consulta con los filtros de este controlador.
     *
     * @return array cadena con los filtros que se van a asignar a la base de datos
     */
    protected function getFilter()
    {
    	$filtros = " 1 = 1 ";
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->contenidos_sec_titulo != '') {
                $filtros = $filtros." AND contenidos_sec_titulo LIKE '%".$filters->contenidos_sec_titulo."%'";
            }
            if ($filters->seccion_id != '') {
                $filtros = $filtros." AND seccion_id LIKE '%".$filters->seccion_id."%'";
            }
            if ($filters->contenidos_sec_imagen != '') {
                $filtros = $filtros." AND contenidos_sec_imagen LIKE '%".$filters->contenidos_sec_imagen."%'";
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
					$parramsfilter['contenidos_sec_titulo'] =  $this->_getSanitizedParam("contenidos_sec_titulo");
					$parramsfilter['seccion_id'] =  $this->_getSanitizedParam("seccion_id");
					$parramsfilter['contenidos_sec_imagen'] =  $this->_getSanitizedParam("contenidos_sec_imagen");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}