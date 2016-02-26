<?php

include_once "../models/DB.class.php";
include_once "../models/Zipcode_Table.class.php";

include_once "autoCompleteServer.php";

$db = DB::get();

$zipCodeTable = new Zip_Table($db);
// create sql
$zipCodes = $zipCodeTable->filterZipCodeByName($term);
while ($zipcode = $zipCodes->fetchObject()) {
    $a_json_row["id"] = $zipcode->id;
    $a_json_row["value"] = $zipcode->name;
    $a_json_row["label"] = $zipcode->zipcode . ' ' . $zipcode->name;
    array_push($a_json, $a_json_row);
}

$json = json_encode($a_json);
print $json;
