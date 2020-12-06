<div class="card">
   <div class="card-header">
		<?= Breadcrump(
			array(
				'Panel administracyjny',
				'Konfiguracja systemu',
			)
		) ?>
   </div>
   <div class="card-body">
      <table class="table table-condensed">
         <tr class="table-sm">
            <th class="naglowek">Nazwa</th>
            <th class="naglowek text-center" width="8%">Stan</th>
            <th class="naglowek text-center" width="8%">Akcja</th>
         </tr>

         <tr class="table-sm">
            <td class="f500">Developer mode</td>
            <td class="text-center">
					<?php
					if ($_SESSION['developer_mode'] == false) echo '<img src="/img/icons/red.svg" alt="off" title="off" style="height: 14px">';
					else echo '<img src="/img/icons/green.svg" alt="on" title="on" style="height: 14px">';
					?>
            </td>
            <td class="text-center">
					<?php
					if ($_SESSION['developer_mode'] == false) echo '<a href="/admin.php?sys_conf&switch&developer_mode=on">włącz</a>';
					else echo '<a href="/admin.php?sys_conf&switch&developer_mode=off">wyłącz</a>';
					?>
            </td>
         </tr>

         <tr class="table-sm">
            <td class="f500">Pokaż tablicę obiektu</td>
            <td class="text-center">
					<?php
					if ($_SESSION['show_item_info'] == false) echo '<img src="/img/icons/red.svg" alt="off" title="off" style="height: 14px">';
					else echo '<img src="/img/icons/green.svg" alt="on" title="on" style="height: 14px">';
					?>
            </td>
            <td class="text-center">
					<?php
					if ($_SESSION['show_item_info'] == false) echo '<a href="/admin.php?sys_conf&switch&show_item_info=on">włącz</a>';
					else echo '<a href="/admin.php?sys_conf&switch&show_item_info=off">wyłącz</a>';
					?>
            </td>
         </tr>
      </table>
   </div>
</div>
