<?php
require_once "../../config.php";
$sql = "SELECT * FROM question_set;";
$get_data_query = mysqli_query($link, $sql) or die(mysqli_error($link));
if (mysqli_num_rows($get_data_query) != 0) {
    $result = array();

    while ($r = mysqli_fetch_array($get_data_query)) {
        extract($r);
        $result[] = array("quiz_id" => $question_set_id, "quiz_name" => $question_set_name, 'quiz_category' => $category);
    }
    $json = array("data" => $result);
} else {
    $json = array("error" => "To-Do not found!");
}
@mysqli_close($link);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);