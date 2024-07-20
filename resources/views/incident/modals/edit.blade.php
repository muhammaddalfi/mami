<div id="modal_edit_incident" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data Incident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="edit_incident" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="" id="id_incident">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="form-label">No Incident</label>
                                <input type="text" class="form-control" id="edit_no_incident"
                                    name="edit_no_incident">
                                <span id="error_edit_no_incident" class="text-danger"></span>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Nama Incident</label>
                                <input type="text" class="form-control" id="edit_nama_incident"
                                    name="edit_nama_incident">
                                <span id="error_edit_nama_incident" class="text-danger"></span>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Tanggal Incident</label>
                                <input type="text" class="form-control edit_tgl_incident" id="edit_tgl_incident"
                                    name="edit_tgl_incident">
                                <span id="error_edit_tgl_incident" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="edit_lokasi" name="edit_lokasi">
                                <span id="error_edit_lokasi" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="edit_lat" name="edit_lat">
                                <span id="error_edit_lat" class="text-danger"></span>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="edit_lon" name="edit_lon">
                                <span id="error_edit_lon" class="text-danger"></span>
                            </div>

                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="form-label">Basecamp Serpo</label>
                                <select class="form-control edit_basecamp_serpo" name="edit_basecamp_serpo"
                                    id="edit_basecamp_serpo" data-fouc>
                                    <option></option>
                                    @foreach ($basecamp as $item)
                                        <option value="{{ $item->id }}"> {{ $item->nama_basecamp }}
                                        </option>
                                    @endforeach

                                </select>
                                <span id="error_edit_basecamp_serpo" class="text-danger"></span>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-label">Jenis Material</label>
                                <select class="form-control edit_jenis_material" name="edit_jenis_material"
                                    id="edit_jenis_material" data-fouc>
                                    <option></option>
                                    @foreach ($material as $item)
                                        <option value="{{ $item->id }}"> {{ $item->jenis_material }}
                                        </option>
                                    @endforeach

                                </select>
                                <span id="error_edit_jenis_material" class="text-danger"></span>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Jumlah Material</label>
                                <input class="form-control" type="number" name="edit_jumlah_material"
                                    id="edit_jumlah_material">
                                <span id="error_kegiatan" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">

                            <div class="col-sm-6" id="view-blob">
                                <label class="form-label">Upload Gambar</label>
                                <input type="file" id="edit_gambar" name="edit_gambar" class="form-control"
                                    accept="image/*">
                                <span id="error_images" class="text-danger"></span>
                            </div>
                            <div class="col-sm-6">
                                <img class="card-img img-fluid" id="view_images"
                                    style="height: 150px; width: 600px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
        </div>
    </div>
</div>
