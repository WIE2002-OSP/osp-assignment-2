<?php session_start(); ?>

<?php include('templates/header.php'); ?>

<body>
    <!-- Sidebar  -->
    <div class="wrapper">
        <?php include('templates/sidebar.php'); ?>


        <!-- Page Content  -->
        <div id="content">
            <!-- Navbar  -->
            <?php include('templates/navbar.php'); ?>
            <div class="quiz-list">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 class="panel-title">Quiz List</h3>
                            </div>
                            <div class="col-md-3" align="right">
                                <button type="button" id="add_button" class="btn btn-info btn-sm">Create</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="quizTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Quiz Code</th>
                                        <th>Quiz Title</th>
                                        <th>Category</th>
                                        <th>Question</th>
                                        <th>Report</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- The Modal -->
    <div id="deleteModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h3>Delete Confirmation</h3>
                <h3 class="x-btn">
                    <div>
                        &times;
                    </div>
                </h3>
            </div>
            <div class="modal-body">
                <div>Are you sure you want to remove this quiz?</div>
            </div>
            <div class="modal-footer">
                <button type="button" name="confirm-button" id="confirm-btn"
                    class="modal-btn btn btn-sm">Confirm</button>
                <button type="button" id="close-btn" class="modal-btn btn btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>

    <!-- <div id="addQuestionModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Some text in the Modal..</p>
        </div>
    </div> -->

    <?php include('templates/footer.php'); ?>