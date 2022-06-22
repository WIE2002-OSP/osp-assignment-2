<?php session_start(); ?>

<?php include('templates/header.php'); 
include('check-login.php');
?>

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
                                <h3 class="panel-title">Quiz Created</h3>
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
    <!-- Delete Modal -->
    <div id="deleteModal" class="modal quiz">
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

    <!-- Add Question Modal -->
    <div id="questionModal" class="quiz modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Question</h3>
                <h3 class="x-btn">
                    <div>
                        &times;
                    </div>
                </h3>
            </div>
            <div class="modal-body">
                <form method="POST" id="question_form">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-2 text-left">Quiz Code<span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input class="disabled" type="text" name="question_code" id="question_code"
                                    autocomplete="off" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-2 text-left">Question Title <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="question_title" id="question_title" autocomplete="off"
                                    class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-2 text-left">Option 1 <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="option_title_1" id="option_title_1" autocomplete="off"
                                    class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-2 text-left">Option 2 <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="option_title_2" id="option_title_2" autocomplete="off"
                                    class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-2 text-left">Option 3 <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="option_title_3" id="option_title_3" autocomplete="off"
                                    class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-2 text-left">Option 4 <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="option_title_4" id="option_title_4" autocomplete="off"
                                    class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-2 text-left">Answer <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select name="answer_option" id="answer_option" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="confirm-button" id="confirm-btn" class="modal-btn btn btn-sm"
                            value="Confirm"></input>
                        <button type="button" id="close-btn" class="modal-btn btn btn-sm"
                            data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('templates/footer.php'); ?>