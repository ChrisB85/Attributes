<?php if (isset($authuser['Group']['name']) && $authuser['Group']['name'] == 'superadmin'): ?>
	<li class="dropdown-submenu">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=" icon-th-list"></i>&nbsp;<?php echo __('Attributes') ?><b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><?php echo $this->Html->link(__('Attribute Types'), array('controller' => 'AttributeTypes', 'action' => 'index', 'admin' => TRUE, 'plugin' => 'attributes')); ?></li>
			<li><?php echo $this->Html->link(__('Attribute Options'), array('controller' => 'AttributeOptions', 'action' => 'index', 'admin' => TRUE, 'plugin' => 'attributes')); ?></li>

		</ul>
	</li>
<?php endif; ?>