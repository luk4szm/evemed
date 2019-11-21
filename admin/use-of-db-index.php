<?php

$intTypes = array(
	'tinyint' => pow(2, 7) - 1,
	'smallint' => pow(2, 15) - 1,
	'mediumint' => pow(2, 23) - 1,
	'int' => pow(2, 31) - 1,
	'bigint' => pow(2, 63) - 1,
);

$sql = "SHOW TABLES FROM " . $dbName;
$res = MysqliQuery($sql);

$i = 0;
$dbTab = array();
while ($obj = mysqli_fetch_assoc($res)) {
	$tabName = $obj['Tables_in_' . $dbName];

	$sql = "SHOW FIELDS
           FROM " . $dbName . '.' . $tabName . "
           WHERE Field = 'ID'";
	$tab = mysqli_fetch_assoc(MysqliQuery($sql));
	$tab['Type'] = explode('(', $tab['Type']);
	$tab['name'] = $tabName;
	$tab['colType'] = $tab['Type'][0];
	$tab['colLeng'] = substr($tab['Type'][1], 0, -1);

	$sql = "SELECT MAX(ID) AS quant
           FROM " . $dbName . '.' . $tabName;
	$qua = mysqli_fetch_assoc(MysqliQuery($sql));
	$tab['quant'] = $qua['quant'];
	$tab['usage'] = number_format(100 * $qua['quant'] / $intTypes[$tab['colType']], 2, ".", " ");

	array_push($dbTab, $tab);
}

array_multisort(
	array_column($dbTab, 'usage'), SORT_DESC,
	array_column($dbTab, 'quant'), SORT_DESC,
	$dbTab
)

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
            <th>Last ID</th>
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