<div class="attributeOptions view">
<h2><?php echo __d('attributes','Attribute Option'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($attributeOption['AttributeOption']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attribute Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attributeOption['AttributeType']['id'], array('controller' => 'attribute_types', 'action' => 'view', $attributeOption['AttributeType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Option'); ?></dt>
		<dd>
			<?php echo h($attributeOption['AttributeOption']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attribute Option'), array('action' => 'edit', $attributeOption['AttributeOption']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attribute Option'), array('action' => 'delete', $attributeOption['AttributeOption']['id']), null, __('Are you sure you want to delete # %s?', $attributeOption['AttributeOption']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attribute Options'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute Option'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attribute Types'), array('controller' => 'attribute_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute Type'), array('controller' => 'attribute_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
