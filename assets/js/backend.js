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

function readbleExamScores(exam_scores) {
  let result = {};

  exam_scores = exam_scores.split(',')

  exam_scores.forEach((val, i) => {
    let tmp = val.split('=')

    result[tmp[0]] = parseInt(tmp[1])
  })

  return result
}

function getAverageOfScores(exam_scores) {
  let obj = readbleExamScores(exam_scores)
  let keysOfObj = Object.keys(obj)
  let totalVal = 0

  for (let i = 0; i < keysOfObj.length; i++) {
    totalVal += obj[keysOfObj[i]]
  }
  return Math.round(totalVal / keysOfObj.length)
}

function map_selection_data(data) {
  let result = []

  data.jurusan.forEach(obj => {
    let jurusan_id = obj.id
    let temp = { 
      id: jurusan_id,
      jurusan: obj.title, 
      passed: 0, 
      not_passed: 0 
    }

    data.passed.forEach(secondObj => {
      if (secondObj.jurusan_id == jurusan_id) {
        temp.passed = secondObj.total_students
      }
    })

    data.not_passed.forEach(secondObj => {
      if (secondObj.jurusan_id == jurusan_id) {
        temp.not_passed = secondObj.total_students
      }
    })

    result.push(temp)
  })

  return result
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

  // toastr["success"]("this is content", "Success")
  // toastr["error"]("this is content", "Error")
})