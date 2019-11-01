<?php 
/**
* clase que genera la insercion y edicion  de Informaci&oacute;n Contenido en la base de datos
*/
class Administracion_Model_DbTable_Quienessomos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'quenes_somos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'quienes_id';

	/**
	 * insert recibe la informacion de un Informaci&oacute;n Contenido y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$quienes_titulo = $data['quienes_titulo'];
		$quienes_descripcion = $data['quienes_descripcion'];
		$quienes_aliado = $data['quienes_aliado'];
		$query = "INSERT INTO quenes_somos( quienes_titulo, quienes_descripcion, quienes_aliado) VALUES ( '$quienes_titulo', '$quienes_descripcion', '$quienes_aliado')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Informaci&oacute;n Contenido  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$quienes_titulo = $data['quienes_titulo'];
		$quienes_descripcion = $data['quienes_descripcion'];
		$quienes_aliado = $data['quienes_aliado'];
		$query = "UPDATE quenes_somos SET  quienes_titulo = '$quienes_titulo', quienes_descripcion = '$quienes_descripcion', quienes_aliado = '$quienes_aliado' WHERE quienes_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}