/**
 * Main
 */

'use strict';
$(window).on('load', function () {
  if ($('.cover').length) {
    $('.cover').parallax({
      imageSrc: $('.cover').data('image'),
      zIndex: '1'
    });
  }

  $("#preloader").animate({
    'opacity': '0'
  }, 600, function () {
    setTimeout(function () {
      $("#preloader").css("visibility", "hidden").fadeOut();
    }, 300);
  });
});


$('#formAuthentication').submit(function (e) {
  e.preventDefault();
  var valid = true;
  var username = $("#username").val();
  var password = $("#password").val();
  const btnLogin = document.querySelector('.btn-login');
  const btnLoading = document.querySelector('.btn-loading');
  // console.log('oke');
  $.ajax({
    url: "inc/checklogin",
    type: "POST",
    data: { 'username': username, 'password': password },
    success: function (data) {
      // console.log(data);
      if (data == 0) {
        btnLogin.classList.toggle('d-none');
        btnLoading.classList.toggle('d-none');
        Swal.fire({
          title: 'Username dan Password \n tidak sesuai',
          text: "Cek kembali username dan password anda !",
          confirmButtonColor: '#696cff',
          confirmButtonText: 'Ok',
          allowOutsideClick: false
        }).then((result) => {
          if (result.isConfirmed) {
            btnLogin.classList.toggle('d-none');
            btnLoading.classList.toggle('d-none');

          }
        });

      } else if (data !== 1) {
        btnLogin.classList.toggle('d-none');
        btnLoading.classList.toggle('d-none');
        var username = $("#username").val();
        $.ajax({
          url: "inc/redirect",
          type: "POST",
          data: { 'username': username, 'password': password },
          dataType: "text",
          success: function (data) {
            Swal.fire({
              title: "Login Sukses",
              icon: "success",
              timer: 1500,
              showConfirmButton: false
            }).then(function () {
              if (true) {
                window.location = "./";
              }
            });

          }
        });
      } else {
        console.log("invalid");
      }
    }
  });
  //
});

var myLoadingPage
function loadingPage() {
  myLoadingPage = setTimeout(showPage, 100);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  // document.getElementById("loader").style.display = "block";
  document.getElementById("content").style.display = "block";
}


var _validFileExtensions = [".jpg"];
function ValidateSingleInputJPG(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensions.length; j++) {
        var sCurExtension = _validFileExtensions[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;

        }
      }

      if (!blnValid) {
        Swal.fire({
          icon: 'error',
          title: 'File format harus JPG !',
          showConfirmButton: true,
          timer: 5000
        });
        oInput.value = "";
        return false;
      }
    }
  }
  return true;
};

var _validFileExtensionpdf = ["pdf", "PDF", "Pdf"];
function ValidateSingleInputpdf(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensionpdf.length; j++) {
        var sCurExtension = _validFileExtensionpdf[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;

        }
      }

      if (!blnValid) {
        Swal.fire({
          icon: 'error',
          title: 'File format harus pdf !',
          showConfirmButton: true,
          timer: 5000
        });
        oInput.value = "";
        return false;
      }
    }
  }
  return true;
};

function ValidateSize(file) {
  var FileSize = file.files[0].size;
  if (FileSize > 1000000) {
    Swal.fire({
      icon: 'error',
      title: 'Ukuran file maks 1MB',
      showConfirmButton: true,
      timer: 5000
    });
    file.value = "";
    return false;
  } else {

  }
}

function ValidateSizePengajuan(file) {
  var FileSize = file.files[0].size;
  if (FileSize > 2097152) {
    Swal.fire({
      icon: 'error',
      title: 'Ukuran file maks 2MB',
      showConfirmButton: true,
      timer: 5000
    });
    file.value = "";
    return false;
  } else {

  }
}

var _validFileExtensionsExcel = [".xls", ".xlsx"];

