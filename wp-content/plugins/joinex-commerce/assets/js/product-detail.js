document.addEventListener("DOMContentLoaded", function () {
  const mainImage = document.getElementById("current-main-image");
  const thumbs = document.querySelectorAll(".thumb-image");

  thumbs.forEach((thumb) => {
    thumb.addEventListener("click", () => {
      // đổi src ảnh chính sang ảnh thumbnail được chọn
      mainImage.src = thumb.src.replace("-150x150", ""); // bỏ suffix thumbnail để lấy ảnh lớn
      // highlight thumbnail đang chọn
      thumbs.forEach((t) => t.classList.remove("active"));
      thumb.classList.add("active");
    });
  });
});
