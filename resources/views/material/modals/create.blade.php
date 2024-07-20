<div id="modal_material" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jenis Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-material" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Jenis Material</label>
                                <input type="text" class="form-control" required id="jenis_material"
                                    name="jenis_material">
                                <span id="error_jenis_material" class="text-danger"></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Harga Material</label>
                                <input type="text" class="form-control" required id="harga_material"
                                    name="harga_material">
                                <span id="error_harga_material" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="save" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
