$(document).ready(function () {
$.getJSON('tasks/data/cache-recent-station-data.json', function (data) {
    var tbl_body = "";
    var odd_even = false;
    $.each(data, function () {
        var tbl_row = "";
        $.each(this, function (k, v) {
            tbl_row += "<td>" + v + "</td>";
        })
        tbl_body += "<tr class=\"" + (odd_even ? "odd" : "even") + "\">" + tbl_row + "</tr>";
        odd_even = !odd_even;
    })
    $("#recent-station-data").append(tbl_body);
});

});
