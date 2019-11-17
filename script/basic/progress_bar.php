<?php

function ProgressBar($step, $max)
{

   $progress = intval(100* ($step / $max));

   echo <<<END
   <div class="progress" style="margin-bottom: 15px; background: rgba(247, 247, 247, 1);">
      <div class="progress-bar bg-info" role="progressbar" style="width: $progress%">
         krok $step z $max
      </div>
   </div>
END;

}