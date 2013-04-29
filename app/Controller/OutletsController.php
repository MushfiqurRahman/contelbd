<?php
App::uses('AppController', 'Controller');
/**
 * Outlets Controller
 *
 * @property Outlet $Outlet
 */
class OutletsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Outlet->recursive = 0;
		$this->set('outlets', $this->paginate());
	}
        
        /**
         * 
         */
        public function ajax_outlet_list(){
            $this->autoRender = $this->layout = false;
            if( !empty($_POST['house_id']) ){
                $_POST['house_id'] = str_replace('\"', '"', $_POST['house_id']);
            }
            
            if( !empty($_POST['house_id']) && !empty($_POST['section_id']) ){
                $conditions = array('Outlet.house_id' => unserialize($_POST['house_id']), 'Outlet.section_id' => $_POST['section_id']);
            }else if( !empty($_POST['house_id']) ){
                $conditions = array('Outlet.house_id' => unserialize($_POST['house_id']));
            }else if( !empty($_POST['section_id']) ){
                $conditions = array('Outlet.section_id' => $_POST['section_id']);
            }else{
                $conditions = array();
            }           
            $outlets = $this->Outlet->find('list', array('conditions' => $conditions));
            echo json_encode($outlets);
            
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Outlet->exists($id)) {
			throw new NotFoundException(__('Invalid outlet'));
		}
		$options = array('conditions' => array('Outlet.' . $this->Outlet->primaryKey => $id));
		$this->set('outlet', $this->Outlet->find('first', $options));
	}
        
        /**
         * 
         */
        protected function _check_mobile_nos(){
                                    
            if( !empty($this->request->data['Outlet']['phone_no']) ){
                if( strpos($this->request->data['Outlet']['phone_no'], '88')!==0 ){
                    $this->request->data['Outlet']['phone_no'] = '88'.$this->request->data['Outlet']['phone_no'];
                }
            }
        }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                    $this->_check_mobile_nos();
			$this->Outlet->create();
                        
			if ($this->Outlet->save($this->request->data)) {
				$this->Session->setFlash(__('The outlet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outlet could not be saved. Please, try again.'));
			}
		}
		$sections = $this->Outlet->Section->find('list');
		$houses = $this->Outlet->House->find('list');
		$this->set(compact('sections', 'houses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Outlet->exists($id)) {
			throw new NotFoundException(__('Invalid outlet'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    $this->_check_mobile_nos();
			if ($this->Outlet->save($this->request->data)) {
				$this->Session->setFlash(__('The outlet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outlet could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Outlet.' . $this->Outlet->primaryKey => $id));
			$this->request->data = $this->Outlet->find('first', $options);
		}
		$sections = $this->Outlet->Section->find('list');
		$houses = $this->Outlet->House->find('list');
		$this->set(compact('sections', 'houses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Outlet->id = $id;
		if (!$this->Outlet->exists()) {
			throw new NotFoundException(__('Invalid outlet'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Outlet->delete()) {
			$this->Session->setFlash(__('Outlet deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Outlet was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
