<?php
$dbTab = UseOfDbIndex();
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Panel administracyjny',
				'Wykorzystanie indeksów w bazie danych',
			)
		) ?>
   </div>
   <div class="card-body">

      <table class="table table-hover table-condensed">
         <tr>
            <th width="40px">#</th>
            <th>Tabela</th>
            <th>Typ</th>
            <th>Last id</th>
            <th colspan="2">Wykorzystanie</th>
         </tr>

			<?php
			$i = 0;
			foreach ($dbTab AS $tab) {
				$style = ($tab['usage'] > 80) ? 'bg-danger' : 'bg-success';
				$tab['quant'] = $tab['quant'] == null ? 0 : $tab['quant'] ;
				$i++;
				?>

            <tr class="table-sm">
               <td><?= $i ?></td>
               <td><?= $tab['name'] ?></td>
               <td><?= $tab['colType'] ?></td>
               <td><?= $tab['quant'] ?></td>
               <td width="20px"><?= $tab['usage'] ?>%</td>
               <td width="160px">
                  <div class="progress" style="height: 20px; width: 150px">
                     <div class="progress-bar <?= $style ?>" role="progressbar" style="width: <?= $tab['usage'] ?>%">
                     </div>
                  </div>
               </td>
            </tr>

			<?php } ?>

      </table>

   </div>
</div>