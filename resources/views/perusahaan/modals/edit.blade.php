<div id="modal_edit_perusahaan" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Nama perusahaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_perusahaan">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form-label">Nama perusahaan</label>
                            <input type="text" class="form-control" required id="edit_nama_perusahaan"
                                name="edit_nama_perusahaan">
                            <span id="error_nama_perusahaan" class="text-danger"></span>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary save">Save</button>
            </div>
        </div>
    </div>
</div>
