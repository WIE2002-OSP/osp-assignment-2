<?php

$category = ["Mathematics", "Science", "Geography", "English", "Malay", "Physics", "Physics", "Physics"]; ?>

<?php include('templates/header.php'); ?>

<body>
    <!-- Sidebar  -->
    <div class="wrapper">
        <?php include('templates/sidebar.php'); ?>


        <!-- Page Content  -->
        <div id="content">
            <!-- Navbar  -->
            <?php include('templates/navbar.php'); ?>
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
                            <div><input id="join-input" type="text" placeholder="Enter a join code"><button
                                    id="join-btn" class="home-btn">
                                    <div>JOIN</div>
                                </button></div>
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
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top"
                                src="https://online.stat.psu.edu/statprogram/sites/statprogram/files/2018-08/algebra-review.jpg"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $value; ?>
                                </h5>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>

                </div>
            </div>

        </div>
    </div>
    <?php include('templates/footer.php'); ?>