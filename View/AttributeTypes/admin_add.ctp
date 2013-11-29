<div class="span3 well">
	<ul class="nav nav-list">
		<li class="nav-header"><?php echo __('Actions'); ?></li>		
		 <li><?php echo $this->Html->link('<i class="icon-th-list"></i>&nbsp;' . __('List Attribute Types'), array('action' => 'index', 'admin' => true), array('escape' => FALSE)); ?></li>
	</ul>
</div>
<div class="span8">
	<?php echo $this->Form->create('AttributeType'); ?>
	<fieldset>
		<legend><?php echo __('Add Attribute Type'); ?></legend>
		<?php
		echo $this->Form->input('entity_id');
		echo $this->Form->input('code');
		echo $this->Form->input('regexp_validation');
		echo $this->Form->input('message');
		echo $this->Form->input('ordering');
		echo $this->Form->input('is_public');
		echo $this->Form->input('is_multiple');
		echo $this->Form->input('is_required');
		echo $this->Form->input('use_option');
		echo $this->Form->input('input_type',array('type'=>'select','options'=>array('1'=>'Input text','2'=>'Input select','3'=>'Input radio','4'=>'Input checkbox')));
		echo $this->Form->input('moment',array('type'=>'select','options'=>array('create'=>__('Created'),'update'=>__('Update'),'both'=>__('Both'))));
		?>
	</fieldset>	
	<?php echo $this->Form->end(array('label' => __('Add'), 'class' => 'btn btn-primary')); ?>
</div>
