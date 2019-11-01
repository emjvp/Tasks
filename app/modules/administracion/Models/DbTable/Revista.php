<?php 
/**
* clase que genera la insercion y edicion  de Revista en la base de datos
*/
class Administracion_Model_DbTable_Revista extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'revista';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'revista_id';

	/**
	 * insert recibe la informacion de un Revista y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$revista_titulo = $data['revista_titulo'];
		$revista_imagen = $data['revista_imagen'];
		$revista_introduccion = $data['revista_introduccion'];
		$revista_descripcion = $data['revista_descripcion'];
		$revista_pdf = $data['revista_pdf'];
		$query = "INSERT INTO revista( revista_titulo, revista_imagen, revista_introduccion, revista_descripcion, revista_pdf) VALUES ( '$revista_titulo', '$revista_imagen', '$revista_introduccion', '$revista_descripcion', '$revista_pdf')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Revista  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$revista_titulo = $data['revista_titulo'];
		$revista_imagen = $data['revista_imagen'];
		$revista_introduccion = $data['revista_introduccion'];
		$revista_descripcion = $data['revista_descripcion'];
		$revista_pdf = $data['revista_pdf'];
		$query = "UPDATE revista SET  revista_titulo = '$revista_titulo', revista_imagen = '$revista_imagen', revista_introduccion = '$revista_introduccion', revista_descripcion = '$revista_descripcion', revista_pdf = '$revista_pdf' WHERE revista_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}