<?php

function ShowAlert($type, $string, $width = null, $margin = null)
{

	if ($width || $margin) {
		$style = 'style = "width: ' . $width . '%; margin-bottom: ' . $margin . 'px;"';
	} else {
		$style = false;
	}


	echo <<<END

   <div class="row justify-content-md-center">
      <div class="col-12 col-md-auto text-center" $style>
         <div class="alert alert-$type f500" role="alert" style="margin-bottom: 0;">
				$string
         </div>
      </div>
   </div>
   
END;

}


function ShowSimpleInfo($string)
{

	echo '<div class="text-center gray">' . $string . '</div>';

}


function ShowInfoLabel($string, $color = 'green', $margin = 0)
{

	switch ($color) {

		case 'yellow':
			$color = '222, 222, 0, 0.08';
			break;

		case 'red':
			$color = '222, 0, 0, 0.08';
			break;

		case 'green':
			$color = '0, 222, 0, 0.08';
			break;

		case 'blue':
			$color = '0, 0, 255, 0.05';
			break;

		case 'gray':
			$color = '100, 100, 100, 0.05';
			break;

		case 'white':
			$color = '1, 1, 1, 0.03';
			break;

	}

	echo <<<END
   <div class="row justify-content-center" style="margin-bottom: {$margin}px">
      <div class="col text-center">
         <div class="card">
            <div class="card-body f500" style="background: rgba($color); padding: 10px; font-size: 17px; line-height: 1.54">
            $string
            </div>
         </div>
      </div>
   </div>
END;

}