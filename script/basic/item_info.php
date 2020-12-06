<?php

function ItemInfoHead($item)
{
	if ($_SESSION['show_item_info'] == true) {
		if (isset($_GET['item_info']) && !empty($_GET['item_info'])) {
			$var = $item[$_GET['item_info']];
		} else {
			$var = $item;
		}
		?>

      <div class="container-fluid">
      <div class="row justify-content-center mr-0">
      <div class="col-lg-3 pr-0">

         <div class="card">
            <div class="card-header">
               ItemInfo
            </div>
            <div class="card-body">

               <form method="get">
						<?php
						parse_str($_SERVER['QUERY_STRING'], $output);
						foreach ($output AS $key => $value) {
							if ($key != 'item_info') {
								echo '<input type="hidden" name="' . $key . '" value="' . $value . '"/>';
							}
						}
						?>
                  <select class="selectpicker form-control mb-2" name="item_info" id="item_info"
                          data-live-search="true" onchange="this.form.submit()" required>
                     <option value="">--</option>
							<?php
							foreach (array_keys($item) AS $key) {
								$selected = ($key == $_GET['item_info']) ? 'selected' : null;
								echo '<option value="' . $key . '" ' . $selected . '>' . $key . '</option>';
							}
							?>
                  </select>
               </form>

					<?php
					echo '<pre style="line-height: 12px">';
					if (isset($_GET['item_info'])) {
						echo 'Type of var: <b>' . gettype($var) . '</b><br/>';
						if (gettype($var) != 'array') {
							echo 'Lenght: <b>' . strlen($var) . '</b><br/>';
						} else {
						   echo 'Count: <b>' . count($var) . '</b><br/>';
						}
					}

					if (gettype($var) != 'array') {
						echo 'Value: ';
					}
					print_r($var);
					echo '</pre>';
					?>

            </div>
         </div>
      </div>

      <div class="col-lg-9">
		<?php
	}
}

function ItemInfoFoot()
{
	if ($_SESSION['show_item_info'] == true) {
		?>
      </div>
      </div>
      </div>
		<?php
	}
}