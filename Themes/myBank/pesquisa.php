<?php
$search = (!empty($configUrl[1]) ? trim(strip_tags($configUrl[1])) : null);
if(empty($search)){
    header("Location: {$configBase}");
}
?>