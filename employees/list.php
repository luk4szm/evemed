<?php
parse_str($_SERVER['QUERY_STRING'], $output);
if (!empty($output)) {
	switch ($output['list']) {
		case 'dismissed':
			$where = "hired = 0";
			$title = "Byli pracownicy";
			break;
		default:
			$where = "hired = 1";
			$title = "Lista";
			break;
	}
} else {
	$where = "hired = 1";
	$title = "Lista";
}

$employees = EmployeeList($where, 'ID ASC');
$k = 0;
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Kadra',
				$title
			)
		) ?>
   </div>
   <div class="card-body">

		<?php
		if (substr($employees['code'], 0, 1) == 2) {
			if ($employees['list_count'] > 0) {
				?>

            <table class="table table-condensed">

               <tr>
                  <th>#</th>
                  <th>Pracownik</th>
                  <th>E-mail</th>
                  <th>Telefon</th>
                  <th class="min-width"></th>
               </tr>

					<?php
					for ($i = 0; $i < $employees['list_count']; $i++) {
						$emp = $employees['result'][$i];
						?>
                  <tr class="table-sm">
                     <td>
								<?= ++$k ?>
                     </td>
                     <td class="f500">
								<?= $emp['full_name'] ?>
                     </td>
                     <td>
                        &#9993; <a href="mailto:<?= $emp['email'] ?>"><?= $emp['email'] ?></a>
                     </td>
                     <td>
                        &#9990; <a href="tel:<?= $emp['mobile_nr'] ?>"><?= FormatNrTel($emp['mobile_nr']) ?></a>
                     </td>
                     <td>
                        <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
                     </td>
                  </tr>
					<?php } ?>

            </table>

				<?php
			} else {
				ShowSimpleInfo('Lista jest pusta.');
			}
		} else {
			ShowSimpleInfo($employees['txt']);
		}
		?>

   </div>
   <div class="card-footer text-muted text-right">
      Wyświetlono wyników: <span class="f500"><?= $k ?></span>
   </div>
</div>