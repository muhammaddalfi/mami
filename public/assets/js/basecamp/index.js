$(document).ready(function(){
    $('.mitra_id').select2({
        dropdownParent: $('#modal_basecamp'),
        allowClear: true,
        placeholder: 'Pilih'
    });

    $('.edit_mitra_id').select2({
        dropdownParent: $('#modal_edit_basecamp'),
        allowClear: true,
        placeholder: 'Pilih'
    });


    var table = $('.datatable-responsive').DataTable({
        processing:true,
        serverSide:true,
        responsive: true,
        ajax: '/basecamp/fetch',
        autoWidth: false,
        
        columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false },
            {data:'nama_basecamp'},
            {data:'perusahaan.nama_perusahaan'},
            {data: 'action', name: 'action', className: 'text-center',orderable: false, searchable: false, width: 220}
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

    //add activity
    $(document).on('click','.add_basecamp', function(e){
        e.preventDefault();
        $('#modal_basecamp').modal('show');   

    })


    var basecamp = $('#form-basecamp')[0];
    $('#save').on('click',function(e){
        e.preventDefault();
        var form  = new FormData(basecamp);
        // console.log(data);
        $.ajax({
            url: '/basecamp/store',
            method:'POST',
            data: form,
            processData: false,
            contentType: false,

            success: function(response){
                if(response.status == 400)
                {
                    console.log(response);
                    $('#error_nama_basecamp').html(response.errors.nama_basecamp);
                  
                }else{
                   console.log(response); 
                    table.draw();
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data inserted successfully',
                    icon: 'success'
                    });

                    $('#modal_basecamp').modal('hide');
                    $("#form-basecamp")[0].reset();
                }
            }
        })

    })

    //  //edit button
    $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#modal_edit_basecamp').modal('show');
        $.ajax({
            type:"GET",
            url:"/basecamp/edit/" + id,
            success: function(response){
                if(response.status == 404){
                    console.log("Data not found");
                }else{
                    $('#id_basecamp').val(response.basecamp.id);
                    $('#edit_nama_basecamp').val(response.basecamp.nama_basecamp);
                    $('#edit_mitra_id').val(response.basecamp.mitra_id).change();
                }
            }
        })
    })

   $(document).on('click', '.save', function(e){
        e.preventDefault();
        var id = $('#id_basecamp').val();
        var data = {
            'edit_nama_basecamp': $('#edit_nama_basecamp').val(),
            'edit_mitra_id': $('#edit_mitra_id').val()
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:"PUT",
            url:"/basecamp/update/"+ id,
            data: data,
            dataType:"json",
            success: function(response){
            table.draw();
              Swal.fire({
                    title: 'Suksess!',
                    text: 'Data berhasil disimpan!',
                    icon: 'success'
                });
                    $('#modal_edit_basecamp').modal('hide');
            
            }
        })

    });


    //delete
    $(document).on('click', '.delete', function(e){
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
            title: 'Remove data',
            text: "Are you sure ?",
            showCancelButton: true,
            confirmButtonColor: 'btn btn-success',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/basecamp/delete/" + id,
                   
                    success: function(){
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
    

});