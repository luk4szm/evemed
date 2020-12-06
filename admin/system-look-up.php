<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Panel administracyjny',
				'$_SESSION',
			)
		) ?>
   </div>
   <div class="card-body">
		<?php
		echo '<pre>';
		print_r($_SESSION);
		echo '</pre>';
		?>
   </div>
</div>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Panel administracyjny',
				'$_COOKIE',
			)
		) ?>
   </div>
   <div class="card-body">
		<?php
		echo '<pre>';
		print_r($_COOKIE);
		echo '</pre>';
		?>
   </div>
</div>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Panel administracyjny',
				'$_SERVER',
			)
		) ?>
   </div>
   <div class="card-body">
		<?php
		echo '<pre>';
		print_r($_SERVER);
		echo '</pre>';
		?>
   </div>
</div>