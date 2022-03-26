var dataList =[];
$(document).ready(function () {
    activesidebar();
    //$("#tblInfosaldo").DataTable();
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd ',
        todayHighlight: true,

    });
    InfoSaldoTable.Init('#tblInfosaldo');
    $('.dataTables_filter').addClass('pull-left');
    $('.dataTables_paginate').addClass('pull-left');

    searchdata()
});

var InfoSaldoTable = {
    Init: function (elm,opt) {
        if ($(elm).length > 0) {
            console.log(elm)
            $(elm).each(function () {
                var auto_responsive = $(this).data('auto-responsive');
                var def = {
                    responsive: true,
                    // scrollY:true,
                    autoWidth: false,
                    dom: '<"row justify-between g-2"<"col-7 col-sm-6 text-left"f><"col-5 col-sm-6 text-right"<"datatable-filter"l>>><"datatable-wrap my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-left text-md-right"i>>',
                    "columns" : [
                        {
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            //width: '5vw',
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                console.log(data);
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.nis) ? data.nis : '') + '</span>';
                            }
                        },
                        {
                            //width: '5vw',
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.nama) ? data.nama : '') + '</span>';
                            }
                        },
                        {
                            //width: '5vw',
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.debit) ? data.debit : '') + '</span>';
                            }
                        },
                        {
                            //width: '5vw',
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.kredit) ? data.kredit : '') + '</span>';
                            }
                        },
                        {
                            //width: '5vw',
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.saldo) ? data.saldo : '') + '</span>';
                            }
                        },
                        {
                            //width: '5vw',
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.sandi) ? data.sandi : '') + '</span>';
                            }
                        },
                        {
                            //width: '5vw',
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.created_by) ? data.created_by : '') + '</span>';
                            }
                        },
                        {
                            //width: '5vw',
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.created_dt) ? data.created_dt : '') + '</span>';
                            }
                        },
                        {
                            //width: '10vw',
                            data: null,
                            "className": "nk-tb-col text-center",
                            render: function (data, type, row) {

                                var html = '<button type="button" id="btnEdit" class="btn btn-sm btn-primary">\
                                                    <i class="fas fa-eye"></i>\
                                                    </button>\
                                                ';
                                return html;
                            }
                        }
                    ]
                },
                attr = (opt) ? extend(def, opt) : def;
                attr = (auto_responsive === false) ? extend(attr, { responsive: false }) : attr;

                $(this).DataTable(attr).draw();
            });
        }
        dataList = $(elm).DataTable();
      },
      DataBind: function (data) {
        setTimeout(function () {
            dataList.clear().rows.add(data).draw();
            dataList.columns.adjust();
        }, 500);
    }
}

function activesidebar()
{

    $("#sideDropdown2").removeClass('collapsed');
    $("#collapseTabungan").addClass('show');
    $("#barTransaksi").removeClass('active');
    $("#barDashboard").removeClass('active');
    $("#barMutasi").removeClass('active');
    $("#barInfoSaldo").addClass('active');
}

$("#searchData").click(function (e) {
    if(periodFrom>periodTo)
    {
     bootbox.alert({
         title : "<p style='color:red'>Warning!</p>",
         message: "Periode tidak valid"
     });
     return true;
    }
    searchdata()
});

function searchdata()
{
    $("#totaldebit").text('');
    $("#totalkredit").text('');
    $("#totalsaldo").text('');
    var periodFrom = $("#periodFrom").val();
    var periodTo = $("#periodTo").val();

    $.ajax({
        type: "GET",
        url: BASE_URL+'/transaksi/searchdata',
        data: { periodFrom: periodFrom, periodTo: periodTo},
        dataType: "json",
        success: function (response) {
            console.log(response)
            InfoSaldoTable.DataBind(response.listdata);
            $("#totaldebit").append(response.debit.debit);
            $("#totalkredit").append(response.kredit.kredit);
            $("#totalsaldo").append(app.ThousandSeparator(response.saldo.saldo));

        }
    });
}