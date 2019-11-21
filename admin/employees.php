<?php
$employees = EmployeeList(null, 'c.ID ASC');
$k = 0;
?>

<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Panel administracyjny',
				'Pracownicy',
			)
		) ?>
   </div>
   <div class="card-body">

		<?php
		if (substr($employees['code'], 0, 1) == 2) {
			if ($employees['list_count'] > 0) {
				?>

            <table class="table table-hover table-condensed">

               <tr>
                  <th>#</th>
                  <th>Login</th>
                  <th>Pracownik</th>
                  <th>E-mail</th>
                  <th>Telefon</th>
                  <th class="min-width"></th>
               </tr>

					<?php
					for ($i = 0; $i < $employees['list_count']; $i++) {
						$emp = $employees['result'][$i];
						?>
                  <tr class="table-sm" style="cursor: pointer;"
                      onclick="window.location='/patient.php?id=<?= $emp['ID'] ?>'">
                     <td>
								<?= ++$k ?>
                     </td>
                     <td class="f500">
                        <small>[ID: <?= $emp['ID'] ?>]</small> <?= $emp['login'] ?>
                     </td>
                     <td class="f500">
								<?= $emp['full_name'] ?>
                     </td>
                     <td>
                        &#9993; <a href="mailto:<?= $emp['email'] ?>"><?= $emp['email'] ?></a>
                     </td>
                     <td>
                        &#9990; <?= FormatNrTel($emp['mobile_nr']) ?>
                     </td>
                     <td>
                        <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
                     </td>
                  </tr>
					<?php } ?>

            </table>

				<?php
			} else {
				ShowSimpleInfo('Brak pacjentów');
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