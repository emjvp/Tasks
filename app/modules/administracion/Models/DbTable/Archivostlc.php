<?php 
/**
* clase que genera la insercion y edicion  de archivostlc en la base de datos
*/
class Administracion_Model_DbTable_Archivostlc extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'archivostlc';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'archivostlc_id';

	/**
	 * insert recibe la informacion de un archivostlc y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$archivostlc_titulo = $data['archivostlc_titulo'];
		$archivostlc_archivo = $data['archivostlc_archivo'];
		$query = "INSERT INTO archivostlc( archivostlc_titulo, archivostlc_archivo) VALUES ( '$archivostlc_titulo', '$archivostlc_archivo')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un archivostlc  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$archivostlc_titulo = $data['archivostlc_titulo'];
		$archivostlc_archivo = $data['archivostlc_archivo'];
		$query = "UPDATE archivostlc SET  archivostlc_titulo = '$archivostlc_titulo', archivostlc_archivo = '$archivostlc_archivo' WHERE archivostlc_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}