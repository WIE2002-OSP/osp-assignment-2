<?php
require_once "../../config.php";

// Get data from the REST client
$quizId = isset($_GET['quizId']) ? mysqli_real_escape_string($link, $_GET['quizId']) : "";

// Delete data into database
$sql = "DELETE FROM question_set WHERE question_set_id=$quizId;";
$post_data_query = mysqli_query($link, $sql);
if ($post_data_query) {
    $json = array("status" => 1, "Success" => "Quiz has been removed successfully!");
} else {
    $json = array("status" => 0, "Error" => "Error removing quiz. Please try again!");
}


@mysqli_close($link);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);