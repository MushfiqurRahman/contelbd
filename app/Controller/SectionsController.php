<?php
App::uses('AppController', 'Controller');
/**
 * Sections Controller
 *
 * @property Section $Section
 */
class SectionsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Section->recursive = 0;
		$this->set('sections', $this->paginate());
	}
        
        /**
         * This method is used in outlets/add.ctp file. Though it may used in several other places
         */
        public function ajax_section_list(){
            $this->autoRender = $this->layout = false;
            $conditions = array();
            if( isset($_POST['representative_id']) && is_numeric($_POST['representative_id']) ){
                $conditions = !empty($_POST['representative_id']) ? array('Section.representative_id' => $_POST['representative_id']) : array();
                
            }else if( isset($_POST['house_id']) && is_numeric($_POST['house_id']) ){
                $conditions = array('Section.house_id' => $_POST['house_id']);
            }
            $sections = $this->Section->find('list', array('conditions' => $conditions));
            echo json_encode($sections);
        }
        
        /**
         * This function is used in Section add methods add.ctp file 
         */
        public function ajax_rep_list(){
            $this->layout = $this->autoRender = false;
            $rep_type = isset($_POST['rep_type']) ? $_POST['rep_type'] : null;
            $ss_id = isset($_POST['ss_id']) ? $_POST['ss_id']: 0;
            
            if( $this->request->is('ajax') ){
                if( isset($_POST['house_id']) ){      
                    
                    $repList = $this->Section->Representative->repList_with_mobile( $_POST['house_id'], $rep_type, $ss_id );
                    
                    echo json_encode($repList);
                }else{
                    echo json_encode(array('error' => 'Invalid house id!'));
                }
            }
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Section->exists($id)) {
			throw new NotFoundException(__('Invalid section'));
		}
		$options = array('conditions' => array('Section.' . $this->Section->primaryKey => $id));
		$this->set('section', $this->Section->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Section->create();
			if ($this->Section->save($this->request->data)) {
				$this->Session->setFlash(__('The section has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The section could not be saved. Please, try again.'));
			}
		}
		$houses = $this->Section->House->find('list');
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
		if (!$this->Section->exists($id)) {
			throw new NotFoundException(__('Invalid section'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Section->save($this->request->data)) {
				$this->Session->setFlash(__('The section has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The section could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Section.' . $this->Section->primaryKey => $id));
			$this->request->data = $this->Section->find('first', $options);
                        
                        $this->set('ssList',$this->Section->Representative->repList_with_mobile(
                                $this->request->data['Section']['house_id'], 'ss'));
                        
                        $this->set('srList',$this->Section->Representative->repList_with_mobile(
                                $this->request->data['Section']['house_id'], 'sr', $this->request->data['Section']['ss_id']));
                        
                        $this->set('tsaList',$this->Section->Representative->repList_with_mobile(
                                $this->request->data['Section']['house_id'], 'tsa'));
                        
		}
		$houses = $this->Section->House->find('list');                
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
		$this->Section->id = $id;
		if (!$this->Section->exists()) {
			throw new NotFoundException(__('Invalid section'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Section->delete()) {
			$this->Session->setFlash(__('Section deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Section was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
