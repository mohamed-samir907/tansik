$(document).ready(function() {
    $('#card-print-high').css('display', 'none');
    $("#control-buttons").css('display', 'none');
    $('#registerRagabaDiv').css('display', 'none');
    $('#editRagabaDiv').css('display', 'none');
    $('#registerRagabaDiv1').css('display', 'none');
    $('#system-btns').css('display', 'none');

    // Check for click events on the navbar burger icon
    $(".navbar-burger").click(function() {

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        $(".navbar-burger").toggleClass("is-active");
        $(".navbar-menu").toggleClass("is-active");

    });
});

$(document).on("click", "#btnPrint", function(e) {
    e.preventDefault();
    e.stopPropagation();
    $("#card-print-high").printThis({
        debug: false,
        importCSS: true,
        importStyle: true,
        printContainer: true,
        loadCSS: "../css/print.css",
        pageTitle: "", 
        removeInline: false,
        printDelay: 333,
        header: null, 
        formValues: true
    });

});

$(document).on('click', '#btnAddRagabas', function() {
    // $('#registerRagabaDiv').css('display', 'block');
    $('#control-btns').css('display', 'none');
    $('#system-btns').css('display', 'block');
});

$(document).on('click', '#btnEditRagabas', function() {
    $('#editRagabaDiv').css('display', 'block');
    $('#control-btns').css('display', 'none');
});

$(document).on('click', '#btnTRagabasSchools', function() {
    $('#control-btns').css('display', 'none');
    $('#registerRagabaDiv').css('display', 'block');
    $('#registerRagabaDiv1').css('display', 'block');
});

$(document).on('click', '#btn-edit-delete', function(e) {
    e.preventDefault();
    var id = $(this).data('id');

    $('#tr-' + id).remove();
});

$(document).on('click', '#btn-add-delete', function(e) {
    e.preventDefault();
    var id = $(this).data('id');

    $('#tr-' + id).remove();
});

function editStudentData(route, student_id) {
    var national_id = $('#e_national_id').val();
    var phone = $('#e_phone').val();
    var address = $('#e_address').val();
    var token = $('meta[name=csrf-token]').attr('content');

    $.ajax({
        url: route,
        method: "POST",
        data: {
            _token: token,
            national_id: national_id,
            phone: phone,
            address: address,
            student_id: student_id
        },
        error: function(errors) {
            console.clear();
            $('#errorMessage').val('حدذ خطأ');
        },
        success: function(data) {
            $('#e_national_id').attr('disabled', true);
            $('#e_phone').attr('disabled', true);
            $('#e_address').attr('disabled', true);
            $('#successMessage').val('تم التعديل بنجاخ');
            $("#control-buttons").css('display', 'block');
            if (data.ragabas == 1) {
                $('#btnEditRagabas').attr('disabled', false);
            } else {
                $('#btnAddRagabas').attr('disabled', false);
            }
        },
    })
}

function editRagabas(table, event) {
    var length = $(table + ' > tr').length

    var id = event.target.options[event.target.options.selectedIndex].value;
    var value = event.target.options[event.target.options.selectedIndex].text;

    if (value != "اختر ثلاث رغبات") {
        if (length < 3) {
            if ($('#tr-' + id).length == 1) {
                swal({
                  title: "تعديل الرغبات",
                  text: "هذه المدرسة تمت اضافتها",
                  icon: "warning",
                  button: "موافق",
                  dangerMode: false,
                });
            } else {
                $(table).append(`
                    <tr id="tr-${id}">
                        <td>
                            <input type="hidden" name="school[]" value="${id}">
                            ${value}
                        </td>
                        <td>
                            <button data-id="${id}" class="button is-danger is-outlined is-small" id="btn-edit-delete">×</button>
                        </td>
                    </tr>
                `);
            }
        } else {
            swal({
              title: "تعديل الرغبات",
              text: "لا يمكن اضافة اكثر من  3 رغبات",
              icon: "warning",
              button: "موافق",
              dangerMode: false,
            });
        }
    }
}

function addRagabas(table, event) {
    var length = $(table + ' > tr').length;

    var id = event.target.options[event.target.options.selectedIndex].value;
    var value = event.target.options[event.target.options.selectedIndex].text;

    if (value != "اختر ثلاث رغبات") {
        if (length < 3) {
            if ($('#tr-' + id).length == 1) {
                swal({
                  title: "تسجيل الرغبات",
                  text: "هذه المدرسة تمت اضافتها",
                  icon: "warning",
                  button: "موافق",
                  dangerMode: false,
                });
            } else {
                $(table).append(`
                    <tr id="tr-${id}">
                        <td>
                            <input type="hidden" name="school[]" value="${id}">
                            ${value}
                        </td>
                        <td>
                            <button data-id="${id}" class="button is-danger is-outlined is-small" id="btn-edit-delete">×</button>
                        </td>
                    </tr>
                `);
            }
        } else {
            swal({
              title: "تسجيل الرغبات",
              text: "لا يمكن اضافة اكثر من  3 رغبات",
              icon: "warning",
              button: "موافق",
              dangerMode: false,
            });
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
  (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
    $notification = $delete.parentNode;
    $delete.addEventListener('click', () => {
      $notification.parentNode.removeChild($notification);
    });
  });
});