<?php
require_once "../../config.php";

// Get data from the REST client
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_id = $_POST["question_id"];
    $question_name = $_POST["question_title"];
    $choice_1 = $_POST["option_title_1"];
    $choice_2 = $_POST["option_title_2"];
    $choice_3 = $_POST["option_title_3"];
    $choice_4 = $_POST["option_title_4"];
    $choice_arr = array($choice_1, $choice_2, $choice_3, $choice_4);
    $correct_choice_option = $_POST["answer_option"];
    // // Insert question into database
    $sql = "UPDATE question SET question_name = '$question_name', correct_choice_number = $correct_choice_option WHERE question_id=$question_id";
    $update_question_query = mysqli_query($link, $sql);
    $index = 0;
    foreach ($choice_arr as $choice) {
        $choiceNumber = $index + 1;
        $sql = "UPDATE choice SET choice_name = '$choice' WHERE question_id=$question_id AND choice_number='$choiceNumber'";
        $update_choice_query = mysqli_query($link, $sql);
        $index++;
    }

    $json = array();
    if ($update_question_query) {
        $json = array("status" => 1,);
    } else {
        $json = array("status" => 0, "Error" => "Error adding question. Please try again!");
    }
    @mysqli_close($link);
}