<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'bd.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->plaignant_id) &&
    !empty($data->plaignant_pseudo) &&
    !empty($data->plaignant_prenom) &&
    !empty($data->plaignant_nom) &&
    !empty($data->plaignant_tel1) &&
    !empty($data->plaignant_email)&&
    !empty($data->plaignant_password)&&
    !empty($data->plaignant_confirm_password)
) {
    $query = "INSERT INTO PLAIGNANT SET 
                PLAIGNANT_ID=:plaignant_id, 
                PLAIGNANT_PSEUDO=:plaignant_pseudo, 
                PLAIGNANT_PRENOM=:plaignant_prenom, 
                PLAIGNANT_NOM=:plaignant_nom, 
                PLAIGNANT_TEL1=:plaignant_tel1, 
                PLAIGNANT_EMAIL=:plaignant_email, 
                PLAIGNANT_PASSWORD=:plaignant_password, 
                PLAIGNANT_CONFIRM_PASSWORD=:plaignant_confirm_password, 

               ";

    $stmt = $db->prepare($query);
    $stmt->bindParam(":plaignant_id", $data->plaignant_id);
    $stmt->bindParam(":plaignant_pseudo", $data->plaignant_pseudo);
    $stmt->bindParam(":plaignant_prenom", $data->plaignant_prenom);
    $stmt->bindParam(":plaignant_nom", $data->plaignant_nom);
    $stmt->bindParam(":plaignant_tel1", $data->plaignant_tel1);
    $stmt->bindParam(":plaignant_email", $data->plaignant_email);
    $stmt->bindParam(":plaignant_password", $data->plaignant_password);
    $stmt->bindParam(":plaignant_confirm_password", $data->plaignant_confirm_password);
    
    if($stmt->execute()) {
        echo json_encode(array("message" => "Record was created."));
    } else {
        echo json_encode(array("message" => "Unable to create record."));
    }
} else {
    echo json_encode(array("message" => "Incomplete data."));
}
?>
