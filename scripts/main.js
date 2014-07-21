//Menu swith selected page

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
                    url: "/homepage/homepage/offer",
                    type: "post",
                    data: "description=" + descrption + "&offer=" + offer + "&name=" + name,
                });
                // callback handler that will be called on success
                request.done(function(response, textStatus, jqXHR) {
                   //  alert("Jūsu ziņa tika saņemta!");
                });
               $(this).dialog('close');
            },
            "Atcelt": function() {
                $(this).dialog('close');
            }
        }
    });
}