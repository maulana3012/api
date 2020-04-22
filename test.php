<?php
require __DIR__ . '/vendor/autoload.php';

use phpseclib\Net\SFTP;

$sftp = new SFTP('sftp.rds.co.id');
if (!$sftp->login('zurich-eov', 'Zur1ch_rD$2020')) {
    exit('Login Failed');
}

$path = "DATA-FEED/";
$filename = "Datafeed-Export-".date('Ymd').".csv";
$filepath = $path.$filename;
$local_file = "Files/";
$local_path = "$local_file.$filename";

// outputs the contents of filename.remote to the screen
echo $sftp->get('$filepath');
// copies filename.remote to filename.local from the SFTP server
$sftp->get('$filepath', '$local_path');

?>
