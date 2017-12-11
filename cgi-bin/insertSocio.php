<?php
include("../validation.php");
privatePage();
$data = json_decode(file_get_contents("php://input"));
$countData = count($data);
$serverName = "localhost";
$du = "appsa_admin";
$dp = "appsa_admin";
$dbName = "appsa";
$table = "socio";
$conn = new mysqli($serverName, $du, $dp, $dbName);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$query = "INSERT INTO socio VALUES";
$subQuery = "";
for($i = 0; $i < $countData; $i += 1) {
    if ($i < $countData - 1) {
        $subQuery .= '(' . $data[$i]->socio . ',' . $data[$i]->quota . ',' . "STR_TO_DATE('" . $data[$i]->data . "','%d-%m-%Y')" . '),';
    } else {
        $subQuery .= '(' . $data[$i]->socio . ',' . $data[$i]->quota . ',' . "STR_TO_DATE('" . $data[$i]->data . "','%d-%m-%Y')" . ')';
    }
}
$sql = $query . $subQuery;
try {
    $result = $conn->query($sql);
} catch (Exception $e) {
    $parseMessage = explode("'", $e->getMessage());
    $parseNumbers = explode("-", $parseMessage[1]);
    $socio = $parseNumbers[0];
    $quota = $parseNumbers[1];
    $message = "O sócio " . $socio . " já tem a quota de " . $quota . " paga. Por favor retifique os valores.";
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(array('data'=>$message));
}
?>