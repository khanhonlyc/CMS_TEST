require("./bootstrap");
// For page-content-copy
$(".page-content-copy .datepicker").flatpickr({
  enableTime: true,
  dateFormat: "Y-m-d H:i:S",
});
$(".page-content-copy .datepicker2").flatpickr({
  enableTime: true,
  dateFormat: "Y-m-d H:i:S",
});
$(document).ready(function () {
  $(".page-content-copy #selectbtn-tag").click(function () {
    $(".page-content-copy #selectall-tag > option").prop(
      "selected",
      "selected"
    );
    $(".page-content-copy #selectall-tag").trigger("change");
  });
  $(".page-content-copy #deselectbtn-tag").click(function () {
    $(".page-content-copy #selectall-tag > option").prop("selected", "");
    $(".page-content-copy #selectall-tag").trigger("change");
  });
  if ($(".page-content-copy .select2").length > 0) {
    $(".page-content-copy .select2").select2();
  }
});
$(document).ready(function (e) {
  $(".parent a").click(function (e) {
    var elems = $(this).closest("li");
    elems.toggleClass("mainactive");
    if (elems.find(".submenu").length) {
      $(".submenu:first", elems).toggle();
    }
  });
  $(".page-content-copy #file").change(function () {
    let reader = new FileReader();
    reader.onload = (e) => {
      $(".page-content-copy #preview-image-before-upload").attr(
        "src",
        e.target.result
      );
      $(".page-content-copy #preview-image-before-upload").addClass("active");
      $(".page-content-copy #imageBefore").attr("value", e.target.result);
    };
    if (this.files[0]) {
      reader.readAsDataURL(this.files[0]);
    } else {
      $(".page-content-copy #preview-image-before-upload").attr("src", "");
      $(".page-content-copy #preview-image-before-upload").removeClass(
        "active"
      );
    }
  });
  $(".page-content-copy #SubmitEdit").click(function (e) {
    $(".page-content-copy #topManagementDup").submit();
  });
  // == for page-content-edit
  $(".page-content-edit .datepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:ss",
  });
  $(".page-content-edit .datepicker2").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:ss",
  });
  $(document).ready(function () {
    $(".page-content-edit #selectbtn-tag").click(function () {
      $(".page-content-edit #selectall-tag > option").prop(
        "selected",
        "selected"
      );
      $(".page-content-edit #selectall-tag").trigger("change");
    });
    $(".page-content-edit #deselectbtn-tag").click(function () {
      $(".page-content-edit #selectall-tag > option").prop("selected", "");
      $(".page-content-edit #selectall-tag").trigger("change");
    });
    if ($(".page-content-edit .select2").length > 0) {
      $(".page-content-edit .select2").select2();
    }
  });
  $(document).ready(function () {
    function uploadfileEdit(urlRoute) {
      var CSRF_TOKEN = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
      var formData = new FormData();
      var files = $(".page-content-edit #file")[0].files;
      formData.append("file", files[0]);
      formData.append("_token", CSRF_TOKEN);
      $.ajax({
        type: "POST",
        url: urlRoute,
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
          if (response.imgName) {
            $(".page-content-edit #preview-image-before-upload").attr(
              "src",
              response.imghost
            );
            $(".page-content-edit #imageBefore").attr(
              "value",
              response.imghost
            );
          }
        },
        error: function (response) {
          if(response.responseJSON.errors.file[0]) {
            alert('ファイルには2Mb以下をアップロードしてください。');
          }
        },
      });
    }
    $(".page-content-edit #file").change(function () {
      var urlRoute = $(this).data('route');
      uploadfileEdit(urlRoute);
    });
    jQuery(function ($) {
      $(".page-content-edit #duplicator").click(function (event) {
        event.preventDefault();
        $(".page-content-edit #topManagementEdit")
          .find('input[name="_method"]')
          .val("POST");
        var new_area = $(
          ".page-content-edit #topManagementEdit"
        ).serializeArray();
        var urlRoute = $(this).data('route');
        $.redirect(
          urlRoute,
          {
            _token: "{{ csrf_token() }}",
            datas: new_area,
          },
          "GET",
          "_blank"
        );
      });
    });
    $(".page-content-edit #SubmitEdit").click(function (e) {
      $(".page-content-edit #topManagementEdit").submit();
    });
  });
  // == For page-content-list
  function resetFormSearchMovie() {
    $("#keyword").removeAttr("value");
    $("#formone").find("input:checkbox").removeAttr("checked");
    $("#formone")
      .find("select[name=videoCategories] option")
      .removeAttr("selected");
    $("#formone").find("#selectall-tag option").removeAttr("selected");
    $("#formone").find("select[name=sortBy] option").removeAttr("selected");
    $("#formone").find("select[name=sortType] option").removeAttr("selected");
    $("#formone").trigger("reset");
  }
  $(".page-content-list .datepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:ss"
  });
  $(".page-content-list .datepicker2").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:ss"
  });
  // == For page-content-registration
  $(".page-content-registration .preview").on("click", function () {
    $(".page-content-registration .preview_title").text(
      $("input[name=title]").val()
    );
    $(".page-content-registration .movie").html(
      $("textarea[name=iframe]").val()
    );
    $(".page-content-registration .preview_tag").empty();
    $(".page-content-registration .select2-selection__choice").each(
      function () {
        $(".page-content-registration .preview_tag").append(
          '<a href="#" class="btn btn-outline-white border rounded-4 px-4">' +
            $(this).attr("title") +
            "</a>"
        );
      }
    );
  });
  $(".page-content-registration input[name=datepicker]").change(function () {
    $(".page-content-registration .d-block").attr(
      "datetime",
      $(".page-content-registration input[name=datepicker]").val()
    );
    let date1 = $(".page-content-registration input[name=datepicker]")
      .val()
      .split(" ");
    date1 = date1[0].split("-");
    $(".page-content-registration .d-block").html(
      date1[0] + "/" + date1[1] + "/" + date1[2]
    );
  });
  $(".page-content-registration .datepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:S",
  });
  $(".page-content-registration .datepicker2").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:S",
  });
  $(document).ready(function () {
    $(".page-content-registration #selectbtn-tag").click(function () {
      $(".page-content-registration #selectall-tag > option").prop(
        "selected",
        "selected"
      );
      $(".page-content-registration #selectall-tag").trigger("change");
    });
    $(".page-content-registration #deselectbtn-tag").click(function () {
      $(".page-content-registration #selectall-tag > option").prop(
        "selected",
        ""
      );
      $(".page-content-registration #selectall-tag").trigger("change");
    });
    if ($(".page-content-registration .select2").length > 0) {
      $(".page-content-registration .select2").select2();
    }
  });
  $(document).ready(function (e) {
    $(".page-content-registration #file").change(function () {
      let reader = new FileReader();
      reader.onload = (e) => {
        $(".page-content-registration  #preview-image-before-upload").attr(
          "src",
          e.target.result
        );
        $(".page-content-registration #preview-image-before-upload").addClass(
          "active"
        );
        $(".page-content-registration #preview_img").attr(
          "src",
          e.target.result
        );
      };
      reader.readAsDataURL(this.files[0]);
    });
  });
  // For page-fan-type
  // page-log-history
  $(".page-log-history .datepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:ss",
  });
  $(".page-log-history .datepicker2").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:ss",
  });
  // For mypage
  // For page-tag
  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
    function printErrorMsg(msg) {
      $(".page-tag .print-error-msg").find("ul").html("");
      $(".page-tag .print-error-msg").css("display", "block");
      $.each(msg, function (key, value) {
        $(".page-tag .print-error-msg")
          .find("ul")
          .append("<li>" + value + "</li>");
      });
    }
    $(".page-tag .btn-submit").click(function (e) {
      e.preventDefault();
      var tag_id = $(".page-tag #inputPassword6").val();
      var tag_name = $(".page-tag #inputPassword7").val();
      var urlRoute = $(this).data('route');
      $.ajax({
        type: "POST",
        url: urlRoute,
        data: { tag_id, tag_name },
        success: function (data) {
          if ($.isEmptyObject(data.error)) {
            alert("タグが登録されました。");
            location.reload();
          } else {
            printErrorMsg(data.error);
          }
        },
      });
    });
    $(".page-tag .btn-submit-put").click(function (e) {
      e.preventDefault();
      var getId = $(this).data("id");
      var tagId = $(this).data("tagid");
      var forUId = false;
      var forUName = false;
      var tagName = $(this).data("tagname");
      var url = $(this).data("url");
      var formData = $(this).closest("form").serializeArray();
      var tag_id = formData[1].value;
      var tag_name = formData[2].value;
      if (tagId != tag_id) {
        forUId = true;
      }
      if (tagName != tag_name) {
        forUName = true;
      }
      $.ajax({
        type: "PATCH",
        url: url,
        data: { tag_id, tag_name, forUId, forUName },
        success: function (data) {
          if ($.isEmptyObject(data.error)) {
            alert("タグが登録されました。");
            location.reload();
          } else {
            printErrorMsgPut(data.error, getId);
          }
        },
      });
    });
    function printErrorMsgPut(msg, getId) {
      $(".page-tag .print-error-msg" + getId)
        .find("ul")
        .html("");
      $(".page-tag .print-error-msg" + getId).css("display", "block");
      $.each(msg, function (key, value) {
        $(".page-tag .print-error-msg" + getId)
          .find("ul")
          .append("<li>" + value + "</li>");
      });
    }
    $(".page-tag .datepicker").flatpickr({
      enableTime: true,
      dateFormat: "Y-m-d H:i:ss"
    });
    $(".page-tag .datepicker2").flatpickr({
      enableTime: true,
      dateFormat: "Y-m-d H:i:ss"
    });
  });
  // For top-page-copy
  $(".top-page-copy .datepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:S",
  });
  $(".top-page-copy .datepicker2").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:S",
  });
  $(document).ready(function (e) {
    function uploadfileCopy(urlRoute) {
      var CSRF_TOKEN = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
      var formData = new FormData();
      var files = $(".top-page-copy #file")[0].files;
      formData.append("file", files[0]);
      formData.append("_token", CSRF_TOKEN);
      $.ajax({
        type: "POST",
        url: urlRoute,
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
          if (response.imgName) {
            $(".top-page-copy #preview-image-before-upload").attr("src", response.imghost);
            $(".top-page-copy #imageBefore").attr("value", response.imghost);
          }
        },
        error: function (response) {
          if(response.responseJSON.errors.file[0].length) {
            alert('ファイルには2Mb以下をアップロードしてください。');
          }
        },
      });
    }
    $(".top-page-copy #file").change(function () {
      var urlRoute = $(this).data('route');
      uploadfileCopy(urlRoute);
    });
  });
  // For top-page-create
  function resetFormTopPage() {
    $("#title").removeAttr("value");
    $("#sort").removeAttr("value");
    $("#file").removeAttr("value");
    $("#preview-image-before-upload").removeAttr("src");
    $("#url").removeAttr("value");
    $("#select option").removeAttr("selected");
    $("#checks .form-check-input").removeAttr("checked");
    $("#time1").removeAttr("value");
    $("#time2").removeAttr("value");
    $("#status option").removeAttr("selected");
  }
  $(".top-page-create .datepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:S",
  });
  $(".top-page-create .datepicker2").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:S",
  });
  $(document).ready(function (e) {
    function uploadfileCreate(urlRoute) {
      var CSRF_TOKEN = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
      var formData = new FormData();
      var files = $(".top-page-create #file")[0].files;
      formData.append("file", files[0]);
      formData.append("_token", CSRF_TOKEN);
      $.ajax({
        type: "POST",
        url: urlRoute,
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
          if (response.imgName) {
            $(".top-page-create #preview-image-before-upload").attr("src", response.imghost);
            $(".top-page-create #imageBefore").attr("value", response.imghost);
          }
        },
        error: function (response) {
          if(response.responseJSON.errors.file[0].length) {
            alert('ファイルには2Mb以下をアップロードしてください。');
          }
        },
      });
    }

    $(".top-page-create #file").change(function () {
      var urlRoute = $(this).data('route');
      uploadfileCreate(urlRoute);
    });

    jQuery(function ($) {
      $(".top-page-create #duplicator").click(function (event) {
        event.preventDefault();
        var new_area = $(".top-page-create #topManagement").serializeArray();
        $.redirect(
          '@php echo url("top-page-management"); @endphp',
          { _token: "{{ csrf_token() }}", datas: new_area },
          "GET",
          "_blank"
        );
      });
    });
  });
  // For top-page-index
  // For top-page-show
  function resetFormTopPageShow() {
    $("#title").removeAttr("value");
    $("#sort").removeAttr("value");
    $("#file").removeAttr("value");
    $("#preview-image-before-upload").removeAttr("src");
    $("#url").removeAttr("value");
    $("#select option").removeAttr("selected");
    $("#checks .form-check-input").removeAttr("checked");
    $("#time1").removeAttr("value");
    $("#time2").removeAttr("value");
    $("#status option").removeAttr("selected");
  }
  $(".top-page-show .datepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:S",
  });
  $(".top-page-show .datepicker2").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:S",
  });
  $(document).ready(function (e) {
    function uploadfileShow(urlRoute) {
      var CSRF_TOKEN = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
      var formData = new FormData();
      var files = $(".top-page-show #file")[0].files;
      formData.append("file", files[0]);
      formData.append("_token", CSRF_TOKEN);
      $.ajax({
        type: "POST",
        url: urlRoute,
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
          if (response.imgName) {
            $(".top-page-show #preview-image-before-upload").attr("src", response.imghost);
            $(".top-page-show #imageBefore").attr("value", response.imghost);
          }
        },
        error: function (response) {
          if(response.responseJSON.errors.file[0].length) {
            alert('ファイルには2Mb以下をアップロードしてください。');
          }
        },
      });
    }
    $(".top-page-show #file").change(function () {
      console.log(123);
      var urlRoute = $(this).data('route');
      uploadfileShow(urlRoute);
    });
    jQuery(function ($) {
      $(".top-page-show #duplicator").click(function (event) {
        event.preventDefault();
        $(".top-page-show #topManagementEdit").find('input[name="_method"]').val("POST");
        var new_area = $("#topManagementEdit").serializeArray();
        var urlRoute = $(this).data('route');
        $.redirect(
          urlRoute,
          {
            datas: new_area,
          },
          "GET",
          "_blank"
        );
      });
    });
    $(".top-page-show #SubmitEdit").click(function (e) {
      $(".top-page-show #topManagementEdit").submit();
    });
  });
});
