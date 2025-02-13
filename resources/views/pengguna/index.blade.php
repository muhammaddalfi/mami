@extends('layouts.master')

@section('content')
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">
            @can('Add pengguna')
                <div class="card-body">

                    <a href='#' class="btn btn-light add_pengguna" data-toggle="modal" data-target="#modal_pengguna"><i
                            class="ph-plus-circle me-2"></i>Tambah Pengguna</a>
                </div>
            @endcan
            <table class="table datatable-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Handphone</th>
                        <th>Perusahaan</th>
                        <th>Role</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- /basic responsive configuration -->
    </div>
    @include('pengguna.modals.edit')
    @include('pengguna.modals.create')
    @include('permission.modals.enable')
@endsection

@push('js_page')
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notifications/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/pengguna/index.js') }}"></script>
    <script src="{{ asset('assets/js/auth/auth.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endpush
