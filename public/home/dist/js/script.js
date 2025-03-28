jQuery(document).ready(function () {
    preventDevTools(false);

    const container = document.getElementById('progress-bars');
    const totalBars = 25;
    const bars = [];

    for (let i = 0; i < totalBars; i++) {
        const bar = document.createElement('div');
        bar.className = 'progress-bar';

        const pulseDuration = (Math.random() * 1 + 1).toFixed(2);
        const colorDuration = (Math.random() * 2 + 1).toFixed(2);
        const delay = (Math.random() * 1).toFixed(2);

        bar.style.animation = `pulse ${pulseDuration}s ease-in-out infinite, colorChange ${colorDuration}s linear infinite`;
        bar.style.animationDelay = `${delay}s`;

        bars.push(bar);
        container.appendChild(bar);
    }

    let mode = 0;
    setInterval(() => {
        mode = (mode + 1) % 5;

        bars.forEach(bar => {
            bar.classList.remove('uniform', 'uniform-alt', 'uniform-green', 'uniform-pink');

            if (mode === 1) {
                bar.classList.add('uniform');
            } else if (mode === 2) {
                bar.classList.add('uniform-alt');
            } else if (mode === 3) {
                bar.classList.add('uniform-green');
            } else if (mode === 4) {
                bar.classList.add('uniform-pink');
            }
        });
    }, 5000);
    
    
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

    

    
    
})