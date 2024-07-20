<div id="modal_view_laporan" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <input type="hidden" id="id_kegiatan">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Tanggal Incident</td>
                                            <td>:</td>
                                            <td id="view_tanggal_incident"></td>
                                        </tr>

                                        <tr>
                                            <td>No. Incident</td>
                                            <td>:</td>
                                            <td id="view_no_incident"></td>
                                        </tr>

                                        <tr>
                                            <td>Nama Incident</td>
                                            <td>:</td>
                                            <td id="view_nama_incident"></td>
                                        </tr>
                                        <tr>
                                            <td>Lokasi Incident</td>
                                            <td>:</td>
                                            <td id="view_lokasi_incident"></td>
                                        </tr>
                                        <tr>
                                            <td>Basecamp</td>
                                            <td>:</td>
                                            <td id="view_basecamp"></td>
                                        </tr>
                                        <tr>
                                            <td>Mitra</td>
                                            <td>:</td>
                                            <td id="view_mitra"></td>
                                        </tr>

                                        <tr>
                                            <td>Jenis Material</td>
                                            <td>:</td>
                                            <td id="view_jenis_material"></td>
                                        </tr>

                                        <tr>
                                            <td>Jumlah Material</td>
                                            <td>:</td>
                                            <td id="view_jumlah_material"></td>
                                        </tr>

                                        <tr>
                                            <td>Total Harga</td>
                                            <td>:</td>
                                            <td id="view_total_harga"></td>
                                        </tr>

                                        <tr>
                                            <td>Tanggal Input Data</td>
                                            <td>:</td>
                                            <td id="view_tanggal_input_data"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-img-actions mx-1 mt-1">
                                <img class="card-img img-fluid" id="gambar_foto" src="" alt="">
                                <div class="card-img-actions-overlay card-img">
                                    <a href="" id="gambar_link"
                                        class="btn btn-outline-white btn-icon rounded-pill" data-bs-popup=""
                                        data-gallery="">
                                        <i class="ph-plus"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex align-items-start flex-nowrap">
                                    <div>
                                        <div class="fw-semibold me-2" id="judul">Foto Material</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
