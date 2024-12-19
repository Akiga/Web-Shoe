// Lấy tất cả các phần tử có class là 'Manh__filter-option'
const filterOptions = document.querySelectorAll('.Manh__filter-option');

// Thêm sự kiện 'click' cho mỗi phần tử
filterOptions.forEach(option => {
    option.addEventListener('click', () => {
        // Thêm hoặc loại bỏ class 'selected' để thay đổi trạng thái đã chọn
        option.classList.toggle('selected');
    });
});
