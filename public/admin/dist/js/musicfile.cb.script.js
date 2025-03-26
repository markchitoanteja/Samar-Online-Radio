document.getElementById('music_file').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (!file) return;

    const audio = document.getElementById('audio_preview');
    const objectURL = URL.createObjectURL(file);
    audio.src = objectURL;

    // Get file size
    const sizeInMB = file.size / (1024 * 1024);
    const sizeFormatted = sizeInMB >= 1 
        ? `${sizeInMB.toFixed(2)} MB` 
        : `${(file.size / 1024).toFixed(2)} KB`;

    // Set file size
    document.getElementById('display_size').value = sizeFormatted;
    document.getElementById('music_size').value = sizeFormatted;

    // Wait for metadata to load
    audio.onloadedmetadata = function () {
        const duration = audio.duration;
        const minutes = Math.floor(duration / 60);
        const seconds = Math.floor(duration % 60).toString().padStart(2, '0');
        const formattedDuration = `${minutes}:${seconds}`;

        document.getElementById('display_duration').value = formattedDuration;
        document.getElementById('music_duration').value = formattedDuration;

        URL.revokeObjectURL(objectURL); // cleanup
    };
});