jQuery(document).ready(function () {
    const $container = $('#progress-bars');
    const totalBars = 25;
    const bars = [];
    let mode = 0;
    let songData = null;
    let lastTimestamp = 0;
    let audioPlayer = null;

    startSync();
    is_page_loading(false);
    preventDevTools(false);

    for (let i = 0; i < totalBars; i++) {
        const $bar = $('<div></div>');
        $bar.addClass('progress-bar');

        const pulseDuration = (Math.random() * 1 + 1).toFixed(2);
        const colorDuration = (Math.random() * 2 + 1).toFixed(2);
        const delay = (Math.random() * 1).toFixed(2);

        $bar.css({
            animation: `pulse ${pulseDuration}s ease-in-out infinite, colorChange ${colorDuration}s linear infinite`,
            animationDelay: `${delay}s`
        });

        bars.push($bar);
        $container.append($bar);
    }

    setInterval(() => {
        mode = (mode + 1) % 5;

        bars.forEach($bar => {
            $bar.removeClass('uniform uniform-alt uniform-green uniform-pink');

            if (mode === 1) {
                $bar.addClass('uniform');
            } else if (mode === 2) {
                $bar.addClass('uniform-alt');
            } else if (mode === 3) {
                $bar.addClass('uniform-green');
            } else if (mode === 4) {
                $bar.addClass('uniform-pink');
            }
        });
    }, 5000);

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
            audioPlayer = new Audio("public/songs/uploads/" + filename);
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

                    if (audioPlayer.src !== "public/songs/uploads/" + filename) {
                        audioPlayer.src = "public/songs/uploads/" + filename;
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
