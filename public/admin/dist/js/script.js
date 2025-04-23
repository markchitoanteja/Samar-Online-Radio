$(document).ready(function () {
    let is_form_submitting = false;
    let currentAudioPlayer = null;
    let currentButton = null;
    let is_page_ready = false;

    preventDevTools(false);
    is_page_loading(false);

    if (current_tab == "dashboard") {
        display_chart();

        fetchCounts();
        fetchUniqueListeners();

        setInterval(() => {
            fetchCounts();
            fetchUniqueListeners();
        }, 1000);
    }

    if (current_tab != "server_music_player" && current_tab != "server_login") {
        preventMobileAccess();
    }

    if ((current_tab != "login") && (current_tab != "server_login") && (current_tab != "server_music_player")) {
        var music_table = $('#music_table').DataTable({
            responsive: false,
            autoWidth: false,
            lengthChange: false,
            paging: true,
            searching: true,
            ordering: false,
            info: true,
            language: {
                search: 'Music Title:',
            },
            columnDefs: [
                {
                    targets: [1],
                    searchable: true
                }
            ]
        });

        $('#music_table_filter input').on('keyup', function () {
            music_table.column(1).search(this.value).draw();
        });

        var playlists_table = $('#playlists_table').DataTable({
            responsive: false,
            autoWidth: false,
            lengthChange: false,
            paging: true,
            searching: true,
            ordering: false,
            info: true,
            language: {
                search: 'Playlist Name:',
            }
        });

        $('#playlists_table_filter input').unbind().on('keyup', function () {
            playlists_table.column(0).search(this.value).draw();
        });
    }

    if (notification) {
        if (is_page_ready) {
            display_notification(notification);
        }
    }

    $("#current_year").text(new Date().getFullYear());

    $('.table thead input[type="checkbox"]').on('change', function () {
        $('.table tbody input[type="checkbox"]').prop('checked', $(this).prop('checked'));

        toggleButtons();
    });

    $(document).on('change', '.table tbody input[type="checkbox"]', function () {
        let totalCheckboxes = $('.table tbody input[type="checkbox"]').length;
        let checkedCheckboxes = $('.table tbody input[type="checkbox"]').filter(':checked').length;

        $('.table thead input[type="checkbox"]').prop('checked', totalCheckboxes === checkedCheckboxes);

        toggleButtons();
    });

    $("input:not(.ignore-validation), select:not(.ignore-validation)").each(function () {
        let inputId = $(this).attr("id");
        let label = $("label[for='" + inputId + "']");

        if (label.length) {
            if ($(this).prop("required")) {
                if (!label.find(".required-mark").length) {
                    label.append(" <span class='required-mark' style='color: red;'>*</span>");
                }
            } else {
                if (!label.find(".optional-text").length) {
                    label.append(" <small class='optional-text' style='color: gray;'>(Optional)</small>");
                }
            }
        }
    });

    $(document).on('hide.bs.modal', ".modal", function (e) {
        if (is_form_submitting) {
            e.preventDefault();
            e.stopImmediatePropagation();
            return false;
        }
    });

    $(".no-function").click(function () {
        Swal.fire({
            title: "No Function",
            text: "This function is not available yet.",
            icon: "info",
        });
    });

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
                if (response.success) {
                    location.href = response.redirect_url;
                } else {
                    location.reload();
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    });

    $("#forgot_password").click(function () {
        Swal.fire({
            title: "Forgot Password",
            text: "Please contact the administrator to reset your password.",
            icon: "info",
        });
    });

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
    });

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
                    $("#profile_image_preview").attr("src", "../public/img/uploads/" + response.image);
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
    });

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
            loading(true);

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
                    if (response) {
                        location.reload();
                    } else {
                        loading(false);

                        $("#profile_email").addClass("is-invalid");
                        $("#error_profile_email").removeClass("d-none");
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    });

    $("#profile_email").keydown(function () {
        $("#profile_email").removeClass("is-invalid");

        $("#error_profile_email").addClass("d-none");
    });

    $("#profile_password").keydown(function () {
        $("#profile_password").removeClass("is-invalid");
        $("#profile_confirm_password").removeClass("is-invalid");

        $("#error_profile_password").addClass("d-none");
    });

    $("#profile_confirm_password").keydown(function () {
        $("#profile_password").removeClass("is-invalid");
        $("#profile_confirm_password").removeClass("is-invalid");

        $("#error_profile_password").addClass("d-none");
    });

    $("#upload_music_form").submit(function (e) {
        const title = $("#music_title").val();
        const artist = $.trim($("#artist_name").val() || "") || "Unknown Artist";
        const duration = $("#music_duration").val();
        const size = $("#music_size").val();
        const file = $("#music_file")[0].files[0];

        if (!file.type.startsWith('audio/')) {
            $("#music_file").addClass("is-invalid");
            $("#error_music_file").removeClass("d-none");
        } else {
            loading(true);

            const formData = new FormData();
            formData.append('title', title);
            formData.append('artist', artist);
            formData.append('duration', duration);
            formData.append('size', size);
            formData.append('file', file);

            const coverSrc = $("#music_image").attr("src");

            if (coverSrc && coverSrc.startsWith("data:")) {
                const byteString = atob(coverSrc.split(',')[1]);
                const mimeString = coverSrc.split(',')[0].split(':')[1].split(';')[0];
                const ab = new ArrayBuffer(byteString.length);
                const ia = new Uint8Array(ab);
                for (let i = 0; i < byteString.length; i++) {
                    ia[i] = byteString.charCodeAt(i);
                }
                const blob = new Blob([ab], { type: mimeString });
                formData.append('cover', blob, 'cover.png');
            } else {
                formData.append('cover', '');
            }

            $.ajax({
                url: '../upload_music',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        location.reload();
                    } else {
                        loading(false);
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                    loading(false);
                }
            });
        }
    });

    $("#music_file").on("change", function (event) {
        const file = event.target.files[0];

        if (file) {
            const fileSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            $('#music_size').val(fileSize);

            const audio = new Audio();
            audio.src = URL.createObjectURL(file);

            audio.onloadedmetadata = function () {
                const minutes = Math.floor(audio.duration / 60);
                const seconds = Math.floor(audio.duration % 60);
                const duration = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                $('#music_duration').val(duration);
            };

            jsmediatags.read(file, {
                onSuccess: function (tag) {
                    const title = tag.tags.title || '';
                    const artist = tag.tags.artist || '';
                    $('#music_title').val(title);
                    $('#artist_name').val(artist);

                    const picture = tag.tags.picture;
                    if (picture) {
                        let base64String = "";
                        for (let i = 0; i < picture.data.length; i++) {
                            base64String += String.fromCharCode(picture.data[i]);
                        }
                        const imageUri = "data:" + picture.format + ";base64," + btoa(base64String);
                        $('#music_image').attr('src', imageUri);
                    } else {
                        $('#music_image').attr('src', '../public/img/audio-placeholder.webp');
                    }

                    $('#album_art_container').show();
                },
                onError: function (error) {
                    $('#music_image').attr('src', '../public/img/audio-placeholder.webp');
                }
            });
        }
    });

    $(document).on("click", ".delete_music_btn", function () {
        const music_id = $(this).data("id");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                is_page_loading(true);

                var formData = new FormData();

                formData.append('music_id', music_id);

                $.ajax({
                    url: '../delete_music',
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response) {
                            location.reload();
                        }
                    },
                    error: function (_, _, error) {
                        console.error(error);
                    }
                });
            }
        })
    });

    $(document).on("click", ".play_music_btn", function () {
        const musicUrl = $(this).data("url");
        const playIcon = '<i class="bi bi-play-fill"></i>';
        const pauseIcon = '<i class="bi bi-stop-fill"></i>';

        if (currentAudioPlayer && currentButton.is(this)) {
            currentAudioPlayer.pause();
            currentAudioPlayer.currentTime = 0;
            currentAudioPlayer = null;
            currentButton.html(playIcon).attr("title", "Play Music");
            currentButton = null;
            return;
        }

        if (currentAudioPlayer) {
            currentAudioPlayer.pause();
            currentAudioPlayer.currentTime = 0;
            currentButton.html(playIcon).attr("title", "Play Music");
        }

        currentAudioPlayer = new Audio(musicUrl);
        currentAudioPlayer.play();
        $(this).html(pauseIcon).attr("title", "Stop Music");
        currentButton = $(this);

        currentAudioPlayer.onended = () => {
            currentButton.html(playIcon).attr("title", "Play Music");
            currentAudioPlayer = null;
            currentButton = null;
        };
    });

    $(document).on("click", ".edit_music_btn", function () {
        const music_id = $(this).data("id");

        loading(true);

        $("#edit_music_modal").modal("show");

        var formData = new FormData();
        formData.append('music_id', music_id);

        $.ajax({
            url: '../get_music_by_id',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    $("#edit_music_title").val(response.title);
                    $("#edit_artist_name").val(response.artist === "Unknown Artist" ? "" : response.artist);
                    $("#edit_music_duration").val(response.duration);
                    $("#edit_music_size").val(response.size);

                    $("#edit_music_id").val(response.id);

                    loading(false);
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    });

    $("#edit_music_form").submit(function () {
        const title = $("#edit_music_title").val();
        const artist = $.trim($("#edit_artist_name").val() || "") || "Unknown Artist";
        const duration = $("#edit_music_duration").val();
        const size = $("#edit_music_size").val();

        const id = $("#edit_music_id").val();

        loading(true);

        var formData = new FormData();

        formData.append('title', title);
        formData.append('artist', artist);
        formData.append('duration', duration);
        formData.append('size', size);

        formData.append('id', id);

        $.ajax({
            url: '../update_music',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    location.reload();
                } else {
                    loading(false);
                }
            },
            error: function (_, _, error) {
                console.error(error);
                loading(false);
            }
        });
    });

    $("#add_to_playlist_btn").click(function () {
        const table = $('#music_table').DataTable(); // Replace with your actual table ID

        // Get all checked checkboxes across all pages
        const selectedCheckboxes = table
            .rows({ search: 'applied' }) // or use `{}` to get all rows
            .nodes()
            .to$()
            .find('input[type="checkbox"]:checked');

        const selectedSongs = selectedCheckboxes.map(function () {
            const row = $(this).closest('tr');
            const songTitle = row.find('td:nth-child(2)').text().trim();
            return `<li class="list-group-item d-flex align-items-center">
                        <i class="bi bi-music-note-beamed text-primary me-2"></i> ${songTitle}
                    </li>`;
        }).get();

        const selectedIds = selectedCheckboxes.map(function () {
            return $(this).val();
        }).get().join(',');

        if (selectedSongs.length > 0) {
            $("#selectedSongs").html(selectedSongs.join('')).hide().fadeIn();
            $("#add_to_playlist_selected_song_ids").val(selectedIds);
            $("#songCount").text(selectedSongs.length);
            $("#add_to_playlist_modal").modal("show");
        } else {
            Swal.fire({
                icon: "warning",
                title: "No Music Selected",
                text: "Please select at least one music to add to the playlist.",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
            });
        }
    });

    $("#checkAllDays").change(function () {
        $(".day-checkbox").prop("checked", $(this).prop("checked"));
    });

    $(document).on("change", ".day-checkbox", function () {
        if ($(".day-checkbox:checked").length === $(".day-checkbox").length) {
            $("#checkAllDays").prop("checked", true);
        } else {
            $("#checkAllDays").prop("checked", false);
        }
    });

    $("#add_playlist_form").submit(function (e) {
        e.preventDefault();

        const name = $("#playlist_name").val();
        const start_time = $("#playlist_start_time").val();
        const end_time = $("#playlist_end_time").val();
        const selected_days = $(".day-checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        const time_range = start_time + " - " + end_time;

        const schedule = selected_days.map(day => {
            if (day.toLowerCase() === 'thursday') return 'Th';
            if (day.toLowerCase() === 'saturday') return 'Sa';
            if (day.toLowerCase() === 'sunday') return 'Su';
            return day.charAt(0).toUpperCase();
        }).join('-');

        const startTime = parseTimeToDate(start_time);
        const endTime = parseTimeToDate(end_time);

        if (startTime >= endTime) {
            $("#playlist_start_time").addClass("is-invalid");
            $("#playlist_end_time").addClass("is-invalid");
            $("#time_error_message").removeClass("d-none");
            return;
        } else {
            $("#playlist_start_time").removeClass("is-invalid");
            $("#playlist_end_time").removeClass("is-invalid");
            $("#time_error_message").addClass("d-none");
        }

        const conflict = existingPlaylists.find(playlist => {
            const existingDays = playlist.schedule.split('-');
            if (!daysOverlap(selected_days.map(d => {
                if (d.toLowerCase() === 'thursday') return 'Th';
                if (d.toLowerCase() === 'saturday') return 'Sa';
                if (d.toLowerCase() === 'sunday') return 'Su';
                return d.charAt(0).toUpperCase();
            }), existingDays)) {
                return false;
            }

            const [existingStartStr, existingEndStr] = playlist.time_range.split(' - ');
            const existingStart = parseTimeToDate(existingStartStr);
            const existingEnd = parseTimeToDate(existingEndStr);

            return hasTimeConflict(startTime, endTime, existingStart, existingEnd);
        });

        if (conflict) {
            showConflictError(conflict.name);
            return;
        }

        loading(true);

        const formData = new FormData();
        formData.append('name', name);
        formData.append('schedule', schedule);
        formData.append('time_range', time_range);

        $.ajax({
            url: '../add_playlist',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    location.reload();
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    });

    $("#playlist_start_time").on("input", function () {
        $("#playlist_start_time").removeClass("is-invalid");
        $("#playlist_end_time").removeClass("is-invalid");

        $("#time_error_message").addClass("d-none");
    });

    $("#playlist_end_time").on("input", function () {
        $("#playlist_start_time").removeClass("is-invalid");
        $("#playlist_end_time").removeClass("is-invalid");

        $("#time_error_message").addClass("d-none");
    });

    $("#add_to_playlist_form").submit(function () {
        const selected_song_ids = $("#add_to_playlist_selected_song_ids").val();
        const playlist_id = $("#add_to_playlist_playlist_id").val();

        loading(true);

        var formData = new FormData();

        formData.append('selected_song_ids', selected_song_ids);
        formData.append('playlist_id', playlist_id);

        $.ajax({
            url: '../add_to_playlist',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    location.reload();
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    });

    $(document).on("click", ".delete_playlist_btn", function () {
        const playlist_id = $(this).data("id");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                is_page_loading(true);

                var formData = new FormData();

                formData.append('playlist_id', playlist_id);

                $.ajax({
                    url: '../delete_playlist',
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response) {
                            location.reload();
                        }
                    },
                    error: function (_, _, error) {
                        console.error(error);
                    }
                });
            }
        })
    });

    $(document).on("click", ".edit_playlist_btn", function () {
        const playlist_id = $(this).data("id");

        loading(true);

        $("#edit_playlist_modal").modal("show");

        var formData = new FormData();
        formData.append('playlist_id', playlist_id);

        $.ajax({
            url: '../get_playlist_by_id',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    $(".day-checkbox").prop("checked", false);

                    const schedule = response.schedule.split("-").map(day => {
                        if (day === 'M') return 'Monday';
                        if (day === 'T') return 'Tuesday';
                        if (day === 'W') return 'Wednesday';
                        if (day === 'Th') return 'Thursday';
                        if (day === 'F') return 'Friday';
                        if (day === 'Sa') return 'Saturday';
                        if (day === 'Su') return 'Sunday';
                        return day.charAt(0).toUpperCase() + day.slice(1).toLowerCase();
                    });

                    const selectedDays = [];

                    schedule.forEach(dayRange => {
                        if (dayRange.includes('-')) {
                            const [startDay, endDay] = dayRange.split('-');
                            let currentDay = startDay;
                            while (currentDay !== endDay) {
                                selectedDays.push(currentDay);
                                currentDay = getNextDay(currentDay);
                            }
                            selectedDays.push(endDay);
                        } else {
                            selectedDays.push(dayRange);
                        }
                    });

                    selectedDays.forEach(day => {
                        const checkbox = document.getElementById(`edit_${day.toLowerCase()}`);
                        if (checkbox) {
                            checkbox.checked = true;
                        }
                    });

                    const time_range = response.time_range.split(" - ");
                    const start_time = time_range[0];
                    const end_time = time_range[1];

                    $("#edit_playlist_name").val(response.name);
                    $("#edit_playlist_start_time").val(start_time);
                    $("#edit_playlist_end_time").val(end_time);
                    $("#edit_playlist_id").val(response.id);

                    loading(false);
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    });

    $("#edit_checkAllDays").change(function () {
        $(".edit-day-checkbox").prop("checked", $(this).prop("checked"));
    });

    $(".edit-day-checkbox").change(function () {
        if ($(".edit-day-checkbox:checked").length === $(".edit-day-checkbox").length) {
            $("#edit_checkAllDays").prop("checked", true);
        } else {
            $("#edit_checkAllDays").prop("checked", false);
        }
    });

    $("#edit_playlist_form").submit(function (e) {
        e.preventDefault();

        const playlist_id = $("#edit_playlist_id").val();
        const name = $("#edit_playlist_name").val();
        const start_time = $("#edit_playlist_start_time").val();
        const end_time = $("#edit_playlist_end_time").val();
        const selected_days = $(".edit-day-checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        const time_range = start_time + " - " + end_time;

        const schedule = selected_days.map(day => {
            if (day.toLowerCase() === 'thursday') return 'Th';
            if (day.toLowerCase() === 'saturday') return 'Sa';
            if (day.toLowerCase() === 'sunday') return 'Su';
            return day.charAt(0).toUpperCase();
        }).join('-');

        const startTime = parseTimeToDate(start_time);
        const endTime = parseTimeToDate(end_time);

        if (startTime >= endTime) {
            $("#edit_playlist_start_time").addClass("is-invalid");
            $("#edit_playlist_end_time").addClass("is-invalid");
            $("#edit_time_error_message").removeClass("d-none");
            return;
        } else {
            $("#edit_playlist_start_time").removeClass("is-invalid");
            $("#edit_playlist_end_time").removeClass("is-invalid");
            $("#edit_time_error_message").addClass("d-none");
        }

        const conflict = existingPlaylists.find(playlist => {
            if (playlist.id == playlist_id) return false;

            const existingDays = playlist.schedule.split('-');
            const newDays = selected_days.map(d => {
                if (d.toLowerCase() === 'thursday') return 'Th';
                if (d.toLowerCase() === 'saturday') return 'Sa';
                if (d.toLowerCase() === 'sunday') return 'Su';
                return d.charAt(0).toUpperCase();
            });

            if (!daysOverlap(newDays, existingDays)) return false;

            const [existingStartStr, existingEndStr] = playlist.time_range.split(' - ');
            const existingStart = parseTimeToDate(existingStartStr);
            const existingEnd = parseTimeToDate(existingEndStr);

            return hasTimeConflict(startTime, endTime, existingStart, existingEnd);
        });

        if (conflict) {
            showConflictError(conflict.name);
            return;
        }

        // No conflicts, proceed
        loading(true);

        const formData = new FormData();
        formData.append('playlist_id', playlist_id);
        formData.append('name', name);
        formData.append('schedule', schedule);
        formData.append('time_range', time_range);

        $.ajax({
            url: '../edit_playlist',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    location.reload();
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    });

    $("#live_streaming").click(function () {
        is_page_loading(true);

        $.ajax({
            url: '../live_streaming',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    location.reload();
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    });

    $("#public_page").click(function () {
        window.open(base_url, '_blank');
        location.reload();
    });

    $("#server_music_player").click(function () {
        window.open("server_music_player", '_blank');
        location.reload();
    });

    $(document).on("click", ".view-playlists", function () {
        $("#view_playlists_modal").modal("show");
    });

    $("#more_info_current_listeners").click(function () {
        $("#more_info_current_listeners_modal").modal("show");

        loading(true);

        $.ajax({
            url: '../get_current_listeners_data',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                const tableId = "current_listeners_table";
                const $table = $("#" + tableId);
                const tableElem = $table.get(0); // raw DOM element

                // Safely destroy existing DataTable if already initialized
                if ($.fn.DataTable.isDataTable(tableElem)) {
                    $table.DataTable().clear().destroy();
                }

                $table.find("tbody").empty();

                response.forEach(function (listener) {
                    const ip = listener.ip_address;
                    const userAgent = listener.user_agent;

                    const lastActivity = new Date(listener.last_activity.replace(' ', 'T'));
                    const humanReadable = lastActivity.toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true
                    });

                    $table.find("tbody").append(`
                        <tr>
                            <td>${ip}</td>
                            <td>${userAgent}</td>
                            <td>${humanReadable}</td>
                        </tr>
                    `);
                });

                // Initialize DataTable cleanly
                $table.DataTable({
                    responsive: true,
                    autoWidth: false,
                    lengthChange: false,
                    paging: true,
                    searching: true,
                    ordering: false,
                    info: true,
                });

                loading(false);
            },
            error: function (_, _, error) {
                console.error(error);
                loading(false);
            }
        });
    });


    $("#more_info_unique_listeners").click(function () {
        $("#more_info_unique_listeners_modal").modal("show");

        loading(true);

        $.ajax({
            url: '../get_unique_listeners_data',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                const $table = $("#unique_listeners_table");

                // Destroy previous DataTable if exists
                if ($.fn.DataTable.isDataTable($table)) {
                    $table.DataTable().clear().destroy();
                }

                $table.find("tbody").empty();

                if (response.length > 0) {
                    response.forEach(function (listener) {
                        const ip = listener.ip_address;
                        const userAgent = listener.user_agent;

                        const lastActivity = new Date(listener.last_activity.replace(' ', 'T'));
                        const humanReadable = lastActivity.toLocaleString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: 'numeric',
                            minute: '2-digit',
                            hour12: true
                        });

                        $table.find("tbody").append(`
                            <tr>
                                <td>${ip}</td>
                                <td>${userAgent}</td>
                                <td>${humanReadable}</td>
                            </tr>
                        `);
                    });
                } else {
                    $table.find("tbody").append(`
                        <tr>
                            <td colspan="3" class="text-center">No unique listeners</td>
                        </tr>
                    `);
                }

                // Initialize or reinitialize DataTable
                $table.DataTable({
                    responsive: true,
                    autoWidth: false,
                    lengthChange: false,
                    paging: true,
                    searching: true,
                    ordering: false,
                    info: true,
                });

                loading(false);
            },
            error: function (_, _, error) {
                console.error(error);
                loading(false);
            }
        });
    });

    $("#more_info_storage_usage").click(function () {
        const storageUsage = $("#storage_usage").text();
        const totalStorage = 30 * 1024;
        const usedStorage = parseFloat(totalStorage * (storageUsage / 100)).toFixed(2);
        const freeStorage = parseFloat(totalStorage - usedStorage).toFixed(2);

        Swal.fire({
            title: 'Storage Usage',
            html: `
                <div class="text-center">
                    <p>Total Storage: <strong>${(totalStorage / 1024).toFixed(2)} GB</strong></p>
                    <p>Used Storage: <strong>${(usedStorage / 1024).toFixed(2)} GB</strong></p>
                    <p>Free Storage: <strong>${(freeStorage / 1024).toFixed(2)} GB</strong></p>
                </div>
            `,
            icon: 'info',
            confirmButtonColor: '#0d6efd',
        });
    })

    function fetchCounts(callback) {
        $.ajax({
            url: '../get_current_listeners',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: (data) => {
                if (data && data.current_listeners != null) {
                    $('#current_listeners').text(data.current_listeners);
                    if (callback) callback(data.current_listeners);
                }
            },
            error: () => {
                console.error('Error fetching listener counts');
                if (callback) callback(0); // Optional: fallback to 0
            },
        });
    }

    function fetchUniqueListeners() {
        $.ajax({
            url: '../get_unique_listeners',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: (data) => {
                if (data && data.unique_listeners != null) {
                    $('#unique_listeners').text(data.unique_listeners);
                }
            },
            error: (err) => {
                console.error('Error fetching unique listeners:', err);
            }
        });
    }

    function display_chart() {
        let data = [];
        let categories = [];
        let pendingSamples = [];

        // Retrieve previous chart data from localStorage if it exists
        const savedData = localStorage.getItem('listenerData');
        if (savedData) {
            const parsedData = JSON.parse(savedData);
            data = parsedData.data || [];
            categories = parsedData.categories || [];
        }

        const chart = new ApexCharts(document.querySelector("#listeners-chart"), {
            series: [{ name: 'Current Listeners', data: data }],
            chart: {
                height: 300,
                type: 'area',
                toolbar: { show: false },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: { speed: 500 }
                }
            },
            title: {
                text: 'Live Listeners Over Time',
                align: 'left',
                style: { fontSize: '16px', fontWeight: 'bold' }
            },
            colors: ['#0d6efd'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth' },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                type: 'datetime',
                categories: categories
            },
            yaxis: {
                title: { text: 'Listeners' },
                min: 0,
                max: 5  // Default max value
            },
            tooltip: {
                x: { format: 'HH:mm:ss' }
            },
            responsive: [{
                breakpoint: 768,
                options: { chart: { height: 250 } }
            }]
        });

        chart.render();

        // 1️⃣ Sample every 1 second
        setInterval(() => {
            fetchCounts((count) => {
                pendingSamples.push(count);

                // Optional: keep buffer short
                if (pendingSamples.length > 10) {
                    pendingSamples.shift();
                }

                $('#current_listeners').text(count); // Still show real-time
            });

            fetchUniqueListeners();
        }, 1000);

        // 2️⃣ Every 5 seconds, push averaged/max count to chart
        setInterval(() => {
            if (pendingSamples.length === 0) return;

            // Use MAX for reliability (or use average if you prefer)
            const reliableCount = Math.max(...pendingSamples);
            const now = new Date().toISOString();

            data.push(reliableCount);
            categories.push(now);

            if (data.length > 24) {
                data.shift();
                categories.shift();
            }

            // Set Y-Axis max value based on current max data
            const currentMax = Math.max(...data);
            const yAxisMax = Math.ceil(currentMax * 1.5); // Increase by 50%
            chart.updateOptions({
                yaxis: { max: yAxisMax }
            });

            chart.updateOptions({ xaxis: { categories } });
            chart.updateSeries([{ data }]);

            // Save updated data to localStorage
            localStorage.setItem('listenerData', JSON.stringify({ data, categories }));

            // Clear for next batch
            pendingSamples = [];
        }, 5000);
    }

    function parseTimeToDate(timeStr) {
        const [hours, minutes] = timeStr.split(":").map(Number);

        return new Date(1970, 0, 1, hours, minutes);
    }

    function hasTimeConflict(newStart, newEnd, existingStart, existingEnd) {
        return newStart < existingEnd && newEnd > existingStart;
    }

    function daysOverlap(newDays, existingDays) {
        return newDays.some(day => existingDays.includes(day));
    }

    function showConflictError(conflictingPlaylistName) {
        alert(`Conflict detected with existing playlist: ${conflictingPlaylistName}`);
    }

    function getNextDay(currentDay) {
        const daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        const index = daysOfWeek.indexOf(currentDay);

        return daysOfWeek[(index + 1) % 7];
    }

    function is_page_loading(enabled) {
        if (enabled) {
            is_page_ready = false;

            $('#loading-overlay').addClass('d-flex').removeClass('d-none');
        } else {
            is_page_ready = true;

            $('#loading-overlay').removeClass('d-flex').addClass('d-none');
        }
    }

    function toggleButtons() {
        if ($('.table tbody input[type="checkbox"]').filter(':checked').length > 0) {
            $('#upload_music_btn').prop('disabled', true);
            $('#add_to_playlist_btn').removeClass('d-none');
        } else {
            $('#upload_music_btn').prop('disabled', false);
            $('#add_to_playlist_btn').addClass('d-none');
        }
    }

    function display_notification(notification) {
        Swal.fire({
            title: notification.title,
            text: notification.text,
            icon: notification.icon,
            confirmButtonColor: '#0d6efd'
        });
    }

    function loading(enabled) {
        if (enabled) {
            $(".main-form").addClass("d-none");
            $(".loading").removeClass("d-none");
            $(".btn-submit").attr("disabled", true);

            is_form_submitting = true;
        } else {
            $(".main-form").removeClass("d-none");
            $(".loading").addClass("d-none");
            $(".btn-submit").attr("disabled", false);

            is_form_submitting = false;
        }
    }

    function preventDevTools(enable) {
        if (!enable) return;

        document.addEventListener('contextmenu', (e) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Right click is disabled for security reasons.'
            });

            e.preventDefault()
        });

        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) || e.ctrlKey && (e.key === 'u' || e.key === 's' || e.key === 'p') || e.key === 'F12') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'DevTools is disabled for security reasons.'
                });

                e.preventDefault();
            }
        });

        setInterval(() => {
            const devtools = window.outerWidth - window.innerWidth > 160 || window.outerHeight - window.innerHeight > 160;

            if (devtools) {
                console.clear();

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'DevTools is disabled for security reasons.'
                });
            }
        }, 1000);
    }

    function preventMobileAccess() {
        if (/Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
            document.body.innerHTML = `
            <div style="display: flex; height: 100vh; align-items: center; justify-content: center; background-color: #f8d7da; color: #721c24; text-align: center; padding: 20px; font-family: Arial, sans-serif;">
                <div>
                    <h1 style="font-size: 3rem;">Access Denied</h1>
                    <p style="font-size: 1.5rem;">This page is not accessible on mobile devices.</p>
                </div>
            </div>`;
        }
    }
})