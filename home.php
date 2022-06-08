<?php
// Initialize the session
session_start();
$category = ["Mathematics", "Science", "Geography", "English", "Malay", "Physics", "Biology", "Japanese"]; ?>

<?php include('templates/header.php'); ?>

<body>
    <!-- Sidebar  -->
    <div class="wrapper">
        <?php include('templates/sidebar.php'); ?>
        <!-- Page Content  -->
        <div id="content">
            <!-- Navbar  -->
            <?php include('templates/navbar.php'); ?>
            <?php

            // Check if the user is logged in, if not then redirect him to login page
            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                header("location: index.php");
                exit;
            }
            ?>
            <div class="home">
                <div class="quotes">
                    <div>
                        We are what we learn.
                    </div>
                    <div>
                        Start learning today.
                    </div>

                </div>
                <div class="section-1">
                    <div class="white-div">
                        <div class="join-btn-input-wrapper">
                            <div>
                                <input id="join-input" type="text" pattern="\d*" maxlength="6"
                                    placeholder="Enter a join code"><button id="join-btn" class="home-btn">
                                    <div>JOIN</div>
                                </button>
                            </div>
                            <div class="invalid-quiz-error">
                                Invalid Quiz Code
                            </div>
                        </div>

                    </div>
                    <div class="white-div">
                        <button id="create-btn" class="home-btn"><i class="fa-solid fa-circle-plus"></i> Create
                            quiz</button>
                    </div>
                </div>
                <div class="section-2">
                    <div class="section-title">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <div>Browse by Category</div>
                    </div>
                    <div class="card-list">
                        <?php foreach ($category as $key => $value) : ?>
                        <a href="singleCategory.php?category=<?php echo $value ?> " class="brand-text">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" style="height:160px; border-bottom: 1px solid #f2f2f2"
                                    src=<?php echo "img/" . $value . ".png" ?> alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $value; ?>
                                    </h5>
                                </div>
                        </a>


                    </div>
                    <?php endforeach; ?>

                </div>

            </div>
        </div>

    </div>
    </div>
    <?php include('templates/footer.php'); ?>