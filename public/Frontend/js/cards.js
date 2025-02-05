document.addEventListener('DOMContentLoaded', () => {
    const sliders = document.querySelectorAll('.card__container');

    sliders.forEach((slider) => {
        const track = slider.querySelector('.slider-track');
        const nextButton = slider.querySelector('.slider-btn.next');
        const prevButton = slider.querySelector('.slider-btn.prev');
        const cards = slider.querySelectorAll('.card__article');

        let currentIndex = 0;

        // Dynamically calculate card width (including margin)
        const cardWidth = cards[0].getBoundingClientRect().width;

        nextButton.addEventListener('click', () => {
            if (currentIndex < cards.length - 4) { // Show 4 cards at a time
                currentIndex++;
                track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
            }
        });

        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
            }
        });
    });

    // View More Button
    // document.querySelectorAll('.view-more-btn').forEach((btn) => {
    //     btn.addEventListener('click', (e) => {
    //         e.preventDefault();
    //         alert('View more content or load additional items here.');
    //     });
    // });
});