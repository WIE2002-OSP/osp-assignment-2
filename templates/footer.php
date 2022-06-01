    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
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
console.log(cardList)
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
    // $("#sidebar").mCustomScrollbar({
    //     theme: "minimal"
    // });
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
        var $img = $(this).children('img').attr('src')
        $(".setting-language-btn").html(`<img src="${$img}" alt="">
        <div>${$text}</div>`)
    });
});
    </script>
    </body>

    </html>