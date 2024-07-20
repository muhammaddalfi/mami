<div id="modal_edit_basecamp" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Nama Basecamp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body">
                @csrf
                <input type="hidden" id="id_basecamp">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label">Nama Basecamp</label>
                            <input type="text" class="form-control" required id="edit_nama_basecamp"
                                name="edit_nama_basecamp">
                            <span id="error_nama_basecamp" class="text-danger"></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Mitra</label>
                            <select class="form-control edit_mitra_id" name="edit_mitra_id" id="edit_mitra_id"
                                data-fouc>
                                <option></option>
                                @foreach ($mitra as $item)
                                    <option value="{{ $item->id }}"> {{ $item->nama_perusahaan }}
                                    </option>
                                @endforeach

                            </select>
                            <span id="error_edit_mitra_id" class="text-danger"></span>
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
