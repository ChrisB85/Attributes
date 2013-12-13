<div class="border">
	<?php echo $this->Form->create('Attribute'); ?>
	<fieldset class="">
		<legend><?php echo __('Attributes Data'); ?></legend>
		<?php echo $this->Attribute->inputs($attrs); ?>
	</fieldset>
	<div>
		<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary')); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>
