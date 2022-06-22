<?php session_start(); ?>

<?php include('templates/header.php');
include('check-login.php');
?>

<head>
</head>

<body>
    <!-- Sidebar  -->
    <div class="wrapper">
        <?php include('templates/sidebar.php'); ?>


        <!-- Page Content  -->
        <div id="content">
            <div id="" style="width:100%">
                <!-- Navbar  -->
                <?php include('templates/navbar.php'); ?>
                <div class="quiz-list">

                    <div class="card" style="margin-bottom:50px;">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3 class="panel-title">Analytics</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="analyticsTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Question Title</th>
                                            <th>Number Of People With Correct Answer</th>
                                            <th>Number Of People With Wrong Answer</th>
                                            <th>Correct Answer Percentage (%)</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="card" style="margin-bottom:50px;">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title" style="margin-bottom:0px !important">Number of students by
                                    Answer</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="chartjs-bar"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="margin-bottom:50px;">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title" style="margin-bottom:0px !important">Number of Students by Scores
                                </h5>
                                <h6 class="card-subtitle" style="color:white"></h6>
                            </div>
                            <div class="card-body">
                                <div class="chart chart-sm">
                                    <canvas id="chartjs-pie"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="card" style="margin-bottom:50px;">
                        <div class="card flex-fill w-100">
                            <div class="card-header">
                                <h5 class="card-title">Line Chart</h5>
                                <h6 class="card-subtitle" style="color:white">Comparison</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="chartjs-line"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

               

                    <div class="card" style="margin-bottom:50px;">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Doughnut Chart</h5>
                                <h6 class="card-subtitle" style="color:white">Percentage of Answer by Category</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart chart-sm">
                                    <canvas id="chartjs-doughnut"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    -->
                </div>
            </div>
        </div>
    </div>


    <script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const quizId = urlParams.get('quizId')
    var question_data;
    let option1Arr;
    let option2Arr;
    let option3Arr;
    let option4Arr;

    $(document).ready(function() {


        function doAjaxQuestion() {
            var question_data;
            $.ajax({
                async: false,
                url: `http://localhost/osp-assignment-2/api/question_set/fetch-single-set-question.php?quizId=${quizId}`,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    question_data = data
                    return question_data;
                }
            });
            return question_data.data;
        }

        function fetchAnswerChoice(questionId) {
            var answer_choice_data;
            $.ajax({
                async: false,
                url: `http://localhost/osp-assignment-2/api/question_set/fetch-question-answer.php?questionId=${questionId}`,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    answer_choice_data = data
                    return answer_choice_data;
                }
            });
            return answer_choice_data.data;
        }


        function fetchQuestionSetScore(questionId) {
            var question_set_score_data;
            $.ajax({
                async: false,
                url: `http://localhost/osp-assignment-2/api/question_set/fetch-question-set-score.php?quizId=${quizId}`,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    question_set_score_data = data
                    return question_set_score_data;
                }
            });
            return question_set_score_data.data;
        }

        question_data = doAjaxQuestion();
        questionDataArr = [];
        option1Arr = Array(question_data.length).fill(0)
        option2Arr = Array(question_data.length).fill(0);
        option3Arr = Array(question_data.length).fill(0);
        option4Arr = Array(question_data.length).fill(0);

        question_data.forEach((data, index) => {
            let label = `Q${index+1}`
            questionDataArr.push(label)
            answer_choice_data = fetchAnswerChoice(data.question_id);
            for (let i = 0; i < answer_choice_data.length; i++) {
                let choice = answer_choice_data[i];
                console.log(choice)
                if (choice == "1") {
                    option1Arr[index]++;
                } else if (choice == "2") {
                    option2Arr[index]++;
                } else if (choice == "3") {
                    option3Arr[index]++;
                } else {
                    option4Arr[index]++;
                }

            }

        })
        question_set_score_data = fetchQuestionSetScore();
        let score_arr = Array(4).fill(0);
        question_set_score_data.forEach((score) => {
            let scorePercentage = score / question_data.length * 100
            if (scorePercentage >= 0 && scorePercentage <= 40) {
                score_arr[0]++;
            } else if (scorePercentage >= 41 && scorePercentage <= 60) {
                score_arr[1]++;
            } else if (scorePercentage >= 61 && scorePercentage <= 80) {
                score_arr[2]++;
            } else {
                score_arr[3]++;
            }
        })

        let myChart = new Chart(document.getElementById("chartjs-bar"), {
            type: "bar",
            data: {
                labels: questionDataArr,
                datasets: [{
                    label: "Option 1",
                    backgroundColor: '#1083ee',
                    borderColor: '#1083ee',
                    hoverBackgroundColor: '#1083ee',
                    hoverBorderColor: '#1083ee',
                    data: option1Arr,
                    barPercentage: .75,
                    categoryPercentage: .5
                }, {
                    label: "Option 2",
                    backgroundColor: "#F7F700",
                    borderColor: "#F7F700",
                    hoverBackgroundColor: "#F7F700",
                    hoverBorderColor: "#F7F700",
                    data: option2Arr,
                    barPercentage: .75,
                    categoryPercentage: .5
                }, {
                    label: "Option 3",
                    backgroundColor: "#0eaa09",
                    borderColor: "#0eaa09",
                    hoverBackgroundColor: "#0eaa09",
                    hoverBorderColor: "#0eaa09",
                    data: option3Arr,
                    barPercentage: .75,
                    categoryPercentage: .5
                }, {
                    label: "Option 4",
                    backgroundColor: "#f66c6e",
                    borderColor: "#f66c6e",
                    hoverBackgroundColor: "#f66c6e",
                    hoverBorderColor: "#f66c6e",
                    data: option4Arr,
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: false
                },
            }
        });

        new Chart(document.getElementById("chartjs-pie"), {
            type: "pie",
            data: {
                labels: ["0-40", "41-60", "61-80", "81-100"],
                datasets: [{
                    data: score_arr,
                    backgroundColor: [
                        '#1083ee',
                        '#F7F700',
                        '#0eaa09',
                        "#f66c6e"
                    ],
                    borderColor: "#F3F6F9"
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                }
            }
        });

    })
    </script>





    <?php include('templates/footer.php'); ?>