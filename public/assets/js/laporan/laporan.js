$(document).ready(function(){

    var start_date = moment().subtract(1,'M');
    var end_date = moment();

    $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));

    $('#daterange').daterangepicker({
        startDate : start_date,
        endDate : end_date
    }, function(start_date, end_date){
        $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));
        table.draw();
    });

    var table = $('.datatable-laporan-baddeb').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
                url: '/laporan/search',
                data: function(data){
                    data.from_date = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    data.end_date = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
                }
        },
        autoWidth: true,

        columns: [
            {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data:'no_incident'},
            {data:'nama_incident'},
            {data:'tgl_incident'},
            {data:'jenis_material'},
            {data:'nama_basecamp'},
            {data:'name'},
            {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false, width: 220 }
        ],
        order: [[0, "desc"]],
        dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span class="me-3">Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
        },
        buttons: {            
            dom: {
                button: {
                    className: 'btn btn-light'
                }
            },
            buttons: [
                'excelHtml5'
            ]
        }
    });

    $(document).on('click', '.view', function (e) {
        e.preventDefault();
        var id_incident = $(this).data('id');
        $('#modal_view_laporan').modal('show');
        $.ajax({
            type: "GET",
            url: "/laporan/show/" + id_incident,
            success: function (response) {
                if (response.status == 404) {
                    console.log('Data Not Found');
                } else {
                    let tanggal = moment(response.incident.tgl_incident).format('DD-MM-YYYY');
                    let tanggal_input = moment(response.incident.created_at).format('DD-MM-YYYY');
                    let total = ((response.incident.jumlah_material) * (response.incident.material.harga_material));
                
                    $('#view_tanggal_incident').html(tanggal);
                    $('#view_no_incident').html(response.incident.no_incident);
                    $('#view_nama_incident').html(response.incident.nama_incident);
                    $('#view_lokasi_incident').html(response.incident.lokasi);
                    $('#view_basecamp').html(response.incident.basecamp.nama_basecamp);
                    $('#view_mitra').html(response.incident.user.name);
                    $('#view_jenis_material').html(response.incident.material.jenis_material);
                    $('#view_jumlah_material').html(response.incident.jumlah_material);
                    $('#view_total_harga').html(total);
                    $('#view_tanggal_input_data').html(tanggal_input);

                    $('#gambar_foto').attr("src", "storage/files/" + response.incident.gambar);
                    $('#gambar_link').attr("href", "storage/files/" + response.incident.gambar);

                }
            }
        })

    })
});