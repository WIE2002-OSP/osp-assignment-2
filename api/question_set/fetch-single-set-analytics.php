<?php
require_once "../../config.php";
$quizId = isset($_GET['quizId']) ? mysqli_real_escape_string($link, $_GET['quizId']) : "";
$sqlA = "SELECT a.question_id, q.question_name, SUM(CASE WHEN is_correct=1 THEN 1 ELSE 0 END) AS correct_people, SUM(CASE WHEN is_correct=0 THEN 1 ELSE 0 END) AS wrong_people
FROM answer AS a
LEFT JOIN question AS q
ON a.question_id = q.question_id
WHERE question_set_id=$quizId
GROUP BY a.question_id
order by a.question_id;
";
$get_data_queryA = mysqli_query($link, $sqlA) or die(mysqli_error($link));


if (mysqli_num_rows($get_data_queryA) != 0) {
    $result = array();

    while ($r = mysqli_fetch_array($get_data_queryA)) {
        extract($r);
        $result[] = array("question_id" => $question_id, "question_name" => $question_name, 'correct_people_amount' => $correct_people, 'wrong_people_amount' => $wrong_people, 'correct_per' => round($correct_people / ($correct_people + $wrong_people) * 100));
    }
    $json = array("data" => $result);
} else {
    // $json = array("error" => "Question not found!");
}
@mysqli_close($link);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);