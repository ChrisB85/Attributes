<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP AttributeComponent
 * @author William Alarcon
 */
class AttributeComponent extends Component {

	public $components = array('Attributes.Session');
	private $controller;
	public $Attribute;
	public $uses = array('AttributeType', 'Attribute', 'Entity');

	public function __construct(ComponentCollection $collection, $settings = array()) {

		$this->controller = $collection->getController();
		$this->controller->loadModel('Attributes.AttributeType');
	}

//	public function initialize(Controller $controller) {
//		
//	}
//
//	public function startup($controller) {
//		
//	}
//
//	public function beforeRender($controller) {
//		
//	}
//
//	public function shutDown($controller) {
//		
//	}
//
//	public function beforeRedirect($controller, $url, $status = null, $exit = true) {
//		
//	}

	/*
	 * Developer: William Alarcon
	 * Description: Función para ser llamada desde toda la aplicación con el fin de obtener el listado de los tipos de atributos
	 * Parameters: entity_alias es el alias de la entidad 
	 */

	public function getTypes($entity_alias = null, $moment = 'create', $attributes = false) {
		if (!$attributes) {
			$this->controller->AttributeType->unbindModel(
				array('hasMany' => array('Attribute'))
			);
		}
		$Typeattributes = $this->controller->AttributeType->find('all', array(
			'order' => array('ordering' => 'asc'),
			'fields' => array('AttributeType.*'),
			'conditions' => array('Entity.alias' => $entity_alias, 'AttributeType.moment' => $moment),
			'recursive' => 1
			)
		);
		return $Typeattributes;
	}

	/*
	 * Developer: William Alarcon
	 * Description: Función para validar los direntes tipos de atributos
	 * 
	 */

	public function validate($validates = null, $request = null) {
		$this->controller->loadModel('Attributes.AttributeType');
		foreach ($validates as $validated) {
			$name = $validated['AttributeType']['id'];
			$rule = $validated['AttributeType']['regexp_validation'];
			if ($validated['AttributeType']['input_type'] == 4 && $rule = 'notempty') {
				$this->controller->AttributeType->validate[$name] = array(
					'rule' => array('multiple', array(
							'min' => 1,
							'message' => $validated['AttributeType']['message'],
					)),
				);
			} else {
				if ($rule == 'url') {
					if (!empty($this->controller->request->data['AttributeType'][$name])) {
						$this->controller->AttributeType->validate[$name] = array(
							'regexp' => array(
								'rule' => $rule,
								'message' => $validated['AttributeType']['message'],
							),
						);
					}
				} else {
					$this->controller->AttributeType->validate[$name] = array(
						'regexp' => array(
							'rule' => $rule,
							'message' => $validated['AttributeType']['message'],
						),
					);
				}
			}
		}
		$this->controller->AttributeType->set($request);

		if ($this->controller->AttributeType->validates()) {
			return true;
		} else {
			return false;
		}
	}

	/*
	 * Developer: William Alarcon
	 * Description: Guardar los atributos 
	 * Parameters:Atributos es el reques action de la vista y parent_entityid es el id al que se le va asignar los atributos
	 * 
	 */

	public function saveAll($attributes = array(), $parent_entityid = null) {
		$this->controller->loadModel('Attributes.Attribute');

		foreach ($attributes as $key => $value) {
			if (is_array($value)) {
				$value_input = '';
				foreach ($value as $field) {
					$value_input.=$field . ',';
				}
				$this->controller->Attribute->create(
					array(
						'parent_entityid' => $parent_entityid,
						'attribute_type_id' => $key,
						'value' => trim($value_input, ','),
					)
				);
				$this->controller->Attribute->save();
			} else {
				$this->controller->Attribute->create(
					array(
						'parent_entityid' => $parent_entityid,
						'attribute_type_id' => $key,
						'value' => $value,
					)
				);
				$this->controller->Attribute->save();
			}
		}
	}

	/*
	 * Developer: William Alarcon
	 * Description: Obtener los registros de atributos 
	 * Parameters: id es el id del los atributos a traer, entity_alias es el alias de la entidad 
	 * 
	 */

