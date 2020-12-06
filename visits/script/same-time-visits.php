<?php

function CheckSameTimeVisits($visit)
{

	if ($visit['status_id'] == 1) {
		$date = substr($visit['visit_date'], 0, 10);
		$datetime = $visit['visit_date'];
		$day_visits = VisitList("LEFT(v.visit_date, 10) = '$date' AND v.status_id = 1");
		$hour_visits = VisitList("v.visit_date = '$datetime' AND v.status_id = 1");

		if ($hour_visits['list_count'] > 1) {
			$txt = 'W tym terminie masz już zaplanowaną wizytę!<br />Zmień datę, lub godzinę wizyty<br />';
			foreach ($hour_visits['result'] AS $vis) {
				if ($vis['id'] != $visit['id']) {
					$txt .= DateConvert($vis['visit_date'], true);
					$txt .= ' - ' . $vis['pat_full_name'] . '<br>';
				}
			}
			ShowInfoLabel($txt, 'red');
			?>

         <div class="card">
            <div class="card-body text-center"
                 style="background: rgba(1, 1, 1, 0.03); padding: 10px; line-height: 1.54; font-size: 15px">
               <span class="f500">Pozostałe wizyty tego dnia:</span><br>
					<?php foreach ($day_visits['result'] AS $vis) {
						if ($vis['id'] != $visit['id']) {
							 DateConvert($vis['visit_date'], true) ?> - <?= $vis['pat_full_name'] ?><br/>
						<?php }
					} ?>
            </div>
         </div>

			<?php
		}
	}
}