<?php

foreach ($_SESSION['notify'] AS $not) {

	$icon = (isset($not['icon'])) ? "icon: '{$not['icon']}'," : "";
	$type = ($not['type']) ? $not['type'] : 'warning';
	$message = (isset($not['message'])) ? $not['message'] : "Something went wrong! :-(";

	?>

   <script>

       $.notify({
			 <?= $icon ?>
           message: '<span class="f500"><?= $message ?></span>'
       }, {
           // settings
           type: "<?= $type ?>",
           allow_dismiss: false,
           offset: {
               x: 20,
               y: 70
           },
           delay: 3000,
           spacing: 10,
           z_index: 1001,
           onShow: function () {
               this.css({
                   'width': 'auto',
                   'height': 'auto',
                   'padding': '10px 20px'
               });
           },
       });

   </script>


	<?php

}

unset($_SESSION['notify']);