	public function getSaved($id = null, $entity_alias = null, $moment = 'create') {

		$this->controller->loadModel('Attributes.Entity');

		$id_entity = $this->controller->Entity->find('first', array(
			'fields' => array('id'),
			'conditions' => array('Entity.alias' => $entity_alias),
			'recursive' => -1
			)
		);


		if (!empty($id_entity)) {
			$this->controller->AttributeType->bindModel(array('belongsTo' => array('Entity')));
			$attributes_register = $this->controller->AttributeType->Attribute->find('all', array(
				'fields' => 'Attribute.*',
				'conditions' => array(
					'Attribute.parent_entityid' => $id,
					'AttributeType.entity_id' => $id_entity['Entity']['id']
				),
				'recursive' => 2,
				)
			);


			$attributes = $this->getTypes($entity_alias, $moment, true);
			/* --- SET ATTRIBUTS ---- */
			$attr = array(
				'AttributeType' => array(),
				'Attribute' => array(),
			);
			foreach ($attributes as $attributes_type) {
				foreach ($attributes_register as $attribute) {
					if ($attributes_type['AttributeType']['input_type'] == 4) {
						$select_option = explode(',', $attribute['Attribute']['value']);
						foreach ($select_option as $key => $value) {
							$attr['AttributeType'][$attributes_type['AttributeType']['id']][] = $value;
						}
					} else {
						if ($attributes_type['AttributeType']['id'] == $attribute['Attribute']['attribute_type_id']) {
							if (!isset($attr['AttributeType'][$attributes_type['AttributeType']['id']])) {
								$attr['AttributeType'][$attributes_type['AttributeType']['id']] = $attribute['Attribute']['value'] . ', ';
							} else {
								$attr['AttributeType'][$attributes_type['AttributeType']['id']] .= $attribute['Attribute']['value'] . ', ';
							}
						}
					}
				}
				if (isset($attr['AttributeType'][$attributes_type['AttributeType']['id']]) && $attributes_type['AttributeType']['input_type'] != 4) {
					$attr['AttributeType'][$attributes_type['AttributeType']['id']] = trim($attr['AttributeType'][$attributes_type['AttributeType']['id']], ', ');
				}
			}

			return $attr;
		} else {
			return 'Entity alias no found';
		}
	}

	/*
	 * Developer: William Alarcon
	 * Description: Guardar los atributos 
	 * Parameters:Atributos es el reques action de la vista y parent_entityid es el id al que se le va asignar los atributos
	 * 
	 */

	public function edit($attributes = array(), $parent_entityid = null, $entity_alias = null) {
		$this->controller->loadModel('Attributes.AttributeType');
		$this->controller->loadModel('Attributes.Attribute');
		$this->controller->loadModel('Attributes.Entity');



		$id_entity = $this->controller->Entity->find('first', array(
			'fields' => array('id'),
			'conditions' => array('Entity.alias' => $entity_alias),
			'recursive' => -2
			)
		);

		if (!empty($id_entity)) {

			$this->controller->Attribute->deleteAll(array(
				'Attribute.parent_entityid' => $parent_entityid,
				'AttributeType.entity_id' => $id_entity['Entity']['id']
				)
			);
			foreach ($attributes as $key => $value) {

				$is_multiple = $this->controller->AttributeType->find('first', array(
					'recursive' => 0,
					'fields' => array('AttributeType.is_multiple'),
					'conditions' => array('AttributeType.id' => $key),
					));

				if ($is_multiple['AttributeType']['is_multiple']) {
					$this->controller->Attribute->create(
						array(
							'parent_entityid' => $parent_entityid,
							'attribute_type_id' => $key,
							'value' => $value,
						)
					);
					$this->controller->Attribute->save();
				} else {
					if (is_array($value)) {
						$value_input = '';
						foreach ($value as $field) {
							$value_input.=$field . ',';
						}
						$this->controller->Attribute->create(
							array(
								'parent_entityid' => $parent_entityid,
								'attribute_type_id' => $key,
								'value' => trim($value_input, ','),
							)
						);
						$this->controller->Attribute->save();
					} else {
						$this->controller->Attribute->create(
							array(
								'parent_entityid' => $parent_entityid,
								'attribute_type_id' => $key,
								'value' => $value,
							)
						);
						$this->controller->Attribute->save();
					}
				}
			}
		} else {
			return 'Entity alias no found';
		}
	}

	public function setAttributes($parent_entityid = null, $entity_alias = null, $fields = array()) {
		$this->controller->loadModel('ViewAttribute');
		return $this->controller->ViewAttribute->find('all', array(
				'order' => array('ordering' => 'desc'),
				'fields' => $fields,
				'contidions' => array('parent_entityid' => $parent_entityid, 'entity_alias' => $entity_alias)
				)
		);
	}

}
