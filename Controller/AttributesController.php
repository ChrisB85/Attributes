<?php

class AttributesController extends AttributesAppController {

	var $name = 'Attributes';

	public function beforeFilter() {
		parent::beforeFilter();
		if (Configure::read('debug') > 1) {
			$this->Auth->allow();
		}
	}

	public function edit($parant_entityid = null, $entity_alias = null, $plugin = null, $controller=null, $action=null,$admin=false) {

		$attr = $this->Attribute->getTypes('user');
		$this->set('attrs', $attr);
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Attribute->validate($attr, $this->request->data)) {
				$this->Attribute->edit($this->request->data['AttributeType'], $parant_entityid, $entity_alias);
				if ($plugin != null) {
					$this->redirect(array('plugin' => $plugin, 'controller' => $controller, 'action' => $action,'admin'=>$admin));
				} else {
					$this->redirect(array('controller' => $controller, 'action' => $action,'admin'=>$admin));
				}
			}
		} else {
			$this->request->data = $this->Attribute->getSaved($parant_entityid, $entity_alias);
		}
	}

}

?>