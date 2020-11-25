var $ = require("jquery");

$(document).ready(function() {
    $(".btn-delete-alert").click(function() {
        var result = confirm("Sicuro di voler cancellare?");
        if (result) {
            return true;
        } else {
            return false;
        }
    });
});
