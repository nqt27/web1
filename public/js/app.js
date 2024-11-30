window.addEventListener('scroll', function () {
    const bannerVideo = document.getElementById('banner-video');
    const header = document.querySelector('header');

    if (window.scrollY > 50) {
        bannerVideo.classList.add('hidden');
        header.style.backgroundColor = 'rgba(36, 36, 36, 1)';
    } else {
        bannerVideo.classList.remove('hidden');
        header.style.backgroundColor = 'rgba(36, 36, 36, 0)';
    }


    const backToTopButton = document.getElementById('back-to-top');

    if (window.scrollY > 100) {
        backToTopButton.classList.add('show');
    } else {
        backToTopButton.classList.remove('show');
    }
});


// Scroll to top when button is clicked
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Smooth scroll to top
    });
}
