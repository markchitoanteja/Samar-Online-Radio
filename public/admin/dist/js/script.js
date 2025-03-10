jQuery(document).ready(function () {
    $("#login_form").submit(function () {
        const email = $("#login_email").val();
        const password = $("#login_password").val();
        const remember_me = $("#login_remember_me").prop("checked");

        $("#login_submit").text("Please wait...");
        $("#login_submit").attr("disabled", true);

        var formData = new FormData();

        formData.append('email', email);
        formData.append('password', password);
        formData.append('remember_me', remember_me);

        $.ajax({
            url: '../get_user_data',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    location.href = "dashboard";
                } else {
                    location.reload();
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#forgot_password").click(function () {
        Swal.fire({
            title: "Forgot Password",
            text: "Please contact the administrator to reset your password.",
            icon: "info",
        });
    })
})