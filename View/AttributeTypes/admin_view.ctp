<div class="cru">
	<div class="btn-options">
		<?php echo $this->Html->link('<i class="icon-list icon-white"></i>&nbsp;' . __('Back to List'), array('action' => 'index', 'admin' => true), array('class' => 'btn btn-primary', 'escape' => FALSE)); ?>	
	</div>
	<h2><?php __d('attributes','Attribute Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo $attributeType['AttributeType']['id']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo $attributeType['AttributeType']['code']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Regexp Validation'); ?></dt>
		<dd>
			<?php echo $attributeType['AttributeType']['regexp_validation']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ordering'); ?></dt>
		<dd>
			<?php echo $attributeType['AttributeType']['ordering']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Public'); ?></dt>
		<dd>
			<?php
			if ($attributeType['AttributeType']['is_public'] == 1) {
				echo __('Yes', true);
			} else {
				echo __('Not', true);
			}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Multiple'); ?></dt>
		<dd>
			<?php
			if ($attributeType['AttributeType']['is_multiple'] == 1) {
				echo __('Yes', true);
			} else {
				echo __('Not', true);
			}
			?>			
			&nbsp;
		</dd>
		<dt><?php echo __('Is Required'); ?></dt>
		<dd>
			<?php
			if ($attributeType['AttributeType']['is_required'] == 1) {
				echo __('Yes', true);
			} else {
				echo __('Not', true);
			}
			?>			
			&nbsp;
		</dd>
	</dl>
</div>


