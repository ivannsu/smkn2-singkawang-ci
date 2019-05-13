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

function readbleUniqID(id) {
  // 6061 5634 35cd 6e2b a45e 5f

  let lengthOf = 4;
  let calcLoop = id.length / lengthOf;
  let startCounter = 0;
  let endCounter = lengthOf;
  let results = [];
  
  for (let i = 0; i < calcLoop; i++) {
    results.push(id.slice(startCounter, endCounter));
    
    startCounter += lengthOf;
    endCounter += lengthOf;
  }
  
  return results.join('-');
}

$(document).ready(() => {
  if($('#ckeditor-textarea').length !== 0) {
    CKEDITOR.replace('ckeditor-textarea')
  }

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

  readbleUniqID('6061563435cd6e2ba45e5f')

  // toastr["success"]("this is content", "Success")
  // toastr["error"]("this is content", "Error")
})