var data;
var dataList =[];

$(document).ready(function(){
    activesidebar()
    Init();
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd ',
        todayHighlight: true,

    });
    MutasiTable.Init('#tblmutasi');

    $('.dataTables_filter').addClass('pull-left');
    $('.dataTables_paginate').addClass('pull-left');
});

var MutasiTable = {
    Init: function (elm,opt) {
        if ($(elm).length > 0) {
            $(elm).each(function () {
                var auto_responsive = $(this).data('auto-responsive');
                var def = {
                    responsive: true,
                    autoWidth: false,
                    dom: '<"row justify-between g-2"<"col-7 col-sm-6 text-left"f><"col-5 col-sm-6 text-right"<"datatable-filter"l>>><"datatable-wrap my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-left text-md-right"i>>',
                    "searching" : false,
                    buttons : false,
                    buttons : [
                        {
                            extend:'pdfHtml5',
                            text: 'Cetak',
                            download: 'open',
                            messageTop: '',
                            className : 'btn btn-md btn-info',
                            title:'',
                            // pageSize: '5.9in 6.10in',
                            exportOptions:{
                                columns:[0,8,6,3,4,5,7]
                            },
                            customize: function ( pdf,btn,tbl ) 
                            {
                                delete pdf.styles.tableBodyOdd.fillColor;
                                // $(win.document.body).find('table').addClass('compact').css('font-size', '12pt');
                                // $(win.document.body).find('table').addClass('compact').css('color', 'green');
                                // $(win.document.body).find('table').css('border', '0px solid #000');
                                // $(win.document.body).find('table td').css('border-left', '0px solid #000');
                                // $(win.document.body).find('table td').css('border-top', '0px solid #000');
                                // $(win.document.body).find('table td').css('border-right', '0px solid #000');
                                // $(win.document.body).find('table td').css('border-bottom', '0px solid #000');
                                 
                                // $(win.document.body).find( 'table > thead' ).remove();

                                // $(win.document.body).find('td:nth-child(1)').css('width','40px');
                                // $(win.document.body).find('td:nth-child(2)').css('width','60px');
                                // $(win.document.body).find('td:nth-child(3)').css('width','40px');
                                
                            }
                        }

                    ],
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
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(data.idtransaksi) ? data.idtransaksi : '') + '</span>';
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
    $("#barMutasi").addClass('active');

}

function Init()
{
    $.ajax({
        type: "GET",
        url: BASE_URL+'/transaksi/getrekening',
        data: "",
        dataType: "json",
        success: function (response) {
            $('#inputNorek').select2({
                allowClear: true,
                placeholder: "pilih",
                width: '100%',
                data:response
            });
        }
    });    
}

$("#searchData").click(function (e) {
    var isvalid = true;
    var errMesg = '<ul>';
    var norek = $("#inputNorek").select2('data')[0];
    
    if(app.checkObj.isEmptyNullOrUndefined(norek))
    {
        errMesg = errMesg+"<li>Nomor rekening tidak boleh kosong</li>"
        isvalid = false;
    }

    // if(app.checkObj.isEmptyNullOrUndefined(norek))
    // {
    //     errMesg = errMesg+"<li>Kode transaksi tidak boleh kosong</li>"
    //     isvalid = false;
    // }
    

    if(app.checkObj.isEmptyNullOrUndefined())
    if(!isvalid)
    {
        Swal.fire({
            icon: 'error',
            title: errMesg+ "</ul>",
            showConfirmButton: true,
            timer: 5000
          })
        return false;
    }

    searchdata()
});

function searchdata()
{
    var periodFrom = $("#periodFrom").val();
    var periodTo = $("#periodTo").val();
    var norek = $("#inputNorek").select2('data')[0].text;
    var kodeTransaksi = $("#idTransaksi").val();
    $.ajax({
        type: "GET",
        url: BASE_URL+'/mutasi/searchdata',
        data: { norek: norek, periodFrom :periodFrom, periodTo : periodTo, id : kodeTransaksi},
        dataType: "json",
        success: function (response) {
            debugger;
            console.log(response)
            MutasiTable.DataBind(response);

        }
    });
}

$('#inputNorek').on('select2:select', function (e) {
    var data = e.params.data;
    console.log(data.id);

    $.ajax({
        type: "GET",
        url: BASE_URL+'/transaksi/getdetailnasabah',
        data: {id: data.id},
        dataType: "Json",
        success: function (response) {
            let res = response[0];
            $("#inputnis").val(res.nis);
            $("#inputnama").val(res.Nama);
        }
    });
});

$("#generate").click(function(){

    var isvalid = true;
    var errMesg = '<ul>';
    var norek = $("#inputNorek").select2('data')[0];
    // var idtransaksi = $("#idTransaksi").val();
    if(app.checkObj.isEmptyNullOrUndefined(norek))
    {
        errMesg = errMesg+"<li>Nomor rekening tidak boleh kosong</li>"
        isvalid = false;
    }

    // if(app.checkObj.isEmptyNullOrUndefined(norek))
    // {
    //     errMesg = errMesg+"<li>Kode transaksi tidak boleh kosong</li>"
    //     isvalid = false;
    // }
    

    if(app.checkObj.isEmptyNullOrUndefined())
    if(!isvalid)
    {
        Swal.fire({
            icon: 'error',
            title: errMesg+ "</ul>",
            showConfirmButton: true,
            timer: 5000
          })
        return false;
    }

    var periodFrom = $("#periodFrom").val();
    var periodTo = $("#periodTo").val();
    var norek = $("#inputNorek").select2('data')[0].text;
    var id = $("#idTransaksi").val();
debugger
    if(app.checkObj.isEmptyNullOrUndefined(id)) id = 0;

    var url = BASE_URL+'/print/'+id+'/'+norek+'/'+periodFrom+'/'+periodTo;
    window.open(url,'_blank');
})