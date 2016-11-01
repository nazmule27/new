(function(e) {
    var t = document.body.clientWidth;
    e(document).ready(function() {
        e("nav").before('<a class="toggleMenu active" href="">Menu<span class="touch-btn">&#9660;</span></a>');

        e("nav ul li a").each(function() {
            if (e(this).next().length > 0) {
                e(this).addClass("parent");
                e(this).append('<span class="touch-btn">&#9660;</span>')
            }
        });
        e(".toggleMenu").click(function(t) {
            t.preventDefault();
            e(this).toggleClass("active");
            e("nav ul").toggleClass("active")
        });
        n()
    });
    e(window).bind("resize orientationchange", function() {
        t = document.body.clientWidth;
        n()
    });
    var n = function() {
        if (t < 768) {
            e(".toggleMenu").css("display", "block");
            if (!e(".toggleMenu").hasClass("active")) {
                e("nav ul:first-child").addClass("active")
            } else {
                e("nav ul:first-child").removeClass("active")
            }
            e("nav ul li").unbind("mouseenter mouseleave");
            e(".touch-btn").unbind("click").bind("click", function(t) {
                t.preventDefault();
                e(this).closest("li").toggleClass("active")
            })
        } else if (t >= 768) {
            e(".toggleMenu").css("display", "none")
        }
    }
})(jQuery)