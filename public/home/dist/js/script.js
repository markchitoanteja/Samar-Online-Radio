$(document).ready(function () {
    let songData = null;
    let lastTimestamp = 0;
    let audioPlayer = null;
    let is_muted = false;

    startSync();
    is_page_loading(false);
    preventDevTools(false);

    $("#current_year").text(new Date().getFullYear());

    $(".no-function").click(function () {
        Swal.fire({
            title: "No Function",
            text: "This function is not available yet.",
            icon: "info",
        });
    })

    $("#playPauseButton").click(function () {
        if (!songData) return;

        is_page_loading(true);

        let { filename, currentProgress } = songData;
        let file_location = filename === "default_song.mp3" ? "public/songs/" : "public/songs/uploads/";

        if (!audioPlayer) {
            audioPlayer = new Audio(file_location + filename);
            audioPlayer.currentTime = currentProgress;

            audioPlayer.play().then(() => {
                $("#playPauseButton")
                    .removeClass("bi-play-fill")
                    .addClass("bi-stop-fill");

                is_page_loading(false);
            }).catch(error => {
                console.error("Audio play failed:", error);

                if (error.name === "NotAllowedError") {
                    $("#playPauseButton")
                        .removeClass("bi-stop-fill")
                        .addClass("bi-play-fill");
                }

                is_page_loading(false);
            });

            audioPlayer.addEventListener("ended", function () {
                fetchSongData();
                if (songData) {
                    let { filename, currentProgress } = songData;
                    if (audioPlayer.src !== file_location + filename) {
                        audioPlayer.src = file_location + filename;
                        audioPlayer.currentTime = currentProgress;
                        audioPlayer.play().catch(error => {
                            console.error("Audio replay failed:", error);
                        });
                    }
                }
            });
        } else {
            if (audioPlayer.paused) {
                audioPlayer.currentTime = songData.currentProgress;

                audioPlayer.play().then(() => {
                    $("#playPauseButton")
                        .removeClass("bi-play-fill")
                        .addClass("bi-stop-fill");

                    is_page_loading(false);
                }).catch(error => {
                    console.error("Audio resume failed:", error);

                    if (error.name === "NotAllowedError") {
                        $("#playPauseButton")
                            .removeClass("bi-stop-fill")
                            .addClass("bi-play-fill");
                    }

                    is_page_loading(false);
                });
            } else {
                audioPlayer.pause();
                audioPlayer = null;

                $("#playPauseButton")
                    .removeClass("bi-stop-fill")
                    .addClass("bi-play-fill");

                is_page_loading(false);
            }
        }
    })

    $("#muteButton").click(function () {
        if (audioPlayer && !is_muted) {
            audioPlayer.muted = !audioPlayer.muted;

            $("#muteButton").toggleClass("bi-volume-up-fill bi-volume-mute-fill");
        }
    })

    $("#volume").on("input", function () {
        if (audioPlayer) {
            audioPlayer.volume = $("#volume").val();

            // Check if the volume is zero
            if (audioPlayer.volume == 0) {
                is_muted = true;

                $("#muteButton")
                    .removeClass("bi-volume-up-fill")
                    .addClass("bi-volume-mute-fill")
                    .css("cursor", "not-allowed");  // Optional: Change cursor to indicate it's disabled
            } else {
                // Revert the icon and enable the button
                is_muted = false;

                $("#muteButton")
                    .removeClass("bi-volume-mute-fill")
                    .addClass("bi-volume-up-fill")
                    .css("cursor", "pointer");  // Optional: Change cursor to indicate it's enabled
            }
        }
    })

    $('#album_art').on('click', function () {
        const src = $(this).attr('src');

        $('#modalImage').attr('src', src);
        $('#full_image_modal').modal('show');
    })

    $('#full_image_modal').on('click', function () {
        $('#full_image_modal').modal('hide');
    })

    let lastSongId = null;

    function fetchSongData() {
        $.getJSON('public/data/audio_data.json?t=' + new Date().getTime(), function (data) {
            if (!songData || data.timestamp !== lastTimestamp) {
                songData = data;
                lastTimestamp = data.timestamp;

                // Check if song changed
                if (songData.songTitle !== lastSongId) {
                    lastSongId = songData.songTitle;
                    updateSongMetadata(); // Run only once per song
                }

                updateSongProgress(); // Run every second

                if (songData["is_playing"] === "false") {
                    $("#playPauseButton").removeClass("bi-stop-fill").addClass("bi-play-fill");
                }
            }
        }).fail(function (error) {
            console.error("Error fetching song data:", error);
        });
    }

    function updateSongMetadata() {
        let { songTitle, artist, image } = songData;

        $("#songTitle").text(songTitle);
        $("#artist_name").text(artist);
        $("#album_art").attr("src", image);

        $(".song-name").each(function () {
            if (this.offsetWidth < this.scrollWidth || this.offsetHeight < this.scrollHeight) {
                $(".ellipsis-container").css("cursor", "pointer");
            }
        });
    }

    function updateSongProgress() {
        if (!songData) return;

        let { duration, currentProgress } = songData;

        $("#duration").text(formatTime(duration));
        $("#currentTime").text(formatTime(currentProgress));

        updateProgressBar(duration, currentProgress);
    }

    function updateProgressBar(duration, currentProgress) {
        let progressPercentage = (currentProgress / duration) * 100;
        $("#progressBar").css("width", progressPercentage + "%");
        $("#currentTime").text(formatTime(currentProgress));
    }

    function startSync() {
        setInterval(fetchSongData, 1000);
    }

    function formatTime(seconds) {
        let minutes = Math.floor(seconds / 60);
        let secs = Math.floor(seconds % 60);
        return minutes + ":" + (secs < 10 ? "0" : "") + secs;
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

    function is_page_loading(enabled) {
        if (enabled) {
            $('#loading-overlay').addClass('d-flex').removeClass('d-none');
        } else {
            $('#loading-overlay').removeClass('d-flex').addClass('d-none');
        }
    }
});