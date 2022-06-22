<?php include('templates/header.php'); ?>
<?php 
    session_start();
    include('check-login.php'); 
    $category = ["Mathematics", "Science", "Geography", "English", "Malay", "Physics", "Biology", "Japanese"]; ?>
?>

<body>
    <!-- Sidebar  -->
    <div class="wrapper">
        <?php include('templates/sidebar.php'); ?>


        <!-- Page Content  -->
        <div id="content">
            <!-- Navbar  -->
            <?php include('templates/navbar.php'); ?>

            <!-- Profile -->
            <div class="profile">
                <div class="profile-title">
                    Profile
                </div>

                <div class="profile-subtitle">
                    <i class="fa-solid fa-circle-user"></i>
                    <div>Demographic</div>
                </div>

<?php
	include('config.php');
	
	$ID = $_SESSION['user_id'];
	if($ID) {
	
	$query = "SELECT * FROM user where user_id = '$ID' ";
	$results = mysqli_query ($link, $query) or die ('Error in query : $query . ' . mysql_error());
	
	if (mysqli_num_rows ($results) > 0){
		while ($row = mysqli_fetch_row ($results)){
?>

                <div class="profile-details">
                    <i class="fas fa-user-tie"></i>
                    <label>Username: <?php echo $row[1]; ?></label>
                </div>

                <div class="profile-details">
                    <i class="fa fa-envelope"></i>
                    <label>Email address: <?php echo $row[2]; ?></label>
                </div>

                <div class="profile-details">
                    <i class="fa fa-phone"></i>
                    <label>Telephone number: <?php echo $row[3]; ?></label>
                </div>

                <div class="profile-details">
                    <i class="fa fa-birthday-cake"></i>
                    <label>Birthday: <?php echo $row[6]; ?></label>
                </div>

                <div class="profile-details">
                    <i class="fa fa-check-square"></i>
                    <label>Field of interest: <?php echo $row[5]; ?></label>
<?php
		}
	}
}
	mysqli_free_result ($results);
	mysqli_close ($link);
?>

                    <div class="profile-subtitle">
                        <i class="fa fa-check-circle"></i>
                        <div>Quiz Joined</div>
                    </div>

                    <div class="">
                        <div class="">
                            <div class="card-list">
                                <?php foreach($category as $key => $value) : ?>
                                    <div class="column">
                                    <a href="joined-quiz-category.php?category=<?php echo $value ?> " class="brand-text">
                                        <div class="card" style="width: 18rem;">
                                            <img class="card-img-top" style="height:160px; border-bottom: 1px solid #f2f2f2" src=<?php echo "img/" . $value . ".png" ?> alt="Card image cap">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $value; ?></h5>
                                                </div>
			                            </div>
                                    </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="profile-subtitle">
                        <i class="fa fa-pencil-square"></i>
                        <div>Quiz Created</div>
                    </div>

                    <div class="">
                        <div class="">
                            <div class="card-list">
                                <?php foreach($category as $key => $value) : ?>
                                    <div class="column">
                                    <a href="created-quiz-category.php?category=<?php echo $value ?> " class="brand-text">
                                        <div class="card" style="width: 18rem;">
                                            <img class="card-img-top" style="height:160px; border-bottom: 1px solid #f2f2f2" src=<?php echo "img/" . $value . ".png" ?> alt="Card image cap">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $value; ?></h5>
                                                </div>
			                            </div>
                                    </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php include('templates/footer.php'); ?>
