<?php
// Initialize the session
session_start();
include('check-login.php');

$ID = $_SESSION['user_id'];

require_once "config.php";

$category = "";
$img_path = "";

// check GET request id param
if (isset($_GET['category'])) {
    $img_path = $_GET['category'] . ".png";
    $category = mysqli_real_escape_string($link, $_GET['category']);

    // make sql
    $sql = "SELECT * FROM question_set where category = '$category' and creator_id = $ID";
    // $sql = "SELECT * FROM question_set where category = '$category' and ";

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
                    <div class="category-analytic-btn">
                        <?php $name = str_replace(" ", "%20", $item['question_set_name']); ?>

                        <a href=<?php echo "view-analytics.php?quizId=" . $item['question_set_id'] . "&quizName=" . $name . "&quizCategory=" . $category; ?>>View Analytics</a>
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