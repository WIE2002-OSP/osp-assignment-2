<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
</script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
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

    // data table stuff
    const table = $("#quizTable").DataTable({
        "retrieve": true,
        responsive: true,
        ajax: {
            url: "http://localhost/osp-assignment-2/api/question_set/fetch-question-set.php",
            dataSrc: "data",
            error: function(xhr, status, error) {
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
                    return `<button class="dt-btn add-question-btn" id="quiz-${row.quiz_id}">&nbsp;Add Question&nbsp;</button>`;
                }
            },
            {
                data: "",
                class: "center",
                render: function(data, type, row, meta) {
                    return `<button class="dt-btn view-report-btn" id="quiz-${row.quiz_id}">&nbsp;View Report&nbsp;</button>`;
                }
            },
            {
                data: "",
                class: "center",
                render: function(data, type, row, meta) {
                    return `<button class="dt-btn edit-btn" id="quiz-${row.quiz_id}">Edit&nbsp;</button> <button class="dt-btn dlt-btn" id="quiz-${row.quiz_id}">Delete&nbsp;</button>`;
                }
            },
        ],
    });
    table.draw();


    // delete modal
    function deleteRow(quizId) {
        $.ajax({
            type: "GET",
            url: `http://localhost/osp-assignment-2/api/question_set/delete-question-set.php?quizId=${quizId}`,
            success: function() {
                $("#deleteModal").removeClass("show");
                table.ajax.reload()
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

    $("#deleteModal").delegate("#confirm-btn", "click", function() {
        console.log($quiz_id)
        deleteRow($quiz_id)
    });



});
</script>
</body>

</html>