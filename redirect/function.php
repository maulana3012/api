<?php
function addLog($txt,$uid){
        if(!file_exists($txt))
            $log = fopen($txt,"w");
        $content = $uid.",".date("Ymd H:i:s");
        file_put_contents($txt, $content.PHP_EOL , FILE_APPEND | LOCK_EX);
    }
?>