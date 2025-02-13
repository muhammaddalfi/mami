<div id="modal_edit_material" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Jenis Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_material">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Jenis Material</label>
                            <input type="text" class="form-control" required id="edit_jenis_material"
                                name="edit_jenis_material">
                            <span id="error_jenis_material" class="text-danger"></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Harga Material</label>
                            <input type="text" class="form-control" required id="edit_harga_material"
                                name="edit_harga_material">
                            <span id="error_harga_material" class="text-danger"></span>
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
