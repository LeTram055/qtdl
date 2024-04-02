/*Xóa sách, tac giả, thể loại, nhà xuất bản, nhân viên, độc giả*/
$(document).ready(function() {
  $('.delete-btn').on('click', function(e) {
    e.preventDefault();

    const form = $(this).closest('form');
    const sach = $(this).closest('tr').find('td').eq(1);

    if (sach.length > 0) {
      $('.modal-body').html(
        `Bạn có muốn xóa "${sach.text()}" không?`
      );
    }

    $('#delete-confirm').modal({
      backdrop: 'static',
      keyboard: false
    })
    .on('click', '#delete', function() {
      
      form.submit();
    });
  });
});


/*Xóa mượn trả*/
$(document).ready(function() {
  $('.delete-mt-btn').on('click', function(e) {
    e.preventDefault();

    const form = $(this).closest('form');
    const mtra = $(this).closest('tr').find('td').eq(0);
    const sach = $(this).closest('tr').find('td').eq(1);

    if (sach.length > 0) {
      $('.modal-body').html(
        `Bạn có muốn xóa thông tin mượn trả với mã mượn trả "${mtra.text()}" và mã sách "${sach.text()}" không?`
      );
    }

    $('#delete-confirm').modal({
      backdrop: 'static',
      keyboard: false
    })
    .on('click', '#delete', function() {
      
      form.submit();
    });
  });
});


/*Xóa thẻ thư viện*/
$(document).ready(function() {
  $('.delete-ttv-btn').on('click', function(e) {
    e.preventDefault();

    const form = $(this).closest('form');
    const ttv = $(this).closest('tr').find('td').eq(0);

    if (ttv.length > 0) {
      $('.modal-body').html(
        `Bạn có muốn xóa "${ttv.text()}" không?`
      );
    }

    $('#delete-confirm').modal({
      backdrop: 'static',
      keyboard: false
    })
    .on('click', '#delete', function() {
      
      form.submit();
    });
  });
});


//