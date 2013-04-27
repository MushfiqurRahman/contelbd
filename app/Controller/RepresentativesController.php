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
	public function index() {
		$this->Representative->recursive = 0;
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
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Representative->create();
			if ($this->Representative->save($this->request->data)) {
				$this->Session->setFlash(__('The representative has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The representative could not be saved. Please, try again.'));
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
			if ($this->Representative->save($this->request->data)) {
				$this->Session->setFlash(__('The representative has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The representative could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Representative.' . $this->Representative->primaryKey => $id));
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
}
