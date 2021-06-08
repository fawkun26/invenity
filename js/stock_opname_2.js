// ==============
let lastStep = 1;
let currentStep = 1; // to render current section
let addedDeviceIds = []; // device_id yang telah ditambahkan ke table
let tableSelisihData = [];
const $tableEmpty = $("#table_empty").DataTable({
  columns: [
    { data: "device" },
    { data: "quantity_fisik" },
    { data: "quantity_database" },
    { data: "selisih" },
    { data: "action" },
  ],
  columnDefs: [
    {
      width: "60%",
      targets: 0,
    },
  ],
});
const $tableSelisih = $("#table_selisih").DataTable({
  columnDefs: [
    {
      width: "60%",
      targets: 0,
    },
  ],
  columns: [
    { data: "device" },
    { data: "quantity_fisik" },
    { data: "quantity_database" },
    { data: "selisih" },
  ],
  drawCallback: function (settings) {
    doStep4();
  },
});

// hide section yang gak active
// - currentstep 1 = section 1, 2
// - currentstep 2 = section 3
// - currentstep 3 = section 4
// - currentstep 4 = section 4, 5
// - currentstep 5 = section 4, 5, 6
function renderSection(currentStep) {
  $(".step").each(function (i, el) {
    if (currentStep == 1) {
      if ($(this).data("step") > 2) {
        $(this).hide();
      } else {
        $(this).show();
      }
    }
    if (currentStep == 2) {
      if ($(this).data("step") != 3) {
        $(this).hide();
      } else {
        $(this).show();
      }
    }
    if (currentStep == 3) {
      if ($(this).data("step") != 4) {
        $(this).hide();
      } else {
        $(this).show();
      }
    }
    if (currentStep == 4) {
      if ($(this).data("step") != 4 && $(this).data("step") != 5) {
        $(this).hide();
      } else {
        $(this).show();
      }
    }

    if (currentStep == 5) {
      if (
        $(this).data("step") != 4 &&
        $(this).data("step") != 5 &&
        $(this).data("step") != 6
      ) {
        $(this).hide();
      } else {
        $(this).css('display', 'inline-block');
        // $(this).show();
      }
    }
  });
}
const $breadcrumb = $("#breadcrumb");
const $lis = $breadcrumb.children();
function renderBreadcrumb(lastStep) {
  $lis.each(function (i, el) {
    if (el.dataset.step <= lastStep) {
      el.classList.remove("disabled");
      el.classList.add("active", "blue");
    } else {
      el.classList.add("disabled");
    }
  });
}
function updateBreadcrumb(step, lastStep) {
  if (step > lastStep) {
    return;
  }
  $lis.each(function (i, el) {
    el.classList.remove("active", "blue");
  });
  $lis.each(function (i, el) {
    if (el.dataset.step <= step) {
      el.classList.add("active", "blue");
    }
  });
}

// step 1 (initialization)
renderBreadcrumb(lastStep);
renderSection(lastStep);
$lis.each(function (i, el) {
  $(this).click(function (e) {
    if ($(this).hasClass("disabled")) return;
    const step = $(this).data("step");
    console.log(step);
    updateBreadcrumb(step, lastStep);
    renderSection(step);
  });
});

// step 2
$("#btn_print_empty").click(function (e) {
  // check dulu apakah table ada datanya
  if (addedDeviceIds.length < 1) {
    e.preventDefault();
    alert("Input data terlebih dahulu!");
    return; // stop function execution;
  }
  lastStep = 2;
  currentStep = 2;
  let device_ids = [];
  $("#table_empty tbody")
    .find("tr")
    .each(function (i, el) {
      device_ids.push($(this).attr("id"));
    });
  $(this).attr(
    "href",
    `reports/opname_empty.php?device_ids=${new URLSearchParams({
      device_ids: device_ids,
    }).get("device_ids")}`
  );
  renderBreadcrumb(lastStep);
  renderSection(currentStep);
});

