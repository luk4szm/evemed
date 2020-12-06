<?php if ($_SESSION['developer_mode'] == true) { ?>
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-body" style="padding-bottom: 0;">
                  <div class="d-flex justify-content-around">

							<?php
							$systemVarIndex = array(
								'_POST' => $_POST,
								'_GET' => $_GET,
								'_FILES' => $_FILES
							);

							foreach ($systemVarIndex AS $id => $var) {
								echo '<div class="w-100">';
								echo '<pre><b>$' . $id . ': </b>';
								print_r($var);
								echo '</pre></div>';
							}
							?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php } ?>