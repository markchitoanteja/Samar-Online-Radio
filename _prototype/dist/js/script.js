$(document).ready(function () {
    let playPauseButton = $("#playPauseButton");
    let muteButton = $("#muteButton");
    let songTitleElement = $("#songTitle");
    let progressBar = $("#progressBar");
    let currentTimeDisplay = $("#currentTime");
    let durationDisplay = $("#duration");
    let volumeControl = $("#volume");

    let songData = null;
    let lastTimestamp = 0;
    let audioPlayer = null;

    getCurrentYear();

    function getCurrentYear() {
        const currentYear = new Date().getFullYear();

        $("#currentYear").text(currentYear);
    }

    function fetchSongData() {
        $.getJSON('data/audio_data.json?t=' + new Date().getTime(), function (data) {
            if (!songData || data.timestamp !== lastTimestamp) {
                songData = data;
                lastTimestamp = data.timestamp;
                updateUI();

                if (songData["is_playing"] === "false") {
                    playPauseButton.removeClass("fa-stop").addClass("fa-play");
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
            duration,
            currentProgress
        } = songData;

        songTitleElement.text(songTitle);

        if (songTitle.length > 20) {
            songTitleElement.addClass("marquee");
        } else {
            songTitleElement.removeClass("marquee");
        }

        durationDisplay.text(formatTime(duration));
        currentTimeDisplay.text(formatTime(currentProgress));

        updateProgressBar();
    }

    function updateProgressBar() {
        if (!songData) return;

        let {
            duration,
            currentProgress
        } = songData;
        let progressPercentage = (currentProgress / duration) * 100;
        progressBar.css("width", progressPercentage + "%");
        currentTimeDisplay.text(formatTime(currentProgress));
    }

    function startSync() {
        setInterval(fetchSongData, 1000);
    }

    playPauseButton.click(function () {
        if (!songData) return;

        let {
            filename,
            currentProgress
        } = songData;

        if (!audioPlayer) {
            audioPlayer = new Audio("dist/uploads/" + filename);
            audioPlayer.currentTime = currentProgress;
            audioPlayer.play();
            playPauseButton.removeClass("fa-play").addClass("fa-stop");

            audioPlayer.addEventListener("ended", function () {
                fetchSongData();
                if (songData) {
                    let {
                        filename,
                        currentProgress
                    } = songData;

                    if (audioPlayer.src !== "dist/uploads/" + filename) {
                        audioPlayer.src = "dist/uploads/" + filename;
                        audioPlayer.currentTime = currentProgress;
                        audioPlayer.play();
                    }
                }
            });
        } else {
            if (audioPlayer.paused) {
                audioPlayer.currentTime = songData.currentProgress;
                audioPlayer.play();
                playPauseButton.removeClass("fa-play").addClass("fa-stop");
            } else {
                audioPlayer.pause();
                audioPlayer = null;
                playPauseButton.removeClass("fa-stop").addClass("fa-play");
            }
        }
    });

    muteButton.click(function () {
        if (audioPlayer) {
            audioPlayer.muted = !audioPlayer.muted;
            muteButton.toggleClass("fa-volume-up fa-volume-mute");
        }
    });

    volumeControl.on("input", function () {
        if (audioPlayer) {
            audioPlayer.volume = volumeControl.val();
        }
    });

    function formatTime(seconds) {
        let minutes = Math.floor(seconds / 60);
        let secs = Math.floor(seconds % 60);
        return minutes + ":" + (secs < 10 ? "0" : "") + secs;
    }

    startSync();
});