// step 3
$("#btn_check_fisik").click(function (e) {
  lastStep = 3;
  currentStep = 3;
  renderBreadcrumb(lastStep);
  renderSection(currentStep);
});
// step 4
function doStep4() {
  const $inputs = $(".input-quantity-fisik");
  // remove event handler dulu
  $inputs.each(function () {
    $(this).off("input");
  });
  // baru add ulang
  $inputs.each(function () {
    $(this).on("input", function () {
      let empty = 0;
      $inputs.each(function () {
        if ($(this).val() == "") {
          empty++;
        }
      });
      console.log(empty);
      if (empty === 0) {
        // stage 4
        lastStep = 4;
        currentStep = 4;
        renderBreadcrumb(lastStep);
        renderSection(currentStep);
      }
    });
  });
}

// step 5
$("#btn_check_selisih").click(function (e) {
  // kosongkan tableSelisihData dulu kalo misalkan mau check selisih ulang
  tableSelisihData = [];
  lastStep = 5;
  currentStep = 5;
  // ajax call
  let device_ids = [];
  $(".input-quantity-fisik").each(function (i, el) {
    device_ids.push(el.dataset.deviceId);
  });
  $.ajax("process/stock_opname_2.php", {
    method: "POST",
    data: {
      username: "ilham",
      device_ids,
      action: "check_quantity",
    },
  }).then((response) => {
    response = JSON.parse(response);
    response.forEach(function (item) {
      // render/show data ke $tableSelisih
      const $tr = $("#table_selisih tbody").find(`tr#${item.device_id}`);
      const $tdQuantityDatabase = $tr.children()[2];
      const $tdSelisih = $tr.children()[3];
      const inputValue = Number($tr.find(".input-quantity-fisik").val());
      $tableSelisih.cell($tdQuantityDatabase).data(item.device_quantity);
      $tableSelisih.cell($tdSelisih).data(item.device_quantity - inputValue);
    });
    // input data ke tableSelisihData
    $tableSelisih.rows().every(function () {
      let data = this.data();
      let quantityFisikValue = $(
        `.input-quantity-fisik[data-device-id=${data.DT_RowId}]`
      ).val();
      data.quantity_fisik = Number(quantityFisikValue);
      tableSelisihData.push(data);
    });
    // add tableSelisihData ke $inputdatatableselisih
    $("#input_data_table_selisih").val(JSON.stringify(tableSelisihData));
    renderBreadcrumb(lastStep);
    renderSection(currentStep);
  });
});
/// step 6
$("#btn_print_report").click(function (e) {
  // $(this).attr('href', `reports/opname_empty.php?device_ids=${new URLSearchParams({device_ids: device_ids}).get('device_ids')}`);
  lastStep = 6;
  currentStep = 6;
  renderBreadcrumb(lastStep);
});

// tambah data ke table_empty dan table_selisih (step 1)
const $selectDevice = $("#select_device");
$("#btn_tambah").click((e) => {
  e.preventDefault();
  const namaDevice = $("#select_device option:selected").data("nama-device");
  const device_id = $("#select_device option:selected").val();
  $("#select_device").val("");
  $("#select_device").trigger("chosen:updated");
  // validasi agar tidak ada device_id yang sama diinput
  if (addedDeviceIds.includes(device_id)) {
    return; // stop function execution.
  }
  addedDeviceIds.push(Number(device_id));

  $tableEmpty.row
    .add({
      DT_RowId: device_id,
      device: namaDevice,
      quantity_fisik: "-",
      quantity_database: "-",
      selisih: "-",
      action: `<button class="btn btn-sm btn-danger btn-delete" data-device-id="${device_id}"><i class="glyphicon glyphicon-remove"></i></button>`,
    })
    .draw(false);
  $tableSelisih.row
    .add({
      DT_RowId: device_id,
      device: namaDevice,
      quantity_fisik: `<input type="number" data-device-id="${device_id}" class="input-quantity-fisik"/>`,
      quantity_database: "-",
      selisih: "-",
    })
    .draw(false);
});
// delete row
$("#table_empty tbody").on("click", "button.btn-delete", function (e) {
  console.log("delete!");
  const device_id = $(this).data("device-id");
  addedDeviceIds = addedDeviceIds.filter(function (value) {
    if (value != device_id) return value;
  });
  $tableEmpty.row($(this).parents("tr")).remove().draw();
  $tableSelisih.row(`#${device_id}`).remove().draw();
});
