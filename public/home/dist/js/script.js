jQuery(document).ready(function () {
    const $container = $('#progress-bars');
    const totalBars = 25;
    const bars = [];
    let mode = 0;
    const musicPlayer = document.getElementById('music_player');

    preventDevTools(true);

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

    if (musicPlayer) {
        musicPlayer.onload = () => {
            is_page_loading(false);
        };
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
