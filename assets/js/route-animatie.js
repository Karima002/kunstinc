document.addEventListener('DOMContentLoaded', () => {
    console.log('javascript is er')
    const path = document.getElementById('line2');

    if (path) {
        const length = path.getTotalLength();
        path.style.strokeDasharray = length;
        path.style.strokeDashoffset = length;
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const section = document.querySelector('.section-route-animatie');
    const paths = section.querySelectorAll('.dash-animation, .dash-animation2');
    const icons = section.querySelectorAll('.appear');

    const checkVisibility = () => {
        const rect = section.getBoundingClientRect();
        const windowHeight = (window.innerHeight || document.documentElement.clientHeight);

        // Check if the section is visible
        if (
            rect.top <= windowHeight &&
            rect.bottom >= 0
        ) {
            // Start the animations
            paths.forEach(path => {
                path.style.animationPlayState = 'running';
            });

            icons.forEach(icon => {
                icon.style.animationPlayState = 'running';
            });

            // Remove the event listener once the animation starts
            window.removeEventListener('scroll', checkVisibility);
        }
    };

    // Add the event listener
    window.addEventListener('scroll', checkVisibility);
    // Check visibility on load in case the section is already in view
    checkVisibility();
});


