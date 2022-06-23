var flag;
var flaginput;
var table;
var data = [], listTransaksi =[];
var selectedData = {};
$(document).ready(function(){

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd ',
        todayHighlight: true,

    });

    activesidebar()
    // $("#tbltransaksi").DataTable();
    // table = $("#tbltransaksi").DataTable();

    TransaksiTable.Init("#tbltransaksi");
    Init();
    EventMessage()

    GetData.Init();

    // $.fn.modal.Constructor.prototype.enforceFocus = function() {};
})

function EventMessage()
{
    if(localStorage.getItem("success"))
    {
        // let item = JSON.parse(localStorage.getItem("success"));

        // console.log(item);
        $('#alert-text-success').text("Data Transaksi Berhasil Di Tambahkan");
        $('#add-alert-success').show();
    }else if(localStorage.getItem("error"))
    {
        $('#alert-text-danger').text("Data Transaksi Gagal Di Tambahkan");
        $('#show-alert-danger').show();
    }
    localStorage.removeItem("success");
    localStorage.removeItem("error");
}

function activesidebar()
{

    $("#sideDropdown2").removeClass('collapsed');
    $("#collapseTabungan").addClass('show');
    $("#barTransaksi").addClass('active');
    $("#barDashboard").removeClass('active');
    $("#barMutasi").removeClass('active');
    $("#barInfoSaldo").removeClass('active');
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
                dropdownParent: $('#modaltransaksi'),
                allowClear: true,
                placeholder: "pilih",
                width: '100%',
                data:response
            });
        }
    });
    
}

function onlyNumber(event)
{
    var angka = (event.which) ? event.which : event.keyCode;
    if(isNaN(String.fromCharCode(angka)))
        return false;
    return true;
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
            $("#inputjenistabungan").val(res.jenis_tabungan)
        }
    });
});

$("#btnSetorTunaiModal").click(function(){
    flag = 'insert';
    flaginput = "kredit";    
    $("#modaltransaksi").modal('show');
    
});

$("#btnTarikTunaiModal").click(function(){
    flag = 'insert';
    flaginput = "debit";    
    $("#modaltransaksi").modal('show');
});

$("#savedata").click(function(){
    debugger
    if(populateData())
    {
        var params = {
            norek : $("#inputNorek").select2('data')[0].text,
            nis : $("#inputnis").val(),
            sandi : $("#inputsandi").val(),
            debit : flaginput == "debit" ? Number($("#inputnominal").val()) : 0,
            kredit : flaginput == "kredit" ? Number($("#inputnominal").val()) : 0,
            flag : flag
        }
        $.ajax({
            type: "POST",
            url: BASE_URL+'/transaksi/savedata',
            data: params,
            dataType: "Json",
            success: function (response) {
                console.log(JSON.stringify(response))
            
                $("#modaltransaksi").modal('hide');
                GetData.Init();
                Swal.fire({
                    title: 'Success!',
                    text: "Data Berhasil Di simpan",
                    icon: 'success',
                    position: "bottom-end",
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                      },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                      },  
                    footer: '<a href="'+BASE_URL+'/mutasi'+'">Cetak Buku</a>'
                  });
                }
        });
    }
})

function populateData(){
    var isvalid = true;
    var listparam =[];
    var nomorRekening = $("#inputNorek").select2('val');
    var nis = $("#inputnis").val();
    var nominal = $("#inputnominal").val();
    var sandi = $("#inputsandi").val();

    var errMesg = '<ul>';

    if(nomorRekening == '' || nomorRekening == null)
    {
        errMesg = errMesg+" <li>Nomor Rekening Tidak Boleh Kosong</li>"
        isvalid = false;
    }

    if(nominal.length < 1 || nominal == null)
    {
        errMesg = errMesg+"<li>Nominal Tidak Boleh Kosong</li>"
        isvalid = false;
    }else
    {

        if(nominal < 10000 || nominal == null)
        {
            errMesg = errMesg+"<li>Nominal harus 10.000 atau lebih</li>"
            isvalid = false;
        }
    }

    if(isvalid)
    {
        listparam.push({
            norek : $("#inputNorek").select2('data')[0].text,
            nis : nis,
            nominal : nominal,
            sandi : sandi
        });

        return listparam;
    }else
    {
        bootbox.alert({
            title : "<p style='color:red'>Warning!</p>",
            message: errMesg+ "</ul>"
        });
        return false;
    }
}

