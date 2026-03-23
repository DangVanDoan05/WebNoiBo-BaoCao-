document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector(".product-gallery.slider");
  const btnPrev = document.querySelector(".btn-prev");
  const btnNext = document.querySelector(".btn-next");

  if (slider && btnPrev && btnNext) {
    btnPrev.addEventListener("click", () => {
      slider.scrollBy({ left: -slider.clientWidth, behavior: "smooth" });
    });
    btnNext.addEventListener("click", () => {
      slider.scrollBy({ left: slider.clientWidth, behavior: "smooth" });
    });
  }
});
