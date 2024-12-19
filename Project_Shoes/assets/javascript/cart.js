function scrollCarousel(direction) {
    const carouselInner = document.querySelector('.carousel-inner');
    const cardWidth = document.querySelector('.product-card').offsetWidth + 20; // Width + margin
    carouselInner.scrollBy({
      left: direction * cardWidth,
      behavior: 'smooth'
    });
  }
  