<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'bd.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT id, name, value FROM my_table";
$stmt = $db->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();

if($num > 0) {
    $data_arr = array();
    $data_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $data_item = array(
            "id" => $id,
            "name" => $name,
            "value" => $value
        );
        array_push($data_arr["records"], $data_item);
    }
    echo json_encode($data_arr);
} else {
    echo json_encode(array("message" => "No records found."));
}
?>
