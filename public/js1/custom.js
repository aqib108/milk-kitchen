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

// Edit Customer
$("body").on("click", ".editCustomer", function() {
    let id = $(this).attr("data-id");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        type: "get",
        url: "customer/edit/" + id,
        dataType: "json",
        beforeSend: function() {
            $(".loader-wrapper").fadeIn("slow");
        },
        success: function(response) {
            console.log(response);
            $("#updateCustomer .Cname").val(response.name);
            $("#updateCustomer .Cemail").val(response.email);
            // $("#updateCustomer .Cpassword").val(response.password);
            $("#formID").attr("action", "customer/update/" + id);
            $("#updateCustomer").modal("show");
        },
        error: function(response) {},
        complete: function() {
            $(".loader-wrapper").fadeOut("slow");
        }
    });
});

// Delete Records
$("body").on("click", ".del_btn", function() {
    let id = $(this).attr("data-id");
    let url = $(this).attr("data-url");
    let tableName = $(this).attr("data-tab");
    swal(
        {
            title: "Are you sure?",
            text: "Your will not be able to recover this again!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function() {
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
                    $(".loader-wrapper").fadeIn("slow");
                },
                success: function(response) {
                    swal({
                        title: "Deleted!",
                        text: response.message,
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-primary successfully_delete",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                    });
                },
                error: function(response) {},
                complete: function() {
                    $(".loader-wrapper").fadeOut("slow");
                    $("#" + tableName)
                        .DataTable()
                        .ajax.reload();
                }
            });
        }
    );
});
