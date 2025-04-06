$(document).ready(function () {
    let songData = null;
    let lastTimestamp = 0;
    let audioPlayer = null;

    startSync();
    syncAudioAtTopOfHour();
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

        let {
            filename,
            currentProgress
        } = songData;

        if (!audioPlayer) {
            let file_location = filename === "default_song.mp3" ? "public/songs/" : "public/songs/uploads/";

            audioPlayer = new Audio(file_location + filename);
            audioPlayer.currentTime = currentProgress;
            audioPlayer.play();

            $("#playPauseButton").removeClass("bi-play-fill").addClass("bi-stop-fill");

            audioPlayer.addEventListener("ended", function () {
                fetchSongData();
                if (songData) {
                    let {
                        filename,
                        currentProgress
                    } = songData;

                    if (audioPlayer.src !== file_location + filename) {
                        audioPlayer.src = file_location + filename;
                        audioPlayer.currentTime = currentProgress;
                        audioPlayer.play();
                    }
                }
            });
        } else {
            if (audioPlayer.paused) {
                audioPlayer.currentTime = songData.currentProgress;
                audioPlayer.play();

                $("#playPauseButton").removeClass("bi-play-fill").addClass("bi-stop-fill");
            } else {
                audioPlayer.pause();
                audioPlayer = null;

                $("#playPauseButton").removeClass("bi-stop-fill").addClass("bi-play-fill");
            }
        }
    })

    $("#muteButton").click(function () {
        if (audioPlayer) {
            audioPlayer.muted = !audioPlayer.muted;

            $("#muteButton").toggleClass("bi-volume-up-fill bi-volume-mute-fill");
        }
    })

    $("#volume").on("input", function () {
        if (audioPlayer) {
            audioPlayer.volume = $("#volume").val();
        }
    })

    function syncAudioAtTopOfHour() {
        setInterval(() => {
            const now = new Date();
            const currentHour = now.getHours();

            if (now.getMinutes() === 0 && now.getSeconds() === 0 && lastTriggerHour !== currentHour) {
                location.reload();
            }
        }, 1000);
    }

    function fetchSongData() {
        $.getJSON('public/data/audio_data.json?t=' + new Date().getTime(), function (data) {
            if (!songData || data.timestamp !== lastTimestamp) {
                songData = data;
                lastTimestamp = data.timestamp;
                updateUI();

                if (songData["is_playing"] === "false") {
                    $("#playPauseButton").removeClass("bi-stop-fill").addClass("bi-play-fill");
                }
            }
        }).fail(function (error) {
            console.error("Error fetching song data:", error);
        });
    }

    function updateUI() {
        if (!songData) return;

        let {
            songTitle,
            artist,
            duration,
            currentProgress
        } = songData;

        $("#songTitle").text(songTitle);
        $("#artist_name").text(artist);

        if (songTitle.length > 20) {
            $("#songTitle").addClass("marquee");
        } else {
            $("#songTitle").removeClass("marquee");
        }

        $("#duration").text(formatTime(duration));
        $("#currentTime").text(formatTime(currentProgress));

        updateProgressBar();
    }

    function updateProgressBar() {
        if (!songData) return;

        let {
            duration,
            currentProgress
        } = songData;

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