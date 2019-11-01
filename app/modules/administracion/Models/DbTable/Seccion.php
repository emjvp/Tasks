<?php 
/**
* clase que genera la insercion y edicion  de seccion acuerdos comercaiales en la base de datos
*/
class Administracion_Model_DbTable_Seccion extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'seccion';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'seccion_id';

	/**
	 * insert recibe la informacion de un Acuerdos Comerciales y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$seccion_titulo = $data['seccion_titulo'];
		$seccion_descripcion = $data['seccion_descripcion'];
		$seccion_imagen = $data['seccion_imagen'];
		$query = "INSERT INTO seccion( seccion_titulo, seccion_descripcion, seccion_imagen) VALUES ( '$seccion_titulo', '$seccion_descripcion', '$seccion_imagen')";
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
		
		$seccion_titulo = $data['seccion_titulo'];
		$seccion_descripcion = $data['seccion_descripcion'];
		$seccion_imagen = $data['seccion_imagen'];
		$query = "UPDATE seccion SET  seccion_titulo = '$seccion_titulo', seccion_descripcion = '$seccion_descripcion', seccion_imagen = '$seccion_imagen' WHERE seccion_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}