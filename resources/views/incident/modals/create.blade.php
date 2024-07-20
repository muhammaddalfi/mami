<div id="modal_incident" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Incident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="form-incident" enctype="multipart/form-data" action="#" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="form-label">No Incident</label>
                                <input type="text" class="form-control" required id="no_incident" name="no_incident">
                                <span id="error_no_incident" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">Nama Incident</label>
                                <input type="text" class="form-control" required id="nama_incident"
                                    name="nama_incident">
                                <span id="error_nama_incident" class="text-danger"></span>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Tanggal Incident</label>
                                <input type="text" class="form-control tgl_incident" required id="tgl_incident"
                                    name="tgl_incident">
                                <span id="error_tgl_incident" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="form-label">Lokasi</label>
                                <input type="text" class="form-control" required id="lokasi" name="lokasi">
                                <span id="error_lokasi" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">Latitude</label>
                                <input type="text" class="form-control" required id="lat" name="lat">
                                <span id="error_lat" class="text-danger"></span>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Longitude</label>
                                <input type="text" class="form-control" required id="lon" name="lon">
                                <span id="error_lon" class="text-danger"></span>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="form-label">Basecamp Serpo</label>
                                <select class="form-control basecamp_serpo" name="basecamp_serpo" id="basecamp_serpo"
                                    data-fouc>
                                    <option></option>
                                    @foreach ($basecamp as $item)
                                        <option value="{{ $item->id }}"> {{ $item->nama_basecamp }}
                                        </option>
                                    @endforeach

                                </select>
                                <span id="error_basecamp_serpo" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">Jenis Material</label>
                                <select class="form-control jenis_material" name="jenis_material" id="jenis_material"
                                    data-fouc>
                                    <option></option>
                                    @foreach ($material as $item)
                                        <option value="{{ $item->id }}"> {{ $item->jenis_material }}
                                        </option>
                                    @endforeach

                                </select>
                                <span id="error_jenis_material" class="text-danger"></span>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Jumlah Material</label>
                                <input class="form-control" type="number" name="jumlah_material" id="jumlah_material"
                                    value="0">
                                <span id="error_jumlah_material" class="text-danger"></span>
                            </div>

                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4" id="view-blob">
                                <label class="form-label">Upload Gambar</label>
                                <input type="file" id="gambar" name="gambar" class="form-control"
                                    accept="image/*">
                                <span id="error_images" class="text-danger"></span>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="save">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
