
var current = 11;
var call = 0;
$(document).ready(function() {

    $(window).scroll(function() {

        if ($(window).scrollTop() !== 0) {
            if ($("#top_arrow").length === 0) {
                $("body").append("<div onclick='setTop();' id='top_arrow'>^</div>");

            }
            $("#top_arrow").show();
        } else {
            $("#top_arrow").hide();
        }

        if ($(window).scrollTop() + $(window).height() == $(document).height() && $('#total_samples').val() > current)  //user scrolled to bottom of the page?
        {
            console.log($('#total_samples').val() + ' ' + current);


            if (!call) {
                call = 1;
                $.ajax({url: "/homepage/homepage/loadMoreSamples",
                    type: "post",
                    data: "record=" + current,
                    success: function(result) {
                        $("#content").append(result);
                        current += 9;
                        call = 0;
                    }});
            }
        }
    });

});

function setTop() {
    $('html,body').animate({scrollTop: 0}, 500, function() {
        // normal callback
    });
}
$(".item").on("click", function() {
    window.open($(this).children(".item-box").children().attr("href"), "_self");
});
$("#form_name").on("change", function() {
    $('#name_error_msg').hide();
    if ($("#form_name").val() === '')
        $("#form_name_elem").append('<div id="name_error_msg">Lūdzu ievadiet savu vārdu vai e-pastu!</div>');
});
$("#contact_msg").on("change", function() {
    $("#msg_error_msg").hide();
    if ($("#contact_msg").val() === '')
        $("#form_msg_elem").append('<div id="msg_error_msg">Lūdzu ievadiet savu ziņojumu!</div>');
});


function openPopUp(offer) {
    $("body").css("overflow", "hidden");
    $("#popUp").dialog({
        resizable: false,
        modal: true,
        title: "Pieteikties piedāvājumam " + offer,
        height: 350,
        width: 700,
        buttons: {
            "Pieteikties": function() {
                var descrption = $("#description").val();
                var name = $("#name").val();
                request = $.ajax({
                    url: "/homepage/homepage/takeMsg",
                    type: "post",
                    data: "description=" + descrption + "&offer=" + offer + "&name=" + name,
                });
                request.done(function(response, textStatus, jqXHR) {
                });
                $(this).dialog('close');
            },
            "Atcelt": function() {
                $(this).dialog('close');
            }
        },
        beforeClose: function() {
            $("body").css("overflow", "auto");
        }
    });
    var elem = $(".ui-dialog-buttonset")[0].firstChild;
    $(elem.firstChild).css("background-color", "#CBE32D !important");
    $(elem.firstChild).css("border", "0px solid rgba(0, 0, 0, 0.6) !important");
    $(elem).addClass("btn-shine");
}

