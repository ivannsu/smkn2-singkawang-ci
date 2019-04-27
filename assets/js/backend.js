function showLoader() {
  $('.loading-container').css('display', 'block')
}

function hideLoader() {
  $('.loading-container').css('display', 'none')
}

function showToast(type, msg) {
  if (type == 'success') {
    toastr["success"](msg, "Success")
  } else if (type == 'failed') {
    toastr["error"](msg, "Error")
  }
}

$(document).ready(() => {
  if($('#ckeditor-textarea').length !== 0) {
    CKEDITOR.replace('ckeditor-textarea')
  }

  // if($('#datatables-table').length !== 0) {
  //   $('#datatables-table').DataTable()
  // }

  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

  // toastr["success"]("this is content", "Success")
  // toastr["error"]("this is content", "Error")
})