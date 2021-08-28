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
        url: "permissions/edit/" + id,
        dataType: "json",
        beforeSend: function() {
            $(".loader-wrapper").fadeIn("slow");
        },
        success: function(response) {
            console.log(response);
            $("#updatePermission .permission").val(response.permission);
            $("#formID").attr("action", "permissions/update/" + id);
            $("#updatePermission").modal("show");
        },
        error: function(response) {},
        complete: function() {
            $(".loader-wrapper").fadeOut("slow");
        }
    });
});

// Delete records
$("body").on("click", ".del_btn", function() {
    let id = $(this).attr("data-id");
    let url = $(this).attr("data-url");
    let tableName = $(this).attr("data-tab");
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete it?",
        type: "warning",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Yes, Deleted`,
        denyButtonText: `Don't Delete`
    }).then(result => {
        /* Read more about isConfirmed, isDenied below */
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            $.ajax({
                type: "DELETE",
                url: url + "/" + id,
                dataType: "json",
                beforeSend: function() {
                    swal.fire({
                        title: "Please Wait..!",
                        text: "Is working..",
                        onOpen: function() {
                            swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    swal.fire({
                        title: "Deleted!",
                        text: response.message,
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-primary",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                },
                complete: function() {
                    swal.hideLoading();
                    $("#" + tableName)
                        .DataTable()
                        .ajax.reload();
                },
                error: function() {
                    swal.hideLoading();
                    swal.fire(
                        "!Opps ",
                        "Something went wrong, try again later",
                        "error"
                    );
                }
            });
        } else if (result.isDenied) {
            Swal.fire("Not Deleted", "", "info");
        }
    });
});
