<div class="span3 well">
	<ul class="nav nav-list">
		<li class="nav-header"><?php echo __('Actions'); ?></li>
		<li><?php echo $this->Html->link('<i class="icon-th-list"></i>&nbsp;' . __('List Attribute Options'), array('action' => 'index', 'admin' => true), array('escape' => FALSE)); ?></li>
	</ul>
</div>
<div class="span8">
	<?php echo $this->Form->create('AttributeOption'); ?>
	<fieldset>
		<legend><?php echo __('Add Attribute Option'); ?></legend>
		<?php
		echo $this->Form->input('attribute_type_id');
		echo $this->Form->input('code');
		?>
	</fieldset>
	<?php echo $this->Form->end(array('label' => __('Add'), 'class' => 'btn btn-primary')); ?>
</div>

