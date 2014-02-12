<div class="cru">
	<div class="btn-options">
		<?php echo $this->Html->link('<i class="glyphicon glyphicon-list icon-white"></i>&nbsp;' . __('Back to List'), array('action' => 'index', 'admin' => true), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>	
	</div>
	<?php echo $this->Form->create('AttributeOption'); ?>
	<fieldset>
		<legend><?php echo __d('attributes', 'Add Attribute Option'); ?></legend>
		<div class="col-md-3">
			<?php
			echo $this->Form->input('attribute_type_id');
			echo $this->Form->input('code');
			?>
		</div>
	</fieldset>
	<?php echo $this->Form->end(array('label' => __('Save'), 'class' => 'btn btn-primary')); ?>
</div>

