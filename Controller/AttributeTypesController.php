<?php

class AttributeTypesController extends AttributesAppController {

	var $name = 'AttributeTypes';

	function beforeFilter() {
		parent::beforeFilter();
	}

	function admin_index() {
		$this->AttributeType->recursive = 2;
		$this->set('attributeTypes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('attributes','Invalid attribute type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attributeType', $this->AttributeType->read(null, $id));
	}

	function admin_add() {

		if ($this->request->is('post')) {
			$this->AttributeType->create();
			if ($this->AttributeType->save($this->data)) {

				$this->Session->setFlash(__d('attributes','The attribute type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('attributes','The attribute type could not be saved. Please, try again.'), 'flash/warning');
			}
		}
		$entities = $this->AttributeType->Entity->find('list');
		$this->set(compact('entities'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__d('attributes','Invalid attribute type', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AttributeType->save($this->request->data)) {
				$this->Session->setFlash(__d('attributes','The attribute type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d('attributes','The attribute type could not be saved. Please, try again.'), 'flash/warning');
			}
		} else {
			$options = array('conditions' => array('AttributeType.' . $this->AttributeType->primaryKey => $id));
			$this->request->data = $this->AttributeType->find('first', $options);
		}
		$entities = $this->AttributeType->Entity->find('list');
		$this->set(compact('entities'));
	}

	function admin_delete($id = null) {
		$this->AttributeType->id = $id;
		if (!$this->AttributeType->exists()) {
			throw new NotFoundException(__d('attributes','Invalid AttributeType'), 'flash/warning');
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AttributeType->delete()) {
			$this->Session->setFlash(__d('attributes','AttributeType deleted.'), 'flash/success');			
		} else {
			$this->Session->setFlash(__d('attributes','AttributeType was not deleted.'), 'flash/error');
		}

		$this->redirect(array('action' => 'index'));
	}

}

?>