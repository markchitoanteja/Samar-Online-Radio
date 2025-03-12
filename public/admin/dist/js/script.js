jQuery(document).ready(function () {
    if (current_tab == "dashboard") {
        display_chart();
    }

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

    $("#profile_image").change(function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#profile_image_preview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#profile_image_preview').hide();
        }
    })

    $("#profile").click(function () {
        loading(true);

        $("#profile_modal").modal("show");

        var formData = new FormData();

        formData.append('user_id', user_id);

        $.ajax({
            url: '../get_user_data_by_id',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    $("#profile_image_preview").attr("src", "../public/admin/dist/img/uploads/" + response.image);
                    $("#profile_name").val(response.name);
                    $("#profile_email").val(response.email);

                    $("#profile_id").val(response.id);
                    $("#profile_old_email").val(response.email);
                    $("#profile_old_password").val(response.password);
                    $("#profile_old_image").val(response.image);

                    loading(false);
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#profile_form").submit(function () {
        const name = $("#profile_name").val();
        const email = $("#profile_email").val();
        let password = $("#profile_password").val();
        const confirm_password = $("#profile_confirm_password").val();
        const image = $("#profile_image")[0].files[0];

        const id = $("#profile_id").val();
        const old_email = $("#profile_old_email").val();
        const old_password = $("#profile_old_password").val();
        const old_image = $("#profile_old_image").val();

        if ((password || confirm_password) && (password != confirm_password)) {
            $("#profile_password").addClass("is-invalid");
            $("#profile_confirm_password").addClass("is-invalid");

            $("#error_profile_password").removeClass("d-none");
        } else {
            if (!password) {
                password = null;
            }

            var formData = new FormData();

            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('image', image);

            formData.append('id', id);
            formData.append('old_email', old_email);
            formData.append('old_password', old_password);
            formData.append('old_image', old_image);

            $.ajax({
                url: '../update_user',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    function loading(enabled) {
        if (enabled) {
            $(".main-form").addClass("d-none");
            $(".loading").removeClass("d-none");
            $(".btn-submit").attr("disabled", true);
        } else {
            $(".main-form").removeClass("d-none");
            $(".loading").addClass("d-none");
            $(".btn-submit").attr("disabled", false);
        }
    }

    function display_chart() {
        const sales_chart_options = {
            series: [{
                name: 'Digital Goods',
                data: [28, 48, 40, 19, 86, 27, 90],
            },
            {
                name: 'Electronics',
                data: [65, 59, 80, 81, 56, 55, 40],
            },
            ],
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                type: 'datetime',
                categories: [
                    '2023-01-01',
                    '2023-02-01',
                    '2023-03-01',
                    '2023-04-01',
                    '2023-05-01',
                    '2023-06-01',
                    '2023-07-01',
                ],
            },
            tooltip: {
                x: {
                    format: 'MMMM yyyy',
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector('#revenue-chart'),
            sales_chart_options,
        );
        sales_chart.render();
    }
})