<?php
header('Content-type: application/json');
echo json_encode(array('current_ip'=>$_SERVER['REMOTE_ADDR']));

?>
