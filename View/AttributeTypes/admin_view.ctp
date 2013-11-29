<div class="container-admin">
	<div class="span3 well">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Ajs->link('<i class="icon-th-list"></i>' . __('List Attribute Types', true), array('action' => 'index', 'admin' => true), '', '#primary-ajax'); ?></li></ul>
	</div>
	<div class="span9">
		<h2><?php __('Attribute Type'); ?></h2>
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
</div>

