<?php include('templates/header.php'); ?>
<?php session_start(); ?>

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
	$query = 'SELECT * FROM user';
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
	mysqli_free_result ($results);
	mysqli_close ($link);
?>
                    <div class="profile-subtitle">
                        <i class="fa fa-check-circle"></i>
                        <div>Quiz Joined</div>
                    </div>

                    <div class="profile-quiz">
                        <div class="quiz">
                            <div class="row">
                                <div class="column">
                                    <img class="card-img-top"
                                        src="https://online.stat.psu.edu/statprogram/sites/statprogram/files/2018-08/algebra-review.jpg"
                                        alt="Card image cap" width="300" height="150">
                                    <div class="quiz-body">
                                        <h6 class="quiz-title">Mathematics</h6>
                                    </div>
                                </div>

                                <div class="column">
                                    <img class="card-img-top"
                                        src="https://cdn.britannica.com/35/142335-131-4742621E/molecule-Model-Atom-Biology-entertainment-Molecular-Structure-2010.jpg"
                                        alt="Card image cap" width="400" height="150">
                                    <div class="quiz-body">
                                        <h6 class="quiz-title">Science</h6>
                                    </div>
                                </div>

                                <div class="column">
                                    <img class="card-img-top"
                                        src="https://world-geography-games.com/img/world-countries.png"
                                        alt="Card image cap" width="400" height="150">
                                    <div class="quiz-body">
                                        <h6 class="quiz-title">Geography</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-subtitle">
                        <i class="fa fa-pencil-square"></i>
                        <div>Quiz Created</div>
                    </div>

                    <div class="profile-quiz">
                        <div class="quiz">
                            <div class="row">
                                <div class="column">
                                    <img class="card-img-top"
                                        src="https://www.environmentalscience.org/wp-content/uploads/2018/08/physics-640x416.jpg"
                                        alt="Card image cap" width="300" height="160">
                                    <div class="quiz-body">
                                        <h6 class="quiz-title">Physics</h6>
                                    </div>
                                </div>

                                <div class="column">
                                    <img class="card-img-top"
                                        src="https://odils.com/wp-content/uploads/2020/04/speaking-listening-reading-writing.jpg"
                                        alt="Card image cap" width="300" height="160">
                                    <div class="quiz-body">
                                        <h6 class="quiz-title">English</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include('templates/footer.php'); ?>
