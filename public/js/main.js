$(".nav .navbar-item").on("click", function(){
    $(".nav").find(".active").removeClass("active");
    $(this).parent().addClass("active");
});

$(document).ready(function() {
    $('[data-toggle="popover"]').popover({
        html: true,
        placement: 'auto bottom'
    });
});