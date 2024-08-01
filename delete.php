<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'bd.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id)) {
    $query = "DELETE FROM my_table WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":id", $data->id);

    if($stmt->execute()) {
        echo json_encode(array("message" => "Record was deleted."));
    } else {
        echo json_encode(array("message" => "Unable to delete record."));
    }
} else {
    echo json_encode(array("message" => "Incomplete data."));
}
?>
