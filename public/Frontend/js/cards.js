document.addEventListener('DOMContentLoaded', () => {
    const track = document.querySelector('.slider-track');
    const nextButton = document.querySelector('.slider-btn.next');
    const prevButton = document.querySelector('.slider-btn.prev');

    let currentIndex = 0;
    const cards = document.querySelectorAll('.card__article');
    const cardWidth = cards[0].getBoundingClientRect().width + 32; // Adjust for gap

    nextButton.addEventListener('click', () => {
      if (currentIndex < cards.length - 4) {
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

  document.querySelector('.view-more-btn').addEventListener('click', (e) => {
    e.preventDefault();
    alert("View more content or load additional items here.");
  });