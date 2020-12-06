<?php
session_start();
require_once __DIR__ . '/inc/whole-service.php';
require_once __DIR__ . '/employees/script/list.php';
require_once __DIR__ . '/admin/script/use-of-db-index.php';

if (!isset($_SESSION['loggedUser'])) {
	if (is_admin() === false) {
		$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
		header('Location: /login.php');
		exit();
	}
}

//service - switch system configuration
require_once __DIR__ . '/admin/formService/switch.php';
if (isset($get_key[1]) && isset($get_key[2]) && $get_key[1] == 'switch') SwitchParam($get_key[2]);

$title = 'Panel administratora';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include __DIR__ . '/inc/head.php'; ?>
   <title><?= $title . ' - ' . SITE_NAME ?></title>
</head>
<body>

<?php
include __DIR__ . '/inc/menu.php';
include __DIR__ . '/inc/glob-vars.php';
?>

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-3">

         <div class="sticky-top" style="top: 70px">
            <div class="card">
               <div class="card-header">
                  Organizacja
               </div>
               <div class="card-body">
                  <table width="100%">
                     <tr>
                        <td colspan="2">
                           <a href="/admin.php?employees" class="menu">Pracownicy</a>
                        </td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>

         <div class="sticky-top" style="top: 70px">
            <div class="card">
               <div class="card-header">
						<?= $title ?>
               </div>
               <div class="card-body">
                  <table width="100%">
                     <tr>
                        <td colspan="2">
                           <a href="/admin.php?system-look-up" class="menu">System LookUp</a>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <a href="/admin.php?sys_conf" class="menu">Konfiguracja systemu</a>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <a href="/admin.php?use-of-db" class="menu">Użycie indexów</a>
                        </td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>

      </div>
      <div class="col-md-9">

			<?php
			if (!empty($get_key)) {
				switch ($get_key[0]) {
					case 'employees':
						include __DIR__ . '/admin/employees.php';
						break;
					case 'system-look-up':
						include __DIR__ . '/admin/system-look-up.php';
						break;
					case 'use-of-db':
						include __DIR__ . '/admin/use-of-db-index.php';
						break;
					case 'sys_conf':
						include __DIR__ . '/admin/system_config.php';
						break;
				}
			} else {
				include __DIR__ . '/admin/system_config.php';
				include __DIR__ . '/admin/db_overcrowded.php';
			}
			?>

      </div>
   </div>
</div>

<?php
include __DIR__ . '/inc/foot.php';
include __DIR__ . '/inc/notify.php';
?>

</body>
</html>