<?php

App::uses('AppController', 'Controller');

/**
 * AttributeOptions Controller
 *
 * @property AttributeOption $AttributeOption
 * @property PaginatorComponent $Paginator
 */
class AttributeOptionsController extends AttributesAppController {

	public function beforeFilter() {
		parent::beforeFilter();
		if (Configure::read('debug') > 1) {
			$this->Auth->allow();
		}
	}

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');

	/**
	 * index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->AttributeOption->recursive = 0;
		$this->set('attributeOptions', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		if (!$this->AttributeOption->exists($id)) {
			throw new NotFoundException(__d('attributes','Invalid attribute option'));
		}
		$options = array('conditions' => array('AttributeOption.' . $this->AttributeOption->primaryKey => $id));
		$this->set('attributeOption', $this->AttributeOption->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AttributeOption->create();
			if ($this->AttributeOption->save($this->request->data)) {
				$this->Session->setFlash(__d('attributes','The attribute option has been saved.'), 'flash/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('attributes','The attribute option could not be saved. Please, try again.'), 'flash/warning');
			}
		}
		$attributeTypes = $this->AttributeOption->AttributeType->find('list', array('fields' => array('id', 'code')
			)
		);
		$this->set(compact('attributeTypes'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		if (!$this->AttributeOption->exists($id)) {
			throw new NotFoundException(__d('attributes','Invalid attribute option'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AttributeOption->save($this->request->data)) {
				$this->Session->setFlash(__d('attributes','The attribute option has been saved.'), 'flash/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('attributes','The attribute option could not be saved. Please, try again.'), 'flash/warning');
			}
		} else {
			$options = array('conditions' => array('AttributeOption.' . $this->AttributeOption->primaryKey => $id));
			$this->request->data = $this->AttributeOption->find('first', $options);
		}
		$attributeTypes = $this->AttributeOption->AttributeType->find('list', array('fields' => array('id', 'code')));
		$this->set(compact('attributeTypes'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		$this->AttributeOption->id = $id;
		if (!$this->AttributeOption->exists()) {
			throw new NotFoundException(__d('attributes','Invalid attribute option'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AttributeOption->delete()) {
			$this->Session->setFlash(__d('attributes','The attribute option has been deleted.'), 'flash/success');
		} else {
			$this->Session->setFlash(__d('attributes','The attribute option could not be deleted. Please, try again.'), 'flash/warning');
		}
		return $this->redirect(array('action' => 'index'));
	}

}
