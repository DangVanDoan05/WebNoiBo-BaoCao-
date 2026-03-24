document.addEventListener("DOMContentLoaded", function () {
  const mainImage = document.getElementById("current-main-image");
  const thumbs = document.querySelectorAll(".thumb-image");
  const slider = document.querySelector(".images-gallery-product.slider");
  const btnPrev = document.querySelector(".btn-prev");
  const btnNext = document.querySelector(".btn-next");

  let currentIndex = 0; // ảnh đang active
  let startIndex = 0; // ảnh đầu tiên trong khung
  const maxVisible = 4; // số thumbnail hiển thị

  function showImage(index) {
    mainImage.src = thumbs[index].src.replace("-150x150", "");
    thumbs.forEach((t) => t.classList.remove("active"));
    thumbs[index].classList.add("active");
    currentIndex = index;
  }

  function updateSlider() {
    // dịch slider theo startIndex
    const thumbWidth = thumbs[0].offsetWidth;
    slider.scrollTo({
      left: startIndex * thumbWidth,
      behavior: "smooth",
    });
  }

  btnNext.addEventListener("click", () => {
    if (currentIndex < thumbs.length - 1) {
      currentIndex++;
      // nếu active vượt quá khung hiển thị thì dịch startIndex
      if (currentIndex >= startIndex + maxVisible) {
        startIndex++;
        updateSlider();
      }
      showImage(currentIndex);
    }
  });

  btnPrev.addEventListener("click", () => {
    if (currentIndex > 0) {
      currentIndex--;
      // nếu active nhỏ hơn startIndex thì dịch startIndex ngược lại
      if (currentIndex < startIndex) {
        startIndex--;
        updateSlider();
      }
      showImage(currentIndex);
    }
  });

  // click trực tiếp thumbnail
  thumbs.forEach((thumb, index) => {
    thumb.addEventListener("click", () => {
      showImage(index);
    });
  });

  // khởi tạo
  showImage(currentIndex);
  updateSlider();
});
