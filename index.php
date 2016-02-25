<?php
/**
 * Simple dynamic DNS record server
 *
 * This simple script has 4 functions:
 *   - Returns curren client IP
 *   - Saves designated IP to specified server register
 *        requires POST: key, server, ip
 *   - Returns last registered IP of specified server
 *        requires POST: key, server
 *   - Returns all registered servers and last IP addresses
 *        requires POST: key
 * All data is returned in JSON format.
 * 
 * @author   Alfredo Rius <alfredo.rius@gmail.com>
 * @link     https://github.com/devalfrz/simple-dyndns-server
 */

/*** Credentials ***/
$key = 'dyndns'; //REPLACE!!!

$db = 'db.csv';

header('Content-type: application/json');
if(isset($_POST['key'])){
    $csv = array_map('str_getcsv', file($db));
    if($_POST['key']==$key){
        if(isset($_POST['server'])){
            for($i=0;$i<count($csv);$i++){
                if($csv[$i][0] == $_POST['server']){
                    $server = $csv[$i];
                    if(isset($_POST['ip'])){
                      $new_csv = $csv;
                      $new_csv[$i][1] = $_POST['ip'];
                    }
                    break;
                }
            }
            if(isset($server)&&isset($new_csv)){
                $fp = fopen($db, 'w');
                foreach ($new_csv as $fields) {
                    fputcsv($fp, $fields);
                }
                fclose($fp);
                echo json_encode(array('server'=>$new_csv[$i][0],'ip'=>$new_csv[$i][1]));
            }elseif(isset($server)){
                echo json_encode(array('server'=>$server[0],'ip'=>$server[1]));
            }elseif(isset($_POST['ip'])){
                $fp = fopen($db, 'a');
                fputcsv($fp, array($_POST['server'],$_POST['ip']));
                fclose($fp);
                echo json_encode(array('server'=>$_POST['server'],'ip'=>$_POST['ip']));
            }else echo json_encode(array('error'=>'Server Name Not Found!'));
        }else{
            echo "[";
            for($i=0;$i<count($csv);$i++){
                echo json_encode(array(
                    'server'=>$csv[$i][0],
                    'ip'=>$csv[$i][1]
                ));
                if($i!=count($csv)-1) echo ",\n";
            }
            echo "]";
        }
    }else echo json_encode(array('error'=>'Permission Denied!'));
}else{
    echo json_encode(array('current_ip'=>$_SERVER['REMOTE_ADDR']));
}
?>

