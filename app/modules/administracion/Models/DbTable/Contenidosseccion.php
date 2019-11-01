<?php 
/**
* clase que genera la insercion y edicion  de Administrar Acuerdos Comerciales en la base de datos
*/
class Administracion_Model_DbTable_Contenidosseccion extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'contenidos_seccion';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'contenidos_sec_id';

	/**
	 * insert recibe la informacion de un Acuerdos Comerciales y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$contenidos_sec_titulo = $data['contenidos_sec_titulo'];
		$contenidos_sec_descripcion = $data['contenidos_sec_descripcion'];
		$seccion_id = $data['seccion_id'];
		$contenidos_sec_imagen = $data['contenidos_sec_imagen'];
		$query = "INSERT INTO contenidos_seccion( contenidos_sec_titulo, contenidos_sec_descripcion, seccion_id, contenidos_sec_imagen) VALUES ( '$contenidos_sec_titulo', '$contenidos_sec_descripcion', '$seccion_id', '$contenidos_sec_imagen')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Acuerdos Comerciales  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$contenidos_sec_titulo = $data['contenidos_sec_titulo'];
		$contenidos_sec_descripcion = $data['contenidos_sec_descripcion'];
		$seccion_id = $data['seccion_id'];
		$contenidos_sec_imagen = $data['contenidos_sec_imagen'];
		$query = "UPDATE contenidos_seccion SET  contenidos_sec_titulo = '$contenidos_sec_titulo', contenidos_sec_descripcion = '$contenidos_sec_descripcion', seccion_id = '$seccion_id', contenidos_sec_imagen = '$contenidos_sec_imagen' WHERE contenidos_sec_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}