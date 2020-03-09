<header class="navbar fixed-top justify-content-between" style="background-color: #f0f0f0; margin-bottom: 15px;">

   <div class="form-inline">
      <div class="btn-toolbar" role="toolbar">
         <div class="btn-group mr-2" role="group">
            <a class="btn btn-info navbar-btn" href="/" role="button">Eveline Cosmetics</a>
            <a class="btn btn-outline-info navbar-btn" href="/employees.php" role="button">Kadra</a>
            <a class="btn btn-outline-info navbar-btn" href="/patients.php" role="button">Pacjenci</a>
            <a class="btn btn-outline-info navbar-btn" href="/visits.php" role="button">Wizyty</a>
         </div>
         <div class="btn-group mr-2" role="group">
            <a class="btn btn-outline-info navbar-btn" href="/procedures.php" role="button">Zabiegi</a>
         </div>
      </div>

   </div>

   <div class="form-inline">
      <form action="/search.php">
         <div class="input-group" style="margin-right: 15px;">
            <div class="input-group-prepend">
               <span class="input-group-text">
                  <a href="/search.php"><img src="/img/octicon/search.svg"></a>
               </span>
            </div>
            <input type="text" class="form-control" name="query" placeholder="Szukaj...">
         </div>
      </form>
      <small class="text-right">Zalogowano jako<br>
         <a href="/account.php" class="navbarlink"><b
                  style="color: #111111;"><?= $_SESSION['loggedUser']['full_name'] ?></b></a>
      </small>
		<?php if (IsSiteAdmin()) { ?>
         <div align="right" style="margin-left: 15px;">
            <a href="/admin.php"><img alt="wyloguj" src="/img/octicon/tools.svg" height="20px"></a>
         </div>
		<?php } ?>
      <div align="right" style="margin-left: 15px;">
         <a href="/login.php?userLogOut"><img alt="wyloguj" src="/img/octicon/sign-out.svg" height="20px"></a>
      </div>
   </div>

</header>