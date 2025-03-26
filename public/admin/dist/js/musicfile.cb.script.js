
document.addEventListener("DOMContentLoaded", function () {
    const titleInput = document.getElementById('music_title');
    const fileInput = document.getElementById('music_file');

    let fileExtension = "";

    // When a file is selected
    fileInput.addEventListener('change', function () {
        const file = fileInput.files[0];
        if (!file) return;

        fileExtension = "." + file.name.split('.').pop(); // Get and store extension
        const currentTitle = titleInput.value.trim();

        if (currentTitle === "") {
            // If title is empty, set it from the filename (without extension)
            const nameOnly = file.name.replace(/\.[^/.]+$/, "");
            titleInput.value = nameOnly + fileExtension;
        } else {
            // Only add extension if it's not already at the end
            if (!currentTitle.endsWith(fileExtension)) {
                titleInput.value = currentTitle + fileExtension;
            }
        }

        // Place cursor before the extension
        const pos = titleInput.value.length - fileExtension.length;
        titleInput.setSelectionRange(pos, pos);
    });

    // When the user types in the title
    titleInput.addEventListener('input', function () {
        if (!fileExtension) return;

        // Remove the current extension if it's there (avoid duplicates)
        let typed = titleInput.value.replace(fileExtension, "");
        titleInput.value = typed + fileExtension;

        // Lock the cursor before the extension
        const pos = typed.length;
        titleInput.setSelectionRange(pos, pos);
    });
});
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

