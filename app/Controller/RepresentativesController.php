<?php
App::uses('AppController', 'Controller');
/**
 * Representatives Controller
 *
 * @property Representative $Representative
 */
class RepresentativesController extends AppController {

/**
 * index method
 *
 * @return void
 */
    //public $paginate = array('contain' => array('Mobile'));
    
	public function index() {
		//$this->Representative->recursive = 0;
            $this->Representative->Behaviors->load('Containable');
            $this->paginate = array('contain' => array('House' => array('fields' => array('id','title')),
                'Mobile' => array('fields' => array('mobile_no'))));
		$this->set('representatives', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Representative->exists($id)) {
			throw new NotFoundException(__('Invalid representative'));
		}
		$options = array('conditions' => array('Representative.' . $this->Representative->primaryKey => $id));
		$this->set('representative', $this->Representative->find('first', $options));
	}
        
        /**
         * Unset blank mobile_no field. Return true if at least one mobile no present. Otherwise false
         * @return boolean 
         */
        protected function _check_mobile_nos(){
            $mobile_found = false;
            foreach( $this->request->data['Mobile'] as $k => $v){                        
                if( empty($v['mobile_no']) ){
                    unset($this->request->data['Mobile'][$k]);
                }else{
                    $mobile_found = true;
                }
            }
            return $mobile_found;
        }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                    
                    $mobile_found = $this->_check_mobile_nos();                    
                    if( !$mobile_found ){
                        $this->Session->setFlash('Please give at least single mobile no. It\'s essential');
                    }else{
			$this->Representative->create();
			if ($this->Representative->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('The representative has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The representative could not be saved. Please, try again.'));
			}
                    }
		}
		$houses = $this->Representative->House->find('list');
		$this->set(compact('houses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Representative->exists($id)) {
			throw new NotFoundException(__('Invalid representative'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    
                    $mobile_found = $this->_check_mobile_nos();                    
                    if( !$mobile_found ){
                        $this->Session->setFlash('Please give at least single mobile no. It\'s essential');
                    }else{
                        //pr($this->request->data);exit;
			if ($this->Representative->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The representative has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The representative could not be saved. Please, try again.'));
			}
                    }
		} else {
                    $this->Representative->Behaviors->load('Containable');
			$options = array('conditions' => array('Representative.' . $this->Representative->primaryKey => $id),
                            'contain' => array('Mobile' => array('fields' => array('id','mobile_no'))), 'recursive' => -1);
                        
			$this->request->data = $this->Representative->find('first', $options);
		}
		$houses = $this->Representative->House->find('list');
		$this->set(compact('houses'));
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
		$this->Representative->id = $id;
		if (!$this->Representative->exists()) {
			throw new NotFoundException(__('Invalid representative'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Representative->delete()) {
			$this->Session->setFlash(__('Representative deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Representative was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        /**
         * To delete a specific mobile no 
         */
        public function delete_mobile(){
            $this->layout = $this->autoRender = false;
            
            if( $this->request->isAjax()){
                if( !empty($_POST['id']) ){
                    if( $this->Representative->Mobile->delete($_POST['id']) ){
                        echo 'success';
                    }else{
                        echo 'failure';
                    }
                }
            }
        }
}