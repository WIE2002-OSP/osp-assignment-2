<?php
require_once "../../config.php";

// Get data from the REST client
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_set_id = $_POST["question_code"];
    $question_name = $_POST["question_title"];
    $choice_1 = $_POST["option_title_1"];
    $choice_2 = $_POST["option_title_2"];
    $choice_3 = $_POST["option_title_3"];
    $choice_4 = $_POST["option_title_4"];
    $choice_arr = array($choice_1, $choice_2, $choice_3, $choice_4);
    $correct_choice_option = $_POST["answer_option"];
    // // Insert question into database
    $sql = "INSERT INTO question(question_set_id, question_name, correct_choice_number ) VALUES('$question_set_id', '$question_name', ' $correct_choice_option')";
    $insert_question_query = mysqli_query($link, $sql);
    $json = array();
    if ($insert_question_query) {
        // Get question Id
        $sql = "SELECT question_id FROM question WHERE question_set_id=$question_set_id AND question_name='$question_name';";
        $result = mysqli_query($link, $sql);
        $fetched_question = mysqli_fetch_assoc($result);
        $question_id = $fetched_question["question_id"];
        if ($question_id) {
            $json = array("questionId" => $question_id);
            // add choice
            for ($i = 0; $i < count($choice_arr); $i++) {
                $sql = "INSERT INTO choice(question_id, choice_name, choice_number ) VALUES($question_id, '$choice_arr[$i]', $i+1);";
                $insert_choice_query = mysqli_query($link, $sql);
                if (!$insert_choice_query) {
                    die('Invalid query: ' . mysqli_error($link));
                }
            }
        }
    } else {
        $json = array("status" => 0, "Error" => "Error adding question. Please try again!");
    }
    @mysqli_close($link);
}