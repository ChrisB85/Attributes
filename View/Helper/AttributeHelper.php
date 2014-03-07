<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppHelper', 'View/Helper');

class AttributeHelper extends AppHelper {

	public $helpers = array('Html', 'Session', 'Paginator', 'Js' => array('Jquery'), 'Form', 'Time');

	public function inputs($attributes = null, $options = array()) {

		$inputs = '';	
		foreach ($attributes as $attribute) {

			if (!$attribute['AttributeType']['use_option']) {
				if ($attribute['AttributeType']['is_multiple']) {
					$inputs .= $this->Form->input('AttributeType.' . $attribute['AttributeType']['id'], array('required' => $attribute['AttributeType']['is_required'], 'label' => __($attribute['AttributeType']['code']), 'div' => FALSE));
					$inputs .= '</br>' . 'Separe con coma los ' . $attribute['AttributeType']['code'];
				} else {
					$inputs.= $this->Form->input('AttributeType.' . $attribute['AttributeType']['id'], array('required' => $attribute['AttributeType']['is_required'], 'label' => __($attribute['AttributeType']['code'])));
				}
			} else {
				$options = array();

				foreach ($attribute['AttributeOption'] as $option) {
					$id = $option['id'];
					$options[$id] = $option['code'];
				}

				switch ($attribute['AttributeType']['input_type']) {
					case 1:
						if ($attribute['AttributeType']['is_multiple']) {
							$inputs.= $this->Form->input('AttributeType.' . $attribute['AttributeType']['id'], array('required' => $attribute['AttributeType']['is_required'], 'label' => __($attribute['AttributeType']['code']), 'div' => FALSE));
							$inputs.= '</br>' . 'Separe con coma los ' . $attribute['AttributeType']['code'];
						} else {
							if ($attribute['AttributeType']['use_option']) {
								foreach ($attribute['AttributeOption'] as $attr) {
									$inputs.= $this->Form->input('AttributeType.' . $attribute['AttributeType']['id'] . '.', array('required' => $attribute['AttributeType']['is_required'], 'label' => __($attr['code']), 'multiple' => 'checkbox'));
								}
							} else {
								$inputs.= $this->Form->input('AttributeType.' . $attribute['AttributeType']['id'], array('required' => $attribute['AttributeType']['is_required'], 'label' => __($attribute['AttributeType']['code'])));
							}
						}
						break;
					case 2:
						$inputs.= $this->Form->input('AttributeType.' . $attribute['AttributeType']['id'], array('label' => __($attribute['AttributeType']['code']), 'type' => 'select', 'options' => $options, 'div' => (empty($options['div'])) ? false : (bool) $options['label'], 'label' => (empty($options['label'])) ? false : (bool) $options['label']));
						break;
					case 3:
						$inputs.= $this->Form->input('AttributeType.' . $attribute['AttributeType']['id'], array('legend' => __($attribute['AttributeType']['code']), 'type' => 'radio', 'options' => $options));

						break;
					case 4:
						$inputs.= $this->Form->input('AttributeType.' . $attribute['AttributeType']['id'], array('label' => __($attribute['AttributeType']['code']), 'type' => 'select', 'options' => $options, 'multiple' => 'checkbox'));

						break;

					default:
						break;
				}
			}
		}

		return $inputs;
	}

}
?>

