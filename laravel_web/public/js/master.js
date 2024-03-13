// 
//tạo và hiển thị một cửa sổ thông báo toast sử dụng thư viện Bootstrap
var toastElement = document.querySelector('.toast');
var toast = new bootstrap.Toast(toastElement, { delay: 10000 });
toast.show();


// //cập nhật thời gian thông báo
// var timestampElement = document.getElementById('toast-timestamp');
// var startTime = Date.now();
// function updateTimestamp() {
//     var currentTime = Date.now();
//     var elapsedTime = Math.floor((currentTime - startTime) / 1000); // Đếm thời gian trong giây

//     timestampElement.textContent = elapsedTime + ' giây trước'; // Cập nhật nội dung thời gian

//     setTimeout(updateTimestamp, 1000); // Cập nhật lại thời gian sau mỗi giây
// }
// updateTimestamp(); // Bắt đầu cập nhật thời gian


function menu(element1, element2, icon) {
    if (element1.classList.contains("d-none")) {
        element1.classList.remove("d-none");
        element1.classList.add("d-block");
        element2.classList.remove("d-none");
        element2.classList.add("d-block");
        if (icon.classList.contains("fa-angle-down") == false) {
            icon.classList.add("fa-angle-down");
            icon.classList.remove("fa-angle-left");
        }
    }
    else {
        element1.classList.remove("d-block");
        element1.classList.add("d-none");
        element2.classList.remove("d-block");
        element2.classList.add("d-none");
        if (icon.classList.contains("fa-angle-down")) {
            icon.classList.add("fa-angle-left");
            icon.classList.remove("fa-angle-down");
        }
    }
}


// //validate giá trị chỉ đc nhập số vào ô số lượng sách
function validateInput_int(input,max) {
    // Xóa các ký tự không phải số nguyên dương và dấu chấm
    input.value = input.value.replace(/[^0-9]/g, '');

    // Xóa một dấu chấm đầu tiên nếu có
    if (input.value.startsWith('.')) {
        input.value = input.value.substring(1);
    }

    // Giới hạn giá trị nhập không vượt quá max
    const value = parseInt(input.value);
    if (value > max) {
        input.value = max.toString();
    }
}

// //chỉ đc nhập số thực
// function validateInput_float(input) {
//     // Xóa các ký tự không phải số hoặc dấu chấm
//     input.value = input.value.replace(/[^0-9.]/g, '');

//     // Xóa các dấu chấm thừa
//     input.value = input.value.replace(/\.(?=.*\.)/g, '');

//     // Xóa một dấu chấm đầu tiên nếu có
//     if (input.value.startsWith('.')) {
//         input.value = input.value.substring(1);
//     }

//     // Kiểm tra giá trị và đặt lại thành 0 nếu giá trị không hợp lệ
//     if (parseFloat(input.value) < 0 || isNaN(parseFloat(input.value))) {
//         input.value = '';
//     }
// }

// //
// function closeModal() {
//     var modal = document.getElementById("xuatdulieuModal");
//     var modalInstance = bootstrap.Modal.getInstance(modal);
//     modalInstance.hide();
// }


function submit(form_submit){
    form_submit.submit();
}

function display_name_by_id(staff_id, staff_name) {
    var selectedOption = staff_id.options[staff_id.selectedIndex];
    var staffName = selectedOption.getAttribute("data-staffname");
    staff_name.textContent = staffName;
}

function getValue() {
    var element1 = document.querySelector('input[name="txt_file"]');
    var element2 = document.getElementById("txt_file_value");
    
    var fileName = "";
    if (element1.files.length > 0) {
        fileName = element1.files[0].name;
    }
    
    element2.innerText = fileName;
}

function action(stt, actions) {
    for (var i = 0; i < 10; i++) {
      if (i === stt - 1) {
        if (actions[i].classList.contains("d-block")) {
            actions[i].classList.remove("d-block");
            actions[i].classList.add("d-none");
        }else{
            actions[i].classList.remove("d-none");
            actions[i].classList.add("d-block");
        }
      } else {
        if (actions[i].classList.contains("d-block")) {
          actions[i].classList.remove("d-block");
          actions[i].classList.add("d-none");
        }
      }
    }
  }

// function updateElement(){
//     form_search =  document.getElementById('form_search');
//     form_search.action = form_search.action.replace("search", "export");
//     form_search.submit(); 
// }