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

// JS CHO PHẦN TÙY CHỌN THUỘC TÍNH

document.addEventListener("DOMContentLoaded", function () {
  console.log("✅ JS đã load và đang chạy!");

  const groups = document.querySelectorAll(".button-variation-container");
  console.log("Tìm thấy số nhóm:", groups.length);

  groups.forEach((group) => {
    const buttons = group.querySelectorAll(".attr-btn");
    console.log("Trong nhóm có nút:", buttons.length);

    buttons.forEach((btn) => {
      btn.addEventListener("click", function () {
        console.log("👉 Click vào nút:", this.dataset.attr);

        // Bỏ active khỏi tất cả nút trong cùng nhóm
        buttons.forEach((b) => b.classList.remove("active"));

        // Thêm active cho nút vừa chọn
        this.classList.add("active");
      });
    });
  });
});

// JS CHO PHẦN NÚT BẤM.
document.addEventListener("DOMContentLoaded", function () {
  console.log("✅ JS joinex đã load và đang chạy!");

  const qtyInput = document.querySelector(".qty-input-joinex");
  const minusBtn = document.querySelector(".minus-joinex");
  const plusBtn = document.querySelector(".plus-joinex");

  minusBtn.addEventListener("click", function () {
    let value = parseInt(qtyInput.value);
    if (value > 1) qtyInput.value = value - 1;
    console.log("Số lượng sau khi trừ:", qtyInput.value);
  });

  plusBtn.addEventListener("click", function () {
    let value = parseInt(qtyInput.value);
    qtyInput.value = value + 1;
    console.log("Số lượng sau khi cộng:", qtyInput.value);
  });
});

//#region   MÔ TẢ DÀI SẢN PHẨM

document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".tab-link-joinex");
  const panes = document.querySelectorAll(".tab-pane-joinex");

  tabs.forEach((tab) => {
    tab.addEventListener("click", function () {
      // bỏ active cũ
      tabs.forEach((t) => t.classList.remove("active"));
      panes.forEach((p) => p.classList.remove("active"));

      // thêm active mới
      this.classList.add("active");
      const target = this.getAttribute("data-tab");
      document.getElementById(target).classList.add("active");
    });
  });
});

//#endregion

//#region   PHẦN SLIDER SẢN PHẨM LIÊN QUAN PHẢI HỌC THÔI CHỨ KHÔNG LÀ KHÔNG LÀM CHỦ ĐƯỢC ĐÂU

document.addEventListener("DOMContentLoaded", function () {
  console.log("🚀 DOM đã load");
  let index1 = 0;
  const track = document.querySelector(".product-list-slider-track");
  const items = document.querySelectorAll(".product-slider-item");
  const nextBtn = document.querySelector(".custom-next");
  const prevBtn = document.querySelector(".custom-prev");

  console.log("👉 track:", track);
  console.log("👉 items:", items.length);

  const itemWidth = items[0].offsetWidth + 15;
  const visibleItems = Math.floor(track.parentElement.offsetWidth / itemWidth);
  const maxIndex = items.length - visibleItems;

  console.log("📏 itemWidth:", itemWidth);
  console.log("📦 visibleItems:", visibleItems);
  console.log("🔚 maxIndex:", maxIndex);

  function updateSlider() {
    const translateX = index1 * itemWidth;
    console.log(`➡️ index1 = ${index1}, translateX = ${translateX}`);
    track.style.transform = `translateX(-${translateX}px)`;
  }

  // 👉 NEXT
  nextBtn.addEventListener("click", () => {
    console.log("👉 CLICK NEXT");

    if (index1 < maxIndex) {
      index1++;
    } else {
      index1 = 0;
    }

    updateSlider();
  });

  // 👉 PREV
  prevBtn.addEventListener("click", () => {
    console.log("👉 CLICK PREV");

    if (index1 > 0) {
      index1--;
    } else {
      index1 = maxIndex;
    }

    updateSlider();
  });

  // 👉 AUTO SLIDE
  setInterval(() => {
    console.log("⏱️ AUTO RUN");

    if (index1 < maxIndex) {
      index1++;
    } else {
      index1 = 0;
    }

    updateSlider();
  }, 3000);
});

//#endregion