function ValidateSingleInputExcel(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensionsExcel.length; j++) {
        var sCurExtension = _validFileExtensionsExcel[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;

        }
      }

      if (!blnValid) {
        Swal.fire({
          icon: 'error',
          title: 'File format harus Excel !',
          showConfirmButton: true,
          timer: 5000
        });
        oInput.value = "";
        return false;
        $('.cekButton').attr('disabled', true);
      } else {
        $('.cekButton').removeAttr('disabled');
      }
    }
  }
  return true;
};
$(".custom-file-input").on("change", function () {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

function checkTime(i) {
  if (i < 10) { i = "0" + i };  // add zero in front of numbers < 10
  return i;
}

if (document.getElementById('clock-dashboard')) {
  function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock-dashboard').innerHTML = h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);

  }
  startTime();
}
if (document.getElementById('header-dashboard')) {
  function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('header-dashboard').innerHTML = h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);
    // console.log(h);
  }

  startTime();
}

// if (document.getElementById('account-file-input')) {
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const deactivateAcc = document.querySelector('#formAccountDeactivation');

    // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
      resetFileInput = document.querySelector('.account-image-reset');

    if (accountUserImage) {
      const resetImage = accountUserImage.src;

      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
        }
      };
      resetFileInput.onclick = () => {
        fileInput.value = '';
        accountUserImage.src = resetImage;
      };
    }
  })();
});
// }


//sidebar
$(document).ready(function () {
  $('#commingSoon').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-dialog-centered modal-md');
    document.getElementById("load-comingsoon").style.display = "block";
    document.getElementById("comingsoon").style.display = "none";
    $.ajax({
      url: 'dashboard/modul/comingSoonPage',
      success: function (data) {
        document.getElementById("load-comingsoon").style.display = "none";
        document.getElementById("comingsoon").style.display = "block";
        $('.comingsoon').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

// akun
$(document).ready(function () {
  $('#addUser').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-user").style.display = "block";
    document.getElementById("add-user").style.display = "none";
    $.ajax({
      url: 'dashboard/page/master/user/tambah-user',
      success: function (data) {
        document.getElementById("load-add-user").style.display = "none";
        document.getElementById("add-user").style.display = "block";
        $('.add-user').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#editUser').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-edit-user").style.display = "block";
    document.getElementById("edit-user").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/master/user/edit-user',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-edit-user").style.display = "none";
        document.getElementById("edit-user").style.display = "block";
        $('.edit-user').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#delUser').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-user").style.display = "block";
    document.getElementById("del-user").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/master/user/hapus-user',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-del-user").style.display = "none";
        document.getElementById("del-user").style.display = "block";
        $('.del-user').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

//kategori
$(document).ready(function () {
  $('#addCategory').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-add-category").style.display = "block";
    document.getElementById("add-category").style.display = "none";
    $.ajax({
      url: 'dashboard/page/master/kategori/tambah-kategori',
      success: function (data) {
        document.getElementById("load-add-category").style.display = "none";
        document.getElementById("add-category").style.display = "block";
        $('.add-category').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});
$(document).ready(function () {
  $('#editCategory').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-edit-category").style.display = "block";
    document.getElementById("edit-category").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/master/kategori/edit-kategori',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-edit-category").style.display = "none";
        document.getElementById("edit-category").style.display = "block";
        $('.edit-category').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});
$(document).ready(function () {
  $('#delCategory').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-del-category").style.display = "block";
    document.getElementById("del-category").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/master/kategori/hapus-kategori',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-del-category").style.display = "none";
        document.getElementById("del-category").style.display = "block";
        $('.del-category').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});

//meja
$(document).ready(function () {
  $('#addTable').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-add-table").style.display = "block";
    document.getElementById("add-table").style.display = "none";
    $.ajax({
      url: 'dashboard/page/master/meja/tambah-meja',
      success: function (data) {
        document.getElementById("load-add-table").style.display = "none";
        document.getElementById("add-table").style.display = "block";
        $('.add-table').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});
$(document).ready(function () {
  $('#editTable').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-edit-table").style.display = "block";
    document.getElementById("edit-table").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/master/meja/edit-meja',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-edit-table").style.display = "none";
        document.getElementById("edit-table").style.display = "block";
        $('.edit-table').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});
$(document).ready(function () {
  $('#delTable').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-del-table").style.display = "block";
    document.getElementById("del-table").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/master/meja/hapus-meja',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-del-table").style.display = "none";
        document.getElementById("del-table").style.display = "block";
        $('.del-table').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
  });
});

