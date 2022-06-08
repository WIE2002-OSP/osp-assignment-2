<?php
require_once "../../config.php";

// Get data from the REST client
$questionId = isset($_GET['questionId']) ? mysqli_real_escape_string($link, $_GET['questionId']) : "";

// get data into database
$sql = "SELECT * FROM question WHERE question_id=$questionId;";

// get the query result
$get_data_query = mysqli_query($link, $sql);

// fetch result
$question = mysqli_fetch_assoc($get_data_query);

// $get_data_query = mysqli_query($link, $sql);
if ($get_data_query) {
    $json = array("question_name" => $question["question_name"], "correct_choice_number" => $question["correct_choice_number"]);
} else {
    $json = array("status" => 0, "Error" => "Error removing quiz. Please try again!");
}


@mysqli_close($link);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);