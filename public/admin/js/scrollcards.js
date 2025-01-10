const scrollContainer = document.getElementById('scrollContainer');

function scrollLeft() {
  scrollContainer.scrollBy({ left: -300, behavior: 'smooth' });
}

function scrollRight() {
  scrollContainer.scrollBy({ left: 300, behavior: 'smooth' });
}
