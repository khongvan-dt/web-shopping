
function confirmDelete(product_id) {
    if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
        // Sử dụng AJAX để gửi yêu cầu xóa sản phẩm
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Cập nhật giỏ hàng sau khi xóa sản phẩm thành công
                location.reload(); // Có thể sử dụng cách khác để cập nhật nội dung giỏ hàng mà không cần làm mới trang
            }
        };
        xhttp.open("POST", "xoa.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("product_id=" + product_id);
    }
}
