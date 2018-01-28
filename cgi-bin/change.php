<?php
/**
 * Created by Tiago.
 * Date: 27-01-2018
 * Time: 20:37
 */
include_once("../Database.php");

/**
 * Modify password
 * @param $response
 * @return string
 */
function modify($response)
{
    $database = new Database();
    $result = $database->select('senha', 'utilizador', 'nome = "appsa"');
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dbpw = $row['senha'];
        }
    } else {
        return 'Operação inválida';
    }
    if (!empty($dbpw)) {
        $verifier = password_verify($response[0], $dbpw);
    } else {
        return 'Operação inválida';
    }
    if ($verifier === true) {
        $newp = password_hash($response[1], PASSWORD_DEFAULT);
        $database->update('utilizador', 'senha = ?', 'nome = "appsa"', 's', [$newp]);
        $message = "changed";
    } else {
        $message = "A senha introduzida é inválida.";
    }
    return $message;
}
