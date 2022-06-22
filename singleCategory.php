<?php
// Initialize the session
session_start();
include('check-login.php');

require_once "config.php";

$category = "";
$img_path = "";

// check GET request id param
if (isset($_GET['category'])) {
    $img_path = $_GET['category'] . ".png";
    $category = mysqli_real_escape_string($link, $_GET['category']);

    // make sql
    $sql = "SELECT * FROM question_set where category = '$category'";

    // get the query result
    $result = mysqli_query($link, $sql);

    // fetch result
    $question_set = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($link);
}


?>


<?php include('templates/header.php'); ?>


<!-- Sidebar  -->
<div class="wrapper">
    <?php include('templates/sidebar.php'); ?>


    <!-- Page Content  -->
    <div id="content">
        <!-- Navbar  -->
        <?php include('templates/navbar.php'); ?>
        <!-- create quiz -->
        <div class="single-category">
            <div class="single-category-container">
                <div class="single-category-left">
                    <img src=<?php echo "img/" . $img_path ?> alt="">
                </div>
                <div class="single-category-right">
                    <div>Popular Quizzes</div>
                    <div>
                        <a href="home.php">Home</a>
                        <div>> <?php echo $category; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-category-container-two">
                <?php foreach ($question_set as $item) : ?>
                <div id=<?php echo $item["question_set_id"]; ?> class="single-category-quiz-item">
                    <div>
                        <div class="item-category">
                            Quiz
                        </div>
                        <div class="item-title"><?php echo $item["question_set_name"]; ?>
                        </div>
                    </div>
                    <div class="category-join-quiz-btn">
                        <?php $name = str_replace(" ", "%20", $item['question_set_name']); ?>

                        <a
                            href=<?php echo "join-quiz.php?quizId=" . $item['question_set_id'] . "&quizName=" . $name . "&quizCategory=" . $category; ?>>Join</a>
                    </div>

                </div>

                <?php endforeach; ?>
            </div>

        </div>

    </div>
</div>
<?php
?>

<?php include('templates/footer.php'); ?>