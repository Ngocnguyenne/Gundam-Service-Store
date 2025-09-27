document
    .getElementById("service-checkout")
    .addEventListener("submit", function (e) {
        const bookingInput = document.getElementById("bookingDate");
        const bookingDate = new Date(bookingInput.value);
        const now = new Date();

        // Kiểm tra: thời gian đặt lịch phải là tương lai
        if (bookingDate <= now) {
            e.preventDefault();
            showToast(
                "error",
                "Lỗi",
                "Thời gian đặt lịch phải là thời gian trong tương lai.",
                {
                    position: "topRight",
                }
            );
            return;
        }

        // Kiểm tra: giờ đặt lịch phải nằm trong khoảng 8h - 20h
        const bookingHour = bookingDate.getHours();
        if (bookingHour < 8 || bookingHour >= 20) {
            e.preventDefault();
            showToast(
                "error",
                "Lỗi",
                "Chỉ cho phép đặt lịch từ 8h sáng đến 8h tối.",
                {
                    position: "topRight",
                }
            );
            return;
        }
    });
