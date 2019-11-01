<?php
/**
* Controlador de Contenidos que permite la  creacion, edicion  y eliminacion de los Contenidos del Sistema
*/
class Administracion_contenidosController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos Contenidos
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
	protected $_csrf_section = "administracion_contenidos";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador contenidos .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Contenidos();
		$this->namefilter = "parametersfiltercontenidos";
		$this->route = "/administracion/contenidos";
		$this->namepages ="pages_contenidos";
		$this->namepageactual ="page_actual_contenidos";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Contenidos con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Aministración de Contenidos";
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
		$this->_view->list_contenidos_seccion = $this->getContenidosseccion();
		$this->_view->list_contenidos_estado = $this->getContenidosestado();
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Contenido  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_contenidos_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_contenidos_seccion = $this->getContenidosseccion();
		$this->_view->list_contenidos_estado = $this->getContenidosestado();
		$this->_view->list_contenidos_color = $this->getContenidoscolor();
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->contenidos_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar Contenido";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear Contenido";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear Contenido";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un Contenido  y redirecciona al listado de Contenidos.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$uploadImage =  new Core_Model_Upload_Image();
			if($_FILES['contenidos_imagen']['name'] != ''){
				$data['contenidos_imagen'] = $uploadImage->upload("contenidos_imagen");
			}
			if($_FILES['contenidos_fondo']['name'] != ''){
				$data['contenidos_fondo'] = $uploadImage->upload("contenidos_fondo");
			}
			$uploadDocument =  new Core_Model_Upload_Document();
			if($_FILES['contenidos_archivo']['name'] != ''){
				$data['contenidos_archivo'] = $uploadDocument->upload("contenidos_archivo");
			}
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id,$id);
			$data['contenidos_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR CONTENIDO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un Contenido  y redirecciona al listado de Contenidos.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->contenidos_id) {
				$data = $this->getData();
				$uploadImage =  new Core_Model_Upload_Image();
				if($_FILES['contenidos_imagen']['name'] != ''){
					if($content->contenidos_imagen){
						$uploadImage->delete($content->contenidos_imagen);
					}
					$data['contenidos_imagen'] = $uploadImage->upload("contenidos_imagen");
				} else {
					$data['contenidos_imagen'] = $content->contenidos_imagen;
				}
			
				if($_FILES['contenidos_fondo']['name'] != ''){
					if($content->contenidos_fondo){
						$uploadImage->delete($content->contenidos_fondo);
					}
					$data['contenidos_fondo'] = $uploadImage->upload("contenidos_fondo");
				} else {
					$data['contenidos_fondo'] = $content->contenidos_fondo;
				}
				$uploadDocument =  new Core_Model_Upload_Document();
				if($_FILES['contenidos_archivo']['name'] != ''){
					if($content->contenidos_archivo){
						$uploadDocument->delete($content->contenidos_archivo);
					}
					$data['contenidos_archivo'] = $uploadDocument->upload("contenidos_archivo");
				} else {
					$data['contenidos_archivo'] = $content->contenidos_archivo;
				}
				$this->mainModel->update($data,$id);
			}
			$data['contenidos_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR CONTENIDO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y elimina un Contenido  y redirecciona al listado de Contenidos.
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
					if (isset($content->contenidos_imagen) && $content->contenidos_imagen != '') {
						$uploadImage->delete($content->contenidos_imagen);
					}
					
					if (isset($content->contenidos_fondo) && $content->contenidos_fondo != '') {
						$uploadImage->delete($content->contenidos_fondo);
					}
					$uploadDocument =  new Core_Model_Upload_Document();
					if (isset($content->contenidos_archivo) && $content->contenidos_archivo != '') {
						$uploadDocument->delete($content->contenidos_archivo);
					}
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR CONTENIDO';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Contenidos.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['contenidos_fecha'] = $this->_getSanitizedParam("contenidos_fecha");
		$data['contenidos_seccion'] = $this->_getSanitizedParam("contenidos_seccion");
		$data['contenidos_estado'] = $this->_getSanitizedParam("contenidos_estado");
		$data['contenidos_titulo'] = $this->_getSanitizedParam("contenidos_titulo");
		$data['contenidos_subtitulo'] = $this->_getSanitizedParam("contenidos_subtitulo");
		$data['contenidos_color'] = $this->_getSanitizedParam("contenidos_color");
		$data['contenidos_introduccion'] = $this->_getSanitizedParamHtml("contenidos_introduccion");
		$data['contenidos_descripcion'] = $this->_getSanitizedParamHtml("contenidos_descripcion");
		$data['contenidos_imagen'] = "";
		$data['contenidos_fondo'] = "";
		$data['contenidos_archivo'] = "";
		$data['enlace'] = $this->_getSanitizedParam("enlace");
		return $data;
	}

	/**
     * Genera los valores del campo Seccion.
     *
     * @return array cadena con los valores del campo Seccion.
     */
	private function getContenidosseccion()
	{
		$array = array();
		$array['1'] = 'Home';
		$array['2'] = 'Información';
		$array['3'] = 'Empresas derecha';
		$array['4'] = 'Noticias';
		$array['5'] = 'Eventos Inicio';
		$array['6'] = 'Publicaciones Inicio';
		$array['7'] = 'Aliados Estratégicos';
		$array['8'] = 'Quiénes Sómos';
		$array['9'] = 'Misión-Visión';
		$array['10'] = 'Beneficios';
		$array['11'] = 'Como afliarse';
		$array['12'] = 'Promoción y contactos comerciales';
		$array['13'] = 'Eventos';
		$array['14'] = 'Acuerdos Comerciales Inicio';
		$array['15'] = 'Acuerdos Comerciales';
		$array['16'] = 'Otros Servicios';
		$array['17'] = 'Informe de gestion';
		$array['18'] = 'Publicaciones y Comunicaciones';
		$array['19'] = "Regulaciones y Normas";
		$array['20'] = "Miembros";
		$array['21'] = "Regimen";
		$array['22'] = "Importación y Exportación Inicio";
		$array['23'] = "Importación";
		$array['24'] = "INFORMACIÓN Importación Exportación";
		$array['25'] = "Exportación";
		$array['26'] = "SIPPO";
		$array['28'] = "TLC Colombia EFTA";
		$array['29'] = "Inversión Suiza en Colombia";
		return $array;
	}


	/**
     * Genera los valores del campo Estado.
     *
     * @return array cadena con los valores del campo Estado.
     */
	private function getContenidosestado()
	{
		$array = array();
		$array['1'] = 'Activo';
		$array['2'] = 'Inactivo';
		return $array;
	}


	/**
     * Genera los valores del campo Color Fondo.
     *
     * @return array cadena con los valores del campo Color Fondo.
     */
	private function getContenidoscolor()
	{
		$array = array();
		$array['1'] = 'Negro';
		$array['2'] = 'Rojo';
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
            if ($filters->contenidos_fecha != '') {
                $filtros = $filtros." AND contenidos_fecha LIKE '%".$filters->contenidos_fecha."%'";
            }
            if ($filters->contenidos_seccion != '') {
                $filtros = $filtros." AND contenidos_seccion ='".$filters->contenidos_seccion."'";
            }
            if ($filters->contenidos_estado != '') {
                $filtros = $filtros." AND contenidos_estado ='".$filters->contenidos_estado."'";
            }
            if ($filters->contenidos_titulo != '') {
                $filtros = $filtros." AND contenidos_titulo LIKE '%".$filters->contenidos_titulo."%'";
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
					$parramsfilter['contenidos_fecha'] =  $this->_getSanitizedParam("contenidos_fecha");
					$parramsfilter['contenidos_seccion'] =  $this->_getSanitizedParam("contenidos_seccion");
					$parramsfilter['contenidos_estado'] =  $this->_getSanitizedParam("contenidos_estado");
					$parramsfilter['contenidos_titulo'] =  $this->_getSanitizedParam("contenidos_titulo");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}