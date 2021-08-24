// Edit Premission's
$("body").on("click", ".editPermission", function() {
    let id = $(this).attr("data-id");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        type: "get",
        url: "editPermission/" + id,
        dataType: "json",
        beforeSend: function() {
            $(".loader-wrapper").fadeIn("slow");
        },
        success: function(response) {
            console.log(response);
            $("#updatePermission .permission").val(response.permission);
            $("#formID").attr("action", "updatePermission/" + id);
            $("#updatePermission").modal("show");
        },
        error: function(response) {},
        complete: function() {
            $(".loader-wrapper").fadeOut("slow");
        }
    });
});
