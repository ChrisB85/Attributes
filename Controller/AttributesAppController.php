<?php

App::uses('AppController', 'Controller');

class AttributesAppController extends AppController {

	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Js' => array('Jquery'),
		'Documents.Ajs',
		'Paginator',
		'Text',
		'Attributes.Attribute',
	);
	public $components = array(
		'Email',
		'Paginator',
		'RequestHandler',
		'Session',
		'Attributes.Attribute',
				
	);

	public function beforeFilter() {
		parent::beforeFilter();
		if(Configure::read('debug') > 1) {
			$this->Auth->allow();
		}
	}

/*	public function isAuthorized($user) {

		return true;
	}*/

}
