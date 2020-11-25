var $ = require("jquery");

$(document).ready(function() {
    $(".flagAttivo").change(function() {
        var id = $(this).attr("data-apartmentId");
        $.ajax({
            method: "POST",
            url: "http://localhost:8000/api/attivaApp",
            data: {
                apartmentId: id
            },
            success: function(result) {
                console.log(result);
            },
            error: function(error) {
                console.log(error);
            }
        });
        console.log("id", id);
    });
});
