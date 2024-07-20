@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <a href='#' class="btn btn-light add_incident" data-toggle="modal" data-target="#modal_incident"><i
                            class="ph-plus-circle me-2"></i>Tambah Incident</a>
                </div>
                <table class="table datatable-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Incident</th>
                            <th>Tanggal</th>
                            <th>Material</th>
                            <th>Basecamp</th>
                            <th>Perusahaan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- /basic responsive configuration -->
    </div>
    @include('incident.modals.create')
    @include('incident.modals.view')
    @include('incident.modals.edit')
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/media/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickers/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/incident/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
