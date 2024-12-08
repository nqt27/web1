
function drag() {
    // Sử dụng Dragula để cho phép kéo thả
    const drake = dragula([document.getElementById('column-1')]);

    // Khi việc kéo thả hoàn tất, chúng ta sẽ lấy thứ tự mới và gửi đến server
    drake.on('drop', function (el, target, source, sibling) {
        console.log(1);

        // Lấy thứ tự các phần tử trong danh sách
        const orderedItems = [];
        document.querySelectorAll('#column-1 .menu-item').forEach(item => {
            orderedItems.push(item.id.replace('menu-', '')); // Lấy id của các phần tử
        });

        // Gửi thứ tự mới lên server
        // saveOrder(orderedItems);
        console.log(orderedItems);
        $.ajax({
            url: '/admin/updateOrder', // Đường dẫn đến API của bạn
            method: 'POST',
            data: {
                order: orderedItems, // Gửi mảng thứ tự mới
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token cho Laravel
            },
            success: function (response) {
                console.log("Thứ tự đã được cập nhật thành công:", response);
            },
            error: function (xhr) {
                console.log("Có lỗi xảy ra khi cập nhật thứ tự:", xhr);
            }
        });

    });
}
function generateSlug(value) {
    return value.toLowerCase()
        .normalize('NFD') // Chuẩn hóa ký tự
        .replace(/[\u0300-\u036f]/g, '') // Loại bỏ dấu tiếng Việt
        .replace(/[^a-z0-9\s-]/g, '') // Xóa ký tự không phải chữ cái và số
        .trim() // Xóa khoảng trắng ở đầu và cuối
        .replace(/\s+/g, '-'); // Thay khoảng trắng bằng dấu gạch ngang
}
function formMenu(button, url, method = 'POST', parent_id) {
    // Lấy thông tin menu từ thuộc tính data của nút
    let menuId = button.data('id');
    let menuName = button.data('name');
    let menuUrl = button.data('url');

    // Sử dụng SweetAlert2 để hiển thị form chỉnh sửa
    Swal.fire({
        title: 'Chỉnh sửa menu',
        html: `
        <form id="editMenuForm">
            <div class="form-group">
                <label style="width: 30%" for="menu-name">Tên menu</label>
                <input type="text" id="menu-name" class="swal2-input" value="${menuName || ''}">
            </div>
            <div class="form-group">
                <label  style="width: 30%" for="menu-url">URL</label>
                <input type="text" id="menu-url" class="swal2-input" value="${menuUrl || ''}">
            </div>
        </form>
    `,
        didOpen: () => {
            const nameInput = document.getElementById('menu-name');
            const urlInput = document.getElementById('menu-url');

            // Lắng nghe sự kiện nhập liệu trên trường "Tên menu"
            nameInput.addEventListener('input', () => {
                const nameValue = nameInput.value;
                urlInput.value = generateSlug(nameValue); // Tạo slug cho URL
            });
        },
        showCancelButton: true,
        confirmButtonText: 'Lưu',
        cancelButtonText: 'Hủy',
        preConfirm: () => {
            // Lấy giá trị từ các trường nhập liệu
            const updatedName = $('#menu-name').val();
            const updatedUrl = $('#menu-url').val();

            // Kiểm tra nếu các trường không để trống
            if (!updatedName || !updatedUrl) {
                Swal.showValidationMessage('Vui lòng điền đầy đủ thông tin!');
                return false;
            }
            return {
                name: updatedName,
                url: updatedUrl
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            let data = {
                name: result.value.name,
                url: result.value.url,
                _method: method,
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token cho Laravel
            };

            // Thêm `parent_id` nếu nó tồn tại
            if (parent_id) {
                data.parent_id = parent_id;
            }
            console.log(data);
            // Gửi dữ liệu cập nhật qua AJAX
            $.ajax({
                url: `${url}/${menuId || ''}`, // Đường dẫn cập nhật
                method: 'POST',
                data: data,
                success: function (response) {
                    Swal.fire({
                        title: "Saved",
                        text: "Menu đã được lưu",
                        icon: "success"
                    });

                    window.location.reload();

                    // Tùy chọn: Tải lại trang hoặc cập nhật DOM để phản ánh thay đổi
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cập nhật thất bại',
                        text: 'Có lỗi xảy ra trong quá trình cập nhật.'
                    });
                    console.log("Lỗi:", xhr);
                }
            });
        }
    });
}
function addMenu(button, url, method, parent_id) {
    button.on('click', function () {
        formMenu(button, url, method, parent_id);
    });
}
function editMenu(button, url) {
    button.on('click', function () {
        formMenu($(this), url, 'PUT');
    });

}
function deleteMenu() {
    $('.delete-btn').on('click', function () {
        // Lấy thông tin menu từ thuộc tính data của nút
        let menuId = $(this).data('id');

        // Sử dụng SweetAlert2 để hiển thị form chỉnh sửa
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: "Hành động này không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                // Gửi dữ liệu cập nhật qua AJAX
                $.ajax({
                    url: `/admin/menu/${menuId}`, // Đường dẫn cập nhật
                    method: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token cho Laravel
                    },
                    success: function (response) {
                        Swal.fire({
                            title: "Saved",
                            text: "Menu đã được lưu",
                            icon: "success"
                        });

                        window.location.reload();

                        // Tùy chọn: Tải lại trang hoặc cập nhật DOM để phản ánh thay đổi
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cập nhật thất bại',
                            text: 'Có lỗi xảy ra trong quá trình cập nhật.'
                        });
                        console.log("Lỗi:", xhr);
                    }
                });
            }
        });
    });
}