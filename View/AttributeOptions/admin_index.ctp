<div class="attributes_options">
	<?php echo $this->Html->link('<i class="icon-plus-sign icon-white"></i>&nbsp;' . __d('attributes','New Attribute Option'), array('action' => 'add', 'admin' => true), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>
	<div>
		<h2><?php echo __d('attributes', 'Attribute Options'); ?></h2>
		<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
			<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('attribute_type_id'); ?></th>
				<th><?php echo $this->Paginator->sort('option'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($attributeOptions as $attributeOption): ?>
				<tr>
					<td><?php echo h($attributeOption['AttributeOption']['id']); ?>&nbsp;</td>
					<td>
						<?php echo $this->Html->link($attributeOption['AttributeType']['code'], array('controller' => 'attribute_types', 'action' => 'edit', $attributeOption['AttributeType']['id'])); ?>
					</td>
					<td><?php echo h($attributeOption['AttributeOption']['code']); ?>&nbsp;</td>
					<td class="actions">
						<div class="btn-group">
							<?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $attributeOption['AttributeOption']['id']), array('escape' => FALSE, 'class' => 'btn')) ?>                            						
							<?php
							echo $this->Form->postLink('<i class="icon-trash icon-white"></i>', array('action' => 'delete', $attributeOption['AttributeOption']['id']), array('class' => 'btn btn-danger', 'escape' => FALSE), __('Are you sure you want to delete # %s?', $attributeOption['AttributeOption']['code']));
							?>
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
</div>
