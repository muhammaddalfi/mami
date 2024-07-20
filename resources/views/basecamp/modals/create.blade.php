<div id="modal_basecamp" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Basecamp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-basecamp" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Nama Basecamp</label>
                                <input type="text" class="form-control" required id="nama_basecamp"
                                    name="nama_basecamp">
                                <span id="error_nama_basecamp" class="text-danger"></span>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Mitra</label>
                                <select class="form-control mitra_id" name="mitra_id" id="mitra_id" data-fouc>
                                    <option></option>
                                    @foreach ($mitra as $item)
                                        <option value="{{ $item->id }}"> {{ $item->nama_perusahaan }}
                                        </option>
                                    @endforeach

                                </select>
                                <span id="error_mitra_id" class="text-danger"></span>
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
