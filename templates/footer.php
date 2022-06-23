<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
</script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js">
</script>
<!-- jQuery Custom Scroller CDN -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
</script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
</script>
<script type="text/javascript">
var cardList = document.querySelector(".card-list");
if (cardList) {
    cardList.addEventListener("wheel", (event) => {
        event.preventDefault();
        cardList.scrollBy({
            left: event.deltaY < 0 ? -200 : 200,
        });
    });
}
$(document).ready(function() {
    let BASE_URL = 'http://localhost/osp-assignment-2'
    $(".quotes div").addClass("load");
    var current = location.pathname;
    $('nav')
    $('nav ul li.burger').click(() => {
        $('nav ul li').toggleClass("hide");
        $('nav ul li.items').toggleClass("show");
    })

    $("nav ul li.items").each(function() {
        var $this = $(this);
        var $currentPath = $this.children().attr('href')
        if (current.indexOf($currentPath) !== -1) {
            $this.addClass('selected');
        }
    });

    $("#sidebar ul li.sidebar-item").each(function() {
        var $this = $(this);
        var $currentPath = $this.children().attr('href')
        if (current.indexOf($currentPath) !== -1) {
            $this.addClass('active');
        }
    });

    $(".setting .dropdown-menu .dropdown-item ").click(function() {
        var $text = $(this).text()
        console.log($text)
        var $img = $(this).children('img').attr('src')
        $(".setting-language-btn").html(`<img src="${$img}" alt="">
        <div>${$text}</div>`)
    });

    // go to create quiz page when click button
    $("#create-btn").click(function() {
        window.location.href = 'createQuiz.php';
    })

    $(".create-quiz .dropdown-menu .dropdown-item").click(function() {
        var $text = $.trim($(this).text());
        var $img = $(this).children('img').attr('src')
        $(".create-quiz-category-btn").html(`<div>${$text}</div>`)
        $('#category-dropdown-input').val($text);
    });

    $("#add_button").click(function() {
        window.location = "createQuiz.php"
    })

    // quiz data table
    const table = $("#quizTable").DataTable({
        "retrieve": true,
        responsive: true,
        ajax: {
            url: `${BASE_URL}/api/question_set/fetch-question-set.php`,
            dataSrc: "data",
            error: function(xhr, status, error) {
                console.log(error)
                alert("Failed to load Table! Please click the refresh button to reload the table.")
            }
        },
        columns: [{
                data: "quiz_id",
                class: "center"
            },
            {
                data: "quiz_name",
                class: "center"
            },
            {
                data: "quiz_category",
                class: "center"
            },
            {
                data: null,
                class: "center",
                render: function(data, type, row, meta) {
                    return `<button class="dt-btn add-question-btn" id="quiz-${row.quiz_id}">&nbsp;Add&nbsp;</button> <a href = "view-quiz.php?quizId=${row.quiz_id}"><button class="dt-btn edit-btn" id="quiz-${row.quiz_id}">&nbsp;View&nbsp;</button> </a>`;
                }
            },
            {
                data: "",
                class: "center",
                render: function(data, type, row, meta) {
                    return `<a href = "view-analytics.php?quizId=${row.quiz_id}"><button class="dt-btn view-report-btn" id="quiz-${row.quiz_id}">&nbsp;View Analytics&nbsp;</button> </a>`;
                }
            },
            {
                data: "",
                class: "center",
                render: function(data, type, row, meta) {
                    return `<button class="dt-btn dlt-btn" id="quiz-${row.quiz_id}">&nbsp;Delete&nbsp;</button>`;
                }
            },
        ],
    });
    table.draw();
    // delete modal
    function deleteQuiz(quizId) {
        $.ajax({
            type: "GET",
            url: `${BASE_URL}/api/question_set/delete-question-set.php?quizId=${quizId}`,
            success: function() {
                $("#deleteModal").removeClass("show");
                table.ajax.reload()
                alert('Quiz is succesfully deleted!');
            },
            error: function() {
                alert('Failed to delete row! Reloading table...');
                table.ajax.reload()
            }
        });
    }

    $("#deleteModal").delegate("#close-btn", "click", function() {
        $("#deleteModal").removeClass("show");
    });

    $("#deleteModal").delegate(".x-btn", "click", function() {
        $("#deleteModal").removeClass("show");
    });

    var quiz_id = '';

    $("#quizTable").delegate(".dlt-btn", "click", function() {
        $("#deleteModal").addClass("show");
        $quiz_id = $(this).attr('id').substring(5);
    });

    $("#deleteModal.quiz").delegate("#confirm-btn", "click", function() {
        console.log($quiz_id)
        deleteQuiz($quiz_id)
    });

    // question modal

    $("#questionModal").delegate("#close-btn", "click", function() {
        $("#questionModal").removeClass("show");
    });

    $("#questionModal").delegate(".x-btn", "click", function() {
        $("#questionModal").removeClass("show");
    });

    $("#quizTable").delegate(".add-question-btn", "click", function() {
        $quiz_id = $(this).attr('id').substring(5);
        $("#questionModal.quiz").addClass("show");
        $("#question_code").val($quiz_id);
    });

    $("#question_form").on('submit', function(e) {
        e.preventDefault();
        console.log($('#question_form').serialize());
        $.ajax({
            type: "POST",
            url: `${BASE_URL}/api/question_set/add-question.php`,
            data: $('#question_form').serialize(),
            success: function() {
                $("#questionModal.quiz").removeClass("show");
                alert('Question is added!');
            },
            error: function(xhr, status, error) {
                alert('Failed to add question!');
                $("#questionModal.quiz").removeClass("show");
            }
        });

    })

    // click view to see question table

    //question data tables

    let searchParams = new URLSearchParams(window.location.search)
    searchParams.has('quizId') // true
    let param = searchParams.get('quizId')
    const question_table = $("#questionTable").DataTable({
        "retrieve": true,
        responsive: true,
        ajax: {
            type: "GET",
            url: `${BASE_URL}/api/question_set/fetch-single-set-question.php?quizId=${param}`,
            dataSrc: "data",
            error: function(xhr, status, error) {
                // alert(
                //     "Failed to load Table! Please click the refresh button to reload the table."
                // )
            }
        },
        columns: [{
                data: "question_name",
                class: "center"
            },
            {
                data: "correct_choice_number",
                class: "center"
            },
            {
                data: null,
                class: "center",
                render: function(data, type, row, meta) {
                    return `<button class="dt-btn edit-btn" id="quiz-${row.question_id}">&nbsp;Edit&nbsp;</button> <button class="dt-btn dlt-btn" id="quiz-${row.question_id}">&nbsp;Delete&nbsp;</button> `;
                }
            },
        ],
    });
    question_table.draw();

    // Analytics part
    let searchParamsA = new URLSearchParams(window.location.search)
    searchParamsA.has('quizId') // true
    let paramA = searchParamsA.get('quizId')
    const analytics_table = $("#analyticsTable").DataTable({
        "retrieve": true,
        responsive: true,
        ajax: {
            type: "GET",
            url: `${BASE_URL}/api/question_set/fetch-single-set-analytics.php?quizId=${param}`,
            dataSrc: "data",
            error: function(xhr, status, error) {
                // alert(
                //     "Failed to load Table! Please click the refresh button to reload the table."
                // )
            }
        },
        columns: [{
                data: "question_name",
                class: "center"
            },
            {
                data: "correct_people_amount",
                class: "center"
            },
            {
                data: "wrong_people_amount",
                class: "center"

            },
            {
                data: "correct_per",
                class: "center"
            },
        ],
    });
    analytics_table.draw();

    function deleteQuestion(questionId) {
        $.ajax({
            type: "GET",
            url: `${BASE_URL}/api/question_set/delete-question.php?questionId=${questionId}`,
            success: function() {
                $("#deleteModal.view-quiz").removeClass("show");
                question_table.ajax.reload()
                alert('Question is deleted!');

            },
            error: function() {
                alert('Failed to delete question! Reloading table...');
                $("#questionTable").DataTable().ajax.reload()
            }
        });
    }

    var questionId = "";

    // delete question
    $("#questionTable").delegate(".dlt-btn", "click", function() {
        $("#deleteModal").addClass("show");
        $questionId = $(this).attr('id').substring(5);
    });

    $("#deleteModal.view-quiz").delegate("#confirm-btn", "click", function() {
        deleteQuestion($questionId);
    });

    $("#questionModal.view-quiz").delegate(".x-btn", "click", function() {
        $("#questionModal.view-quiz").removeClass("show");
    });

    // edit question
    $("#questionTable").delegate(".edit-btn", "click", function() {

        $question_id = $(this).attr('id').substring(5);
        $question_id = parseInt($question_id);
        $("#questionModal.view-quiz").addClass("show");
        $("#question_id").val($question_id);

        function doAjaxQuestion(id) {
            var question_data;
            $.ajax({
                async: false,
                url: `${BASE_URL}/api/question_set/get-single-question.php?questionId=${id}`,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    question_data = data
                    return question_data;
                }
            });
            return question_data;
        }

        var question_data = doAjaxQuestion($question_id);
        console.log(question_data);
        $("#question_title").val(question_data.question_name);
        $("#answer_option").val(question_data.correct_choice_number);

        function doAjaxChoice(id) {
            var question_data;
            $.ajax({
                async: false,
                url: `${BASE_URL}/api/choice/get-choice.php?questionId=${id}`,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    choice_data = data
                    return choice_data;
                }
            });
            return choice_data;
        }

        var choice_data = doAjaxChoice($question_id);
        $("#option_title_1").val(choice_data[0].choice_name);
        $("#option_title_2").val(choice_data[1].choice_name);
        $("#option_title_3").val(choice_data[2].choice_name);
        $("#option_title_4").val(choice_data[3].choice_name);
    });


    $("#question_form_edit").on('submit', function(e) {
        e.preventDefault();
        console.log($('#question_form_edit').serialize());
        $.ajax({
            type: "POST",
            url: `${BASE_URL}/api/question_set/edit-question.php`,
            data: $('#question_form_edit').serialize(),
            success: function() {
                $("#questionModal.view-quiz").removeClass("show");
                question_table.ajax.reload();
                alert('Question is updated!');
            },
            error: function(xhr, status, error) {
                alert('Failed to edit question!');
                question_table.ajax.reload();
                $("#questionModal.view-quiz").removeClass("show");
            }
        });

    })

    $("#join-btn").click(() => {
        var value = $("#join-input").val();
        console.log(value)

        function ajax(id) {
            var question_data;
            $.ajax({
                async: false,
                url: `${BASE_URL}/api/question_set/get-quiz.php?question_set_id=${id}`,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    question_data = data
                    return question_data;
                }
            });
            return question_data;
        }

        var question_set_id = ajax(value);
        console.log(question_set_id.data);
        if (question_set_id.data.length == 0) {
            console.log("Invalid Quiz Code")
            $(".join-btn-input-wrapper").addClass("show");
            $(".invalid-quiz-error").addClass("show");
        } else {
            window.location.href =
                `join-quiz.php?quizId=${question_set_id.data[0].quiz_id}&quizName=${question_set_id.data[0].quiz_name}&quizCategory=${question_set_id.data[0].quiz_category}`
        }
    })

});
</script>
</body>

</html>