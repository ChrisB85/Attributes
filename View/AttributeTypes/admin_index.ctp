
<div class="span3 well">
	<ul class="nav nav-list">
		<li class="nav-header"><?php echo __('Actions'); ?></li>		
		<li><?php echo $this->Html->link('<i class="icon-plus-sign"></i>&nbsp;' . __('New Attribute Type'), array('action' => 'add', 'admin' => true), array('escape' => FALSE)); ?></li>
	</ul>
</div>
<div class="span8">
	<h2><?php echo __('Attribute Types'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('regexp_validation'); ?></th>
			<th><?php echo $this->Paginator->sort('ordering'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($attributeTypes as $attributeType): ?>
			<tr>
				<td><?php echo $attributeType['AttributeType']['id']; ?>&nbsp;</td>
				<td><?php echo $attributeType['AttributeType']['code']; ?>&nbsp;</td>
				<td><?php echo $attributeType['AttributeType']['regexp_validation']; ?>&nbsp;</td>
				<td><?php echo $attributeType['AttributeType']['ordering']; ?>&nbsp;</td>
				<td class="actions">
					<div class="btn-group">						
						<?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $attributeType['AttributeType']['id']), array('escape' => FALSE, 'class' => 'btn')) ?>                            
						<?php echo $this->Html->link('<i class="icon-eye-open"></i>', array('action' => 'view', $attributeType['AttributeType']['id']), array('escape' => FALSE, 'class' => 'btn')) ?>					
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<div class="pagination pagination-centered">
		<ul>
			<?php echo $this->Paginator->prev('<', array('tag' => 'li',), NULL, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled')); ?>
			<?php echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
			<?php echo $this->Paginator->next('>', array('tag' => 'li',), NULL, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled')); ?>
		</ul>
	</div>
</div>
