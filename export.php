<?php
require_once '/var/piv/services/api/setting.php';


$query = $koneksi->query("SELECT * FROM tb_data_zurcih ORDER BY ID DESC");

if ($query->num_rows > 0) {
	$delimiter = ",";
        $localdir = "/var/piv/services/Files/";
	$filename = $localdir."Data-EOV".date('Ymd').".csv";

	$f = fopen('php://memory', 'w');

	$fileds = array('UID', 'CLIENT_TYPE', 'POLICY_HOLDER_NAME', 'POLICY_HOLDER_NAME_ROW_2', 'LIFE_ASSURED', 'LIFE_ASSURED_ROW_2', 'POLICY_HOLDER_DATE_OF_BIRTH', 'POLICY_HOLDER_DATE_OF_BIRTH_LIFE_ASSURED', 'POLICY_NUMBER', 'CODE_FREQUENCY', 'PAYMENT_FREQUENCY', 'CODE_PAYMENT_METHOD', 'PAYMENT_METHOD', 'AGENT_NAME', 'POLICY_HOLDER_PHONE_NUMBER', 'EMAIL_POLICY_HOLDER_NAME', 'CODE_COMPONENT_DESCRIPTION', 'COMPONENT_DESCRIPTION', 'LANDING_PAGE');
	fputcsv($f, $fileds, $delimiter);
	file_put_contents($filename, implode (", ", $fileds).PHP_EOL , FILE_APPEND | LOCK_EX);
	while ($row = $query->fetch_assoc()) {
		$lineData = array($row['UID'], $row['CLIENT_TYPE'], $row['POLICY_HOLDER_NAME'], $row['POLICY_HOLDER_NAME_ROW_2'], $row['LIFE_ASSURED'], $row['LIFE_ASSURED_ROW_2'], $row['POLICY_HOLDER_DATE_OF_BIRTH'], $row['POLICY_HOLDER_DATE_OF_BIRTH_LIFE_ASSURED'], $row['POLICY_NUMBER'], $row['CODE_FREQUENCY'], $row['PAYMENT_FREQUENCY'], $row['CODE_PAYMENT_METHOD'], $row['PAYMENT_METHOD'], $row['AGENT_NAME'], $row['POLICY_HOLDER_PHONE_NUMBER'], $row['EMAIL_POLICY_HOLDER_NAME'], $row['CODE_COMPONENT_DESCRIPTION'], $row['COMPONENT_DESCRIPTION'], $row['LANDING_PAGE']);
		fputcsv($f, $lineData, $delimiter);
	file_put_contents($filename, implode(",", $lineData).PHP_EOL , FILE_APPEND | LOCK_EX);
	}

	fseek($f, 0);
	header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    $conten = $fileds.$linedata;
    //file_put_contents($filename, $lineData.PHP_EOL , FILE_APPEND | LOCK_EX);
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;
	
?>
