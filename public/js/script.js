/*Xóa sách*/
$(document).ready(function() {
  $('.delete-btn').on('click', function(e) {
    e.preventDefault();

    const form = $(this).closest('form');
    const sach = $(this).closest('tr').find('td').eq(1);

    if (sach.length > 0) {
      $('.modal-body').html(
        `Bạn có muốn xóa sách "${sach.text()}" không?`
      );
    }

    console.log('Nút xóa đã được nhấn');
    $('#delete-confirm').modal({
      backdrop: 'static',
      keyboard: false
    })
    .on('click', '#delete', function() {
      
      form.submit();
    });
  });
});


/*Sắp xếp sách*/



