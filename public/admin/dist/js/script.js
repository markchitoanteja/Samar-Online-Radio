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