$(document).ready(function () {

    

    $('.basecamp_serpo').select2({
        dropdownParent: $('#modal_incident'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_basecamp_serpo').select2({
        dropdownParent: $('#modal_edit_incident'),
        allowClear: true,
        placeholder: 'Pilih'
    });


    $('.jenis_material').select2({
        dropdownParent: $('#modal_incident'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_jenis_material').select2({
        dropdownParent: $('#modal_edit_incident'),
        allowClear: true,
        placeholder: 'Pilih'
    });


    const post_tgl_incident = document.querySelector('.tgl_incident');
        if(post_tgl_incident) {
            const dpAutoHide = new Datepicker(post_tgl_incident, {
                container: '#modal_incident',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
               format: 'dd-mm-yyyy',
                autohide: true,
            });
        }

    const post_edit_tgl_incident = document.querySelector('.edit_tgl_incident');
        if(post_edit_tgl_incident) {
            const dpAutoHide = new Datepicker(post_edit_tgl_incident, {
                container: '#modal_edit_incident',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd-mm-yyyy',
                autohide: true,
            });
        }

    var table = $('.datatable-responsive').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '/incident/fetch',
        autoWidth: true,

        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'no_incident' },
            { data: 'nama_incident' },
            { data: 'tgl_incident' },
            { data: 'material.jenis_material' },
            { data: 'basecamp.nama_basecamp'},
            { data: 'user.name' },
            { data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false, width: 220 }
        ],
        order: [[ 0, "desc" ]],
        dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
    });


    $(document).on('click','.add_incident', function(e){
        e.preventDefault();
        $('#modal_incident').modal('show');   

    })

    $(document).on('click', '.view', function (e) {
        e.preventDefault();
        var id_incident = $(this).data('id');
        $('#modal_view').modal('show');
        $.ajax({
            type: "GET",
            url: "/incident/show/" + id_incident,
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

    var incident = $('#form-incident')[0];
    var blob_image;
    $('#save').on('click', function (e) {
        e.preventDefault();
        var form = new FormData(incident);
        form.append('image_compressed', blob_image);
        $.ajax({
            url: '/incident/store',
            method: 'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == 400) {
                    // console.log(response);
                     $('#error_no_incident').html(response.errors.no_incident);
                     $('#error_nama_incident').html(response.errors.nama_incident);
                     $('#error_tgl_incident').html(response.errors.tgl_incident);
                     $('#error_lokasi').html(response.errors.lokasi);
                     $('#error_lat').html(response.errors.lat);
                     $('#error_lon').html(response.errors.lon);
                     $('#error_basecamp_serpo').html(response.errors.basecamp_serpo);
                     $('#error_jenis_material').html(response.errors.jenis_material);
                     $('#error_jumlah_material').html(response.errors.jumlah_material);
                     $('#error_images').html(response.errors.gambar);

                } else {
                    table.draw();
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data Berhasil ditambahkan',
                        icon: 'success'
                    });

                    $('#modal_incident').modal('hide');
                    $("#form-incident")[0].reset();
                }
            }
        })

    })

    //  //edit button
    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_incident').modal('show');
        
        $.ajax({
            type: "GET",
            url: "/incident/edit/" + id,
            success: function (response) {
                if (response.status == 404) {
                    console.log("Data not found");
                } else {
                    console.log(response);
                    let edit_tgl_incident = moment(response.incident.tgl_incident).format('DD-MM-YYYY');
                    
                    $('#id_incident').val(response.incident.id);
                    $('#edit_no_incident').val(response.incident.no_incident);
                    $('#edit_nama_incident').val(response.incident.nama_incident);
                    $('#edit_tgl_incident').val(edit_tgl_incident);
                    $('#edit_lokasi').val(response.incident.lokasi);
                    $('#edit_lat').val(response.incident.lat);
                    $('#edit_lon').val(response.incident.lng);
                    $('#edit_basecamp_serpo').val(response.incident.basecamp.nama_basecamp).change();
                    $('#edit_jenis_material').val(response.incident.jenis_material).change();
                    $('#edit_jumlah_material').val(response.incident.jumlah_material).change();
                    $('#view_images').attr("src", "storage/files/" + response.incident.gambar);

                }
            }
        })
    })

    var form_edit = $('#edit_incident')[0];
    $(document).on('submit', '#edit_incident', function (e) {
        e.preventDefault();
        var id = $('#id_incident').val();
        let editdata = new FormData(form_edit);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/incident/update/" + id,
            data: editdata,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                Swal.fire({
                    title: 'Success!',
                    text: 'Data has been changed',
                    icon: 'success'
                });
                table.draw();
                $('#modal_edit_incident').modal('hide');
                $("#edit_incident")[0].reset();
            }
        })

    });

    //delete
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        // console.log(id);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Warning alert
        Swal.fire({
            title: 'Hapus Data',
            text: "Apakah Kamu Yakin ?",
            showCancelButton: true,
            confirmButtonColor: 'btn btn-success',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/incident/delete/" + id,

                    success: function () {
                        table.draw();
                        Swal.fire(
                            'Success!',
                            'Data has been removed',
                            'success'
                        )
                    }
                })
            }
        });

    });

 
    const MAX_WIDTH = 1080;
    const MAX_HEIGHT = 720;
    const MIME_TYPE = "image/jpeg";
    const QUALITY = 80;

    const input = document.getElementById("gambar");
    input.onchange = function (ev) {
        const file = ev.target.files[0]; // get the file
        const blobURL = URL.createObjectURL(file);
        const img = new Image();
        img.src = blobURL;
        img.onerror = function () {
            URL.revokeObjectURL(this.src);
            // Handle the failure properly
            console.log("Cannot load image");
        };
        img.onload = function () {
            URL.revokeObjectURL(this.src);
            const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
            const canvas = document.createElement("canvas");
            canvas.width = newWidth;
            canvas.height = newHeight;
            const ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, newWidth, newHeight);
            canvas.toBlob(
                (blob) => {
                    // Handle the compressed image. es. upload or save in local state
                    blob_image = blob;
                },
                MIME_TYPE,
                QUALITY
            );

        };
    };

    function calculateSize(img, maxWidth, maxHeight) {
        let width = img.width;
        let height = img.height;

        // calculate the width and height, constraining the proportions
        if (width > height) {
            if (width > maxWidth) {
                height = Math.round((height * maxWidth) / width);
                width = maxWidth;
            }
        } else {
            if (height > maxHeight) {
                width = Math.round((width * maxHeight) / height);
                height = maxHeight;
            }
        }
        return [width, height];
    }

    // Utility functions for demo purpose

    function displayInfo(label, file) {
        const p = document.createElement('p');
        p.innerText = `${label} - ${readableBytes(file.size)}`;
        document.getElementById('view-blob').append(p);
    }

    function readableBytes(bytes) {
        const i = Math.floor(Math.log(bytes) / Math.log(1024)),
            sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + sizes[i];
    }

});