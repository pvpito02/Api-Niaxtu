<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'bd.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id) && !empty($data->name) && !empty($data->value)) {
    $query = "UPDATE my_table SET name = :name, value = :value WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":id", $data->id);
    $stmt->bindParam(":name", $data->name);
    $stmt->bindParam(":value", $data->value);

    if($stmt->execute()) {
        echo json_encode(array("message" => "Record was updated."));
    } else {
        echo json_encode(array("message" => "Unable to update record."));
    }
} else {
    echo json_encode(array("message" => "Incomplete data."));
}
?>
