// Edit Premission's
$("body").on("click", ".editPermission", function () {
    let id = $(this).attr("data-id");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "get",
        url: "permissions/edit/" + id,
        dataType: "json",
        beforeSend: function () {
            $(".loader-wrapper").fadeIn("slow");
        },
        success: function (response) {
            console.log(response);
            $("#updatePermission .permission").val(response.permission);
            $("#formID").attr("action", "permissions/update/" + id);
            $("#updatePermission").modal("show");
        },
        error: function (response) {},
        complete: function () {
            $(".loader-wrapper").fadeOut("slow");
        },
    });
});

// Delete records
$("body").on("click", ".del_btn", function () {
    let id = $(this).attr("data-id");
    let url = $(this).attr("data-url");
    let tableName = $(this).attr("data-tab");
    console.log(url);
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "DELETE",
                url: url + "/" + id,
                dataType: "json",
                success: function (response) {
                    Swal.fire("Deleted!", response.message, "success");
                },
                complete: function () {
                    swal.hideLoading();
                    $("#" + tableName)
                        .DataTable()
                        .ajax.reload();
                },
                error: function () {
                    swal.hideLoading();
                    swal.fire(
                        "!Opps ",
                        "Something went wrong, try again later",
                        "error"
                    );
                },
            });
        }
    });
});

//Edit Customer Group name

$("body").on("click", ".editGroup", function () {
    let id = $(this).attr("data-id");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "get",
        url: "customer-group/edit/" + id,
        dataType: "json",
        beforeSend: function () {
            $(".loader-wrapper").fadeIn("slow");
        },
        success: function (response) {
            console.log(response);
            $("#updateGroup .group_name").val(response.group_name);
            $("#formID").attr("action", "customer-group/update/" + id);
            $("#updateGroup").modal("show");
        },
        error: function (response) {},
        complete: function () {
            $(".loader-wrapper").fadeOut("slow");
        },
    });
});
