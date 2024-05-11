// Định nghĩa hàm updateCardBooking()
function updateCardBooking() {
    var originDataName = $("input[name='origin']:checked").data('name');
    var originDataTime = $("input[name='origin']:checked").data('time');
    
    var destinationDataName = $("input[name='destination']:checked").data('name');
    var destinationDataTime = $("input[name='destination']:checked").data('time');

    // Cập nhật trường input cho điểm đi và ngày đi
    $("#origin-name").val(originDataName);
    $("#origin-time").val(formatDate(originDataTime)); // Định dạng ngày giờ nếu cần
    
    // Cập nhật trường input cho điểm đến và ngày đến
    $("#destination-name").val(destinationDataName);
    $("#destination-time").val(formatDate(destinationDataTime)); // Định dạng ngày giờ nếu cần
}

// Hàm để định dạng ngày giờ nếu cần
function formatDate(timestamp) {
    var days = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
    var months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

    var date = new Date(timestamp * 1000);
    var dayOfWeek = days[date.getDay()];
    var dayOfMonth = date.getDate();
    var month = months[date.getMonth()];
    var year = date.getFullYear();

    return dayOfWeek + ', ' + dayOfMonth + '-' + month + '-' + year;
}

// Gọi lại hàm updateCardBooking() khi một trong hai ô input thay đổi
$("input[name='origin'], input[name='destination']").change(function() {
    updateCardBooking();
});

// Cập nhật lần đầu khi trang được tải
updateCardBooking();
