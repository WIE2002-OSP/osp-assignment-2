<?php
require_once "../../config.php";

// Get data from the REST client
$questionId = isset($_GET['questionId']) ? mysqli_real_escape_string($link, $_GET['questionId']) : "";

// Delete data into database
$sql = "DELETE FROM question WHERE question_id=$questionId;";
$post_data_query = mysqli_query($link, $sql);
if ($post_data_query) {
    $json = array("status" => 1, "Success" => "Question has been removed successfully!");
} else {
    $json = array("status" => 0, "Error" => "Error removing question. Please try again!");
}


@mysqli_close($link);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);