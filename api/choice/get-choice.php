<?php
require_once "../../config.php";

// Get data from the REST client
$questionId = isset($_GET['questionId']) ? mysqli_real_escape_string($link, $_GET['questionId']) : "";

// get data into database
$sql = "SELECT * FROM choice WHERE question_id=$questionId;";

// get the query result
$result = mysqli_query($link, $sql);

// fetch result
$choices = mysqli_fetch_all($result, MYSQLI_ASSOC);


$get_data_query = mysqli_query($link, $sql);
if ($get_data_query) {
    $json = $choices;
} else {
    $json = array("status" => 0, "Error" => "Error removing quiz. Please try again!");
}


@mysqli_close($link);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);