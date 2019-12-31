<?php 
/**
*
*/
class Page_indexController extends Page_mainController
{
	public function indexAction()
	{
        $tasksModel = new Page_Model_DbTable_Tasks();
        $this->_view->tasks = $tasksModel->getList("estado = 1");
		
	}
}