function clear()
{
    $("#inputNorek").val('').trigger('change');
    $("#inputnis").val('');
    $("#inputnama").val('');
    $("#inputjenistabungan").val('');
    $("#inputnominal").val('');
}

// $('#tbltransaksi tbody').on('click', '#btnEdit', function () {
//     flag = "update";
//     var data_row = table.row( $(this).parents('tr') ).data(); // here is the change
//     console.log(data_row);
//    $("#modaltransaksi").modal('show');
  
//    $('#modaltransaksi').on('shown.bs.modal', function() {

//         $("#inputNorek").val(data_row[9]).trigger("change");
//         $("#inputNorek").prop('disabled',true);
//         $("#inputNorek").change(function() {
//             console.log('on country change');
//             });
//         $('#inputnis').val(data_row[1])
//         $('#inputnama').val(data_row[2]).attr('readonly',false);
//         $('#inputnominal').val(data_row[3] == 0 ? data_row[4] : data_row[3]).attr('readonly',false);
//         $("#inputsandi").val(data_row[6]);

        
//    });
  
//   });

  
   $('#modaltransaksi').on('shown.bs.modal', function() {
        clear();
        if(flag == 'update')
        {
            var data = selectedData;
            $("#inputNorek").val(data.norek).trigger("change");
            $("#inputNorek").prop('disabled',true);
            $("#inputNorek").change(function() {
                console.log('on country change');
                });
            $('#inputnis').val(data.nis)
            $('#inputnama').val(data.nama).attr('readonly',false);
            $('#inputjenistabungan').val(data.systemDesc);
            $('#inputnominal').val(data.kredit != '0' ? data.kredit : data.debit).attr('readonly',false);
            $("#inputsandi").val(data.sandi).attr('disabled',true);
            flaginput = data.sandi == '1' ? 'kredit' : 'debit';
        }
        if(flaginput == 'debit')
        {
            $("#lblnominal").text('Jumlah Tarik Tunai');
            $("#transaksilabel").text('Tarik Tunai');
            $("#inputsandi").val('2').prop('disabled',true);
            $("#inputNorek").prop('disabled',false);
        }else if(flaginput == 'kredit')
        {
            $("#lblnominal").text('Jumlah Setor Tunai');
            $("#transaksilabel").text('Setor Tunai');
            $("#inputsandi").val('1').prop('disabled',true)
            $("#inputNorek").prop('disabled',false);
        }
        
   });

  $("#searchData").click(function () { 
    var periodFrom = $("#periodFrom").val();
    var periodTo = $("#periodTo").val();
 
    debugger
 
    if(periodFrom>periodTo)
    {
     bootbox.alert({
         title : "<p style='color:red'>Warning!</p>",
         message: "Periode tidak valid"
     });
     return true;
    }
    $.ajax({
        type: "GET",
        url: BASE_URL+'/transaksi/filter',
        data: {
            periodFrom:periodFrom,
            periodTo:periodTo
        },
        dataType: "JSON",
        success: function (response) {
            console.log('success')
            console.log(response)
            TransaksiTable.DataBind(response.listTransaksi);
 
        },
        error: function(data){
            console.log('error')
            console.log(data)
        }
    });
    
 });

 var GetData = {
    Init: function(){
        var periodFrom = $("#periodFrom").val();
        var periodTo = $("#periodTo").val();

        $.ajax({
            type: "GET",
            url: BASE_URL+'/transaksi/filter',
            data: {
                periodFrom:periodFrom,
                periodTo:periodTo
            },
            dataType: "JSON",
            success: function (response) {
                console.log('success')
                console.log(response)
                TransaksiTable.DataBind(response.listTransaksi);
     
            },
            error: function(data){
                console.log('error')
                console.log(data)
            }
        });

    }
 }
 
 var TransaksiTable = {
    Init: function (elm, opt) {
        debugger
        if ($(elm) !== 'undefined') {
            $(elm).each(function () {
                var auto_responsive = $(this).data('auto-responsive');
                var def = {
                    responsive: true,
                    autoWidth: false,
                    dom: '<"row justify-between g-2"<"col-7 col-sm-6 text-right"<"datatables-filter pull-left"f>><"col-5 col-sm-6 text-right"<"datatable-filter"l>>><"datatable-wrap my-3"t><"row align-items-left"<"col-5 col-sm-12 col-md-3"i><"col-7 col-sm-12 col-md-9 text-left text-md-right"p>>',
                    language: {
                        search: "Search",
                        searchPlaceholder: "Type in to Search",
                        // lengthMenu: "<span class='d-none d-sm-inline-block'>Show</span><div class='form-control-select'> _MENU_ </div>",
                        info: "_START_ -_END_ of _TOTAL_",
                        infoEmpty: "No records found",
                        paginate: {
                            "first": "First",
                            "last": "Last",
                            "next": "Next",
                            "previous": "Prev"
                        },
                        infoFiltered: "( Total _MAX_  )"
                    },
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "rowCallback": function (row, data) {
                        $(row).addClass('nk-tb-item');
                    },
                    "oSearch": { "bSmart": false, "bRegex": true },
                    "columns": [
                        {
                            data: null,
                            className: "nk-tb-col tb-col-xs text-left",
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                debugger
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(row.nis) ? row.nis : '') + '</span>';
                            }
                        },
                        {
                            data: null,
                            "className": "nk-tb-col text-left",
                            visible : false,
                            render: function (data, type, row, meta) {
                                debugger
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(row.systemDesc) ? row.systemDesc : '') + '</span>';
                            }
                        },
                        {
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(row.nama) ? row.nama : '') + '</span>';
                            }
                        },
                        {
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(row.debit) ? row.debit : 0) + '</span>';
                            }
                        },
                        {
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(row.kredit) ? row.kredit : 0) + '</span>';
                            }
                        },
                        {
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(row.saldo) ? row.saldo : 0) + '</span>';
                            }
                        },
                        {
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(row.sandi) ? row.sandi : '') + '</span>';
                            }
                        },
                        {
                            data: null,
                            "className": "nk-tb-col text-left",
                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(row.created_by) ? row.created_by : '') + '</span>';
                            }
                        },
                        {
                            data: null,
                            "className": "nk-tb-col text-left",

                            render: function (data, type, row, meta) {
                                return '<span>' + (!app.checkObj.isEmptyNullOrUndefined(row.created_dt) ? row.created_dt : '') + '</span>';
                            }
                        },
                        {
                            //width: '10vw',
                            data: null,
                            "className": "nk-tb-col text-center",
                            render: function (data, type, row) {
                               
                                var html = '<button type="button" id="btEdit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i</button>';
                                return html;
                            }
                        }
                    ]
                },
                    attr = (opt) ? extend(def, opt) : def;
                attr = (auto_responsive === false) ? extend(attr, { responsive: false }) : attr;

                $(this).DataTable(attr);
            });
        }

        listTransaksi = $(elm).DataTable();

        // $('#modalProcess').modal('show');
        $(elm + ' tbody').off().on('click', 'button#btEdit', function (e) {
            
            $("#modaltransaksi").modal('show');
            flag = "update"
            selectedData = $(elm).DataTable().row($(this).parents('tr')).data();

        });
        
    },
    DataBind: function (data) {
        listTransaksi.clear().rows.add(data).draw();
        listTransaksi.columns.adjust();
    }
}