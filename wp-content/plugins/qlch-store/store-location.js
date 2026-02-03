jQuery(document).ready(function ($) {
  var vnData = {};

  // Load toàn bộ JSON ngay khi trang mở
  $.getJSON(storeLocationAjax.json_url, function (data) {
    vnData = data;

    // Fill dropdown tỉnh/thành
    var citySelect = $("#store_city");
    citySelect
      .empty()
      .append('<option value="">-- Chọn tỉnh/thành --</option>');
    $.each(Object.keys(vnData), function (i, city) {
      citySelect.append('<option value="' + city + '">' + city + "</option>");
    });
  });

  // Khi chọn tỉnh/thành thì lọc xã/phường từ vnData (không gọi AJAX nữa)
  $("#store_city").on("change", function () {
    var city = $(this).val();
    var wardSelect = $("#store_ward");
    wardSelect.empty();
    if (vnData[city]) {
      $.each(vnData[city], function (i, ward) {
        wardSelect.append('<option value="' + ward + '">' + ward + "</option>");
      });
    } else {
      wardSelect.append('<option value="">-- Không có dữ liệu --</option>');
    }
  });
});
