// Xóa sách
$(document).ready(function() {
    $('button[name="delete-sach"]').on('click', function(e) {
        e.preventDefault();

        const form = $(this).closest('form');
        const sach = $(this).closest('tr').find('td:second');
        if (sach.length > 0) {
            $('.modal-body').html(
                `Bạn có muốn xóa sách "${sach.text()}" không?`
            );
        }
        $('#delete-confirm').modal({
                backdrop: 'static',
                keyboard: false
            })
            .on('click', '#delete', function() {
                form.trigger('submit');
            });
    });
});

