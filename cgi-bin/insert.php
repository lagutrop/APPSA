<?php
/**
 * Created by Tiago.
 * Date: 27-01-2018
 * Time: 20:37
 */
include_once("../Database.php");

/**
 * Input Validation
 * @param $value
 * @param $type
 * @return bool
 */
function validate($value, $type)
{
    switch ($type) {
        case "socio":
            $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
            if (isset($value)) {
                $valid_value = filter_var($value, FILTER_VALIDATE_INT, [
                    'options' => [
                        'min_range' => 1
                    ]
                ]);
            } else {
                return false;
            }
            break;
        case "quota":
            $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
            if (isset($value)) {
                $valid_value = filter_var($value, FILTER_VALIDATE_INT, [
                    'options' => [
                        'min_range' => 1901,
                        'max_range' => 2155
                    ]
                ]);
            } else {
                return false;
            }
            break;
        case "data":
            $regexp = "/^[0-9][0-9]?-[0-9][0-9]?-[1-2][0-9][0-9][0-9]$/";
            $value = filter_var($value, FILTER_SANITIZE_STRING);
            if (isset($value)) {
                $valid_value = filter_var($value, FILTER_VALIDATE_REGEXP, [
                    'options' => [
                        'regexp' => $regexp
                    ]
                ]);
            } else {
                return false;
            }
            break;
    }
    return $valid_value;
}

/**
 * Insert socio in database
 * @param $response
 * @return string
 */
function insert($response)
{
    $database = new Database();
    $countData = count($response);
    $subQuery = "";
    $concat_bind_params = "";
    $attributes = [];
    for ($i = 0; $i < $countData; $i += 1) {
        $socio = $database->escape($response[$i]->socio);
        $quota = $database->escape($response[$i]->quota);
        $data = $database->escape($response[$i]->data);

        //Input Validation
        $socio_valid = validate($socio, 'socio');
        $quota_valid = validate($quota, 'quota');
        $data_valid = validate($data, 'data');
        if (!$socio_valid || !$quota_valid || !$data_valid) {
            return "O(s) campo(s) preenchido(s) não é(são) válido(s).";
        }

        //Query builder
        if ($i < $countData - 1) {
            $subQuery .= '(?,?, STR_TO_DATE(?, "%d-%m-%Y")),';
        } else {
            $subQuery .= '(?,?, STR_TO_DATE(?, "%d-%m-%Y"))';
        }
        $concat_bind_params .= "iis";
        array_push($attributes, $socio, $quota, $data);
    }
    try {
        $database->insert('socio', $subQuery, $concat_bind_params, $attributes);
        $message = "insert";
    } catch (Exception $exception) {
        $parseMessage = explode("'", $exception->getMessage());
        $parseNumbers = explode("-", $parseMessage[1]);
        $socio = $parseNumbers[0];
        $quota = $parseNumbers[1];
        $message = "O sócio " . $socio . " já tem a quota de " . $quota . " paga. Por favor retifique os valores.";
    }
    return $message;
}
