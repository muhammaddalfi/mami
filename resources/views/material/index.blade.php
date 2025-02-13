@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">
            <div class="card-body">
                <a href='#' class="btn btn-light add_material" data-toggle="modal" data-target="#modal_material"><i
                        class="ph-plus-circle me-2"></i>Tambah Material Serpo</a>
            </div>
            <table class="table datatable-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Material</th>
                        <th>Harga Material</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <!-- /basic responsive configuration -->
    </div>
    @include('material.modals.create')
    @include('material.modals.edit')
@endsection
@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/material/index.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
