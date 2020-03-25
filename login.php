<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/whole-service.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/login/checkUser.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/login/loginUser.php';

//user logout
if (isset($_GET['userLogOut'])) {
	unset($_SESSION['loggedUser']);
	$_SESSION['loginForm']['info'] = 'Bezpiecznie wylogowano z systemu';
	header('Location: /index.php');
	exit();
}

//redirect when user is loggedIn
if (isset($_SESSION['loggedUser'])) {
	header('Location: /index.php');
	exit();
}

//when user send form data - step 1
if (isset($_POST['UserLogIn']) && FormHashValidation($_POST['csrf_token'])) {
	$_SESSION['loginForm']['login'] = FormFilter($_POST['login'], 'login');
	$_SESSION['loginForm']['password'] = $_POST['password'];

	header('Location: ' . $_SERVER['REQUEST_URI']);
	exit();
}

//when user send form data - step 2
if (isset($_SESSION['loginForm']['login']) && isset($_SESSION['loginForm']['password'])) {
	CheckUser($_SESSION['loginForm']['login'], $_SESSION['loginForm']['password']);

	if (isset($_SESSION['loginForm']['logUserID'])) {
		LoginUser($_SESSION['loginForm']['logUserID']);

		unset($_SESSION['loginForm']);
		unset($_SESSION['csrf_hash']);

		if (isset($_SESSION['prevURL'])) {
		   header('Location: ' . $_SESSION['prevURL']);
		   unset($_SESSION['prevURL']);
		} else {
		   header('Location: /index.php');
		}

		exit();
	}
}

$hash = FormHashGenerate('^&*loginPage' . $_SERVER['SCRIPT_FILENAME'] . '2573^&');

?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/inc/head.php'; ?>
   <title>Logowanie - <?= SiteName() ?></title>
</head>
<body>

<div class="container">

   <div class="row justify-content-center">
      <div id="loginPanel" class="col-md-12">

			<?php
			if (isset($_SESSION['loginForm']['error'])) {
				ShowAlert('danger', '<b>' . $_SESSION['loginForm']['error'] . '</b>', 70);
				echo '<br>';
				unset($_SESSION['loginForm']['error']);
			}

			if (isset($_SESSION['loginForm']['info'])) {
				ShowAlert('info', '<b>' . $_SESSION['loginForm']['info'] . '</b>', 70);
				echo '<br>';
				unset($_SESSION['loginForm']['info']);
			}
			?>

         <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) !important;">

            <div style="width: 500px; margin-bottom: 20px">

            </div>

            <div class="card text-center"
                 style="width: 300px; position: absolute; left: 50%; transform: translate(-50%, -50%) !important;">
               <h6 class="card-header">
                  Logowanie
               </h6>

               <div class="card-body">
                  <form class="form-horizontal" method="post">
                     <input type="hidden" name="csrf_token" value="<?= $hash ?>">

                     <div class="form-group row">
                        <div class="col-12">
                           <input class="form-control" type="text" name="login" id="login"
                                  placeholder="login" style="text-align: center" autocomplete="off">
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-12">
                           <input class="form-control" type="password" name="password" id="password"
                                  placeholder="hasło" style="text-align: center" autocomplete="off">
                        </div>
                     </div>
                     <div class="row justify-content-md-center">
                        <div class="col-12 col-md-auto">
                           <button type="submit" class="btn btn-outline-secondary small" name="UserLogIn">Zaloguj
                           </button>
                        </div>
                     </div>
                  </form>
               </div>

            </div>

         </div>
      </div>
   </div>
</div>

<?php

include $_SERVER['DOCUMENT_ROOT'] . '/inc/foot.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/notify.php';

?>

</body>
</html>