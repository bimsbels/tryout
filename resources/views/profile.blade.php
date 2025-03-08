@php
$ada_jawaban = false;
@endphp
@extends('layouts.user.app')

@section('title')
Profile
@endsection

@section('content')
<main id="main">
    <div class="container mb-4" style="margin-top: 124px">
        <div class="row" style="justify-content:center">
            @if (\Session::has('message'))
            <div class="col-lg-12">
                <div class="alert alert-danger">
                    {{ \Session::get('message') }}
                </div>
            </div>
            @endif
            <div class="col-lg-4 mb-3">
                <div class="card mb-3">
                    <div class="card-body d-flex row">
                        <div class="col-lg-3 col-md-2">
                            <img alt="image" width="75px" height="75px" id="infoPhoto" src="{{ $user->profile_photo_url }}" class="rounded-circle profile-widget-picture">
                        </div>
                        <div class="col-lg-9 col-md-10 align-self-center">
                            <span style="font-size: 20px" class="card-title" id="infoName">
                                <b>{{ $user->name }}</b>
                            </span>
                            <br>
                            <span style="font-size: 15px">
                                {{ $user->email }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">Data Pendaftar</h5>
                        <form id="formPendaftar" action="{{ route('profile.pendaftar') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="form-group required mb-2">
                                <label for="Prodi" class="col-form-label">Program Studi</label>
                                <select id="prodi" class="form-control select2" required name="prodi">
                                    <option value="" selected="selected">-- Cari Program Studi --</option>
                                    <option @if($user->usersDetail) {{ $user->usersDetail->prodi == 2 ? 'selected' : '' }} @endif value="2">D4 - Statistika</option>
                                    <option @if($user->usersDetail) {{ $user->usersDetail->prodi == 3 ? 'selected' : '' }} @endif value="3">D4 - Komputasi Statistik</option>
                                    <option @if($user->usersDetail) {{ $user->usersDetail->prodi == 1 ? 'selected' : '' }} @endif value="1">D3 - Statistika</option>
                                </select>
                                <div class="invalid-feedback">
                                    Kolom kabupaten/kota tidak boleh kosong.
                                </div>
                            </div>
                            <div class="form-group required mb-2">
                                <label for="Formasi" class="col-form-label">Formasi</label>
                                <select id="formasi" class="form-control select2" required name="formasi">
                                    <option value="" selected="selected">-- Cari formasi --</option>
                                </select>
                                <div class="invalid-feedback">
                                    Kolom formasi tidak boleh kosong.
                                </div>
                            </div>
                            <button type="submit" id="submitPendaftar" class="btn btn-primary mt-4 mb-0 float-end">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Data Akun</h5>
                        <form id="formAccount" action="{{ route('profile.account') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group required mb-2">
                                <label for="Name" class="col-form-label">Nama Lengkap</label>
                                <input type="text" value="{{ $user->name }}" name="name" id="Name" class="form-control" placeholder="Nama" required>
                                <div class="invalid-feedback">
                                    Kolom nama tidak boleh kosong.
                                </div>
                            </div>
                            <div class="form-group required mb-2">
                                <label for="Email" class="col-form-label">Email</label>
                                <input type="text" value="{{ $user->email }}" readonly name="email" id="Email" class="form-control" placeholder="Email" required>
                                <div class="invalid-feedback">
                                    Kolom email tidak boleh kosong.
                                </div>
                            </div>
                            <div class="form-group required mb-2">
                                <label for="No_hp" class="col-form-label">No HP</label>
                                <input type="text" value="{{ $user->usersDetail ? $user->usersDetail->no_hp : '' }}" name="no_hp" id="No_hp" class="form-control" placeholder="No Handphone" required>
                                <div class="invalid-feedback">
                                    Kolom No HP tidak boleh kosong.
                                </div>
                            </div>
                            <div class="form-group required mb-2">
                                <label for="sumber" class="col-form-label">Sumber Mendapatkan Tryout</label>
                                <select class="form-control sumber" id="Sumber" name="sumber[]" multiple="multiple" data-placeholder="--Pilih Sumber Informasi Mendapatkan Tryout--" style="width: 100%;">
                                    <option value="Instagram">Instagram</option>
                                    <option value="WhatsApp">WhatsApp</option>
                                    <option value="Email">Email</option>
                                    <option value="Internet">Internet</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <div class="invalid-feedback">
                                    Kolom sumber informasi tidak boleh kosong.
                                </div>
                            </div>
                            <div class="form-group required mb-2">
                                <label for="sumber" class="col-form-label">Foto Profil</label>
                                <input type="file" name="image" placeholder="Pilih Foto Profil" class="form-control" id="image">
                                <span style="color: red; font-size: 12px">*Upload foto berukuran maksimal 2MB</span>
                                <div class="invalid-feedback">
                                    Kolom foto profil tidak boleh kosong.
                                </div>
                            </div>
                            <button type="submit" id="submitAccount" class="btn btn-primary mt-4 mb-0 float-end">Simpan</button>
                        </form>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Data Peserta</h5>
                        <form id="formPeserta" action="{{ route('profile.peserta') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="form-group required mb-2">
                                <label for="Provinsi" class="col-form-label">Provinsi</label>
                                <select id="provinsi" class="form-control select2" required name="provinsi">
                                    <option value="" selected="selected">-- Cari provinsi --</option>
                                </select>
                                <div class="invalid-feedback">
                                    Kolom provinsi tidak boleh kosong.
                                </div>
                            </div>
                            <div class="form-group required mb-2">
                                <label for="Kabupaten" class="col-form-label">Kabupaten/Kota</label>
                                <select id="kabupaten" class="form-control select2" required name="kabupaten">
                                    <option value="" selected="selected">-- Cari kabupaten/kota --</option>
                                </select>
                                <div class="invalid-feedback">
                                    Kolom kabupaten/kota tidak boleh kosong.
                                </div>
                            </div>
                            <div class="form-group required mb-2">
                                <label for="Kecamatan" class="col-form-label">Kecamatan</label>
                                <select id="kecamatan" class="form-control select2" required name="kecamatan">
                                    <option value="" selected="selected">-- Cari Kecamatan --</option>
                                </select>
                                <div class="invalid-feedback">
                                    Kolom kecamatan tidak boleh kosong.
                                </div>
                            </div>
                            <div class="form-group required mb-2">
                                <label for="Asal_sekolah" class="col-form-label">Asal Sekolah</label>
                                <input type="text" value="{{ $user->usersDetail ? $user->usersDetail->asal_sekolah : '' }}" name="asal_sekolah" id="Asal_sekolah" class="form-control" placeholder="Asal Sekolah" required>
                                <div class="invalid-feedback">
                                    Kolom asal sekolah tidak boleh kosong.
                                </div>
                            </div>
                            <div class="form-group required mb-2">
                                <label for="Instagram" class="col-form-label">Instagram</label>
                                <input type="text" value="{{ $user->usersDetail ? $user->usersDetail->instagram : '' }}" name="instagram" id="Instagram" class="form-control" placeholder="Instagram" required>
                                <div class="invalid-feedback">
                                    Kolom instagram tidak boleh kosong.
                                </div>
                            </div>
                            <button type="submit" id="submitPeserta" class="btn btn-primary mt-4 mb-0 float-end">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    $(function(){

        $('#Sumber').select2({
            theme: 'bootstrap4',
        });

        $('#formasi').select2({
            theme: 'bootstrap4',
        });

        $('#prodi').select2({
            theme: 'bootstrap4',
        });

        @if ($user->usersDetail != NULL)
            let selectedSumber = @json($user->usersDetail->sumber_informasi);
            $('#Sumber').val(selectedSumber).change();
        @endif

        $('#formAccount').on('submit', function(e) {
            if (! e.preventDefault()) {
                let idPembelian = '{{ \Session::get('id_pembelian') }}'
                let submitAccount = $('#submitAccount').html();

                $('#submitAccount').html('Loading <div class="spinner-border spinner-border-sm" role="status"></div>');
                $('#submitAccount').attr('type', 'button');
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('profile.account') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('#submitAccount').html(submitAccount);
                        $('#submitAccount').attr('type', 'submit');
                        if ($.isEmptyObject(response.error)) {
                            $('#infoName').html('<b>' + response.data.name + '</b>');
                            $("#infoPhoto").attr("src", response.data.profile_photo_url);
                            toastr.options = {"positionClass": "toast-bottom-right"};
                            toastr.success(response.message);
                            if (response.check == true && idPembelian != '') {
                                window.location.href = '/pembelian/' + idPembelian;
                            }
                        } else {
                            $.each(response.error, function (key, val) {
                                toastr.options = {"positionClass": "toast-bottom-right"};
                                toastr.error(val);
                            });
                        }
                    },
                })
            }
        });

        @if ($user->usersDetail != NULL)
        @if ($user->usersDetail->provinsi != NULL && $user->usersDetail->kabupaten != NULL && $user->usersDetail->kecamatan != NULL)

        // Ambil data provinsi
        $.ajax({
            type: 'GET',
            url: 'https://wilayah.id/api/provinces.json',
            dataType: 'json'
        }).then(function (res) {
            const provinsi = res.data.find(item => item.code === '{{ $user->usersDetail->provinsi }}');
            if (provinsi) {
                $('#provinsi').append(`<option value="${provinsi.code}" selected="selected">${provinsi.name}</option>`);
            }
        });

        // Ambil data kabupaten/kota
        $.ajax({
            type: 'GET',
            url: 'https://wilayah.id/api/regencies/{{ $user->usersDetail->provinsi }}.json',
            dataType: 'json'
        }).then(function (res) {
            const kabupaten = res.data.find(item => item.code === '{{ $user->usersDetail->kabupaten }}');
            if (kabupaten) {
                $('#kabupaten').append(`<option value="${kabupaten.code}" selected="selected">${kabupaten.name}</option>`);
            }
        });

        // Ambil data kecamatan
        $.ajax({
            type: 'GET',
            url: 'https://wilayah.id/api/districts/{{ $user->usersDetail->kabupaten }}.json',
            dataType: 'json'
        }).then(function (res) {
            const kecamatan = res.data.find(item => item.code === '{{ $user->usersDetail->kecamatan }}');
            if (kecamatan) {
                $('#kecamatan').append(`<option value="${kecamatan.code}" selected="selected">${kecamatan.name}</option>`);
            }
        });

        @endif
        @if ($user->usersDetail->penempatan != NULL)
        // Ambil data provinsi untuk penempatan
        $.ajax({
            type: 'GET',
            url: 'https://wilayah.id/api/provinces.json',
            dataType: 'json'
        }).then(function (res) {
            const penempatan = res.data.find(item => item.code === '{{ $user->usersDetail->penempatan }}');
            if (penempatan) {
                $('#formasi').append(`<option value="${penempatan.code}" selected="selected">${penempatan.name}</option>`);
            }
        });
        @endif
        @endif

        // PROVINSI
        $('#provinsi').select2({
            theme: 'bootstrap4',
            minimumInputLength: 3,
            placeholder: 'Pilih Provinsi',
            ajax: {
                url: 'https://wilayah.id/api/provinces.json',
                type: "GET",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (response, params) {
                    if (!response || !response.data) {
                        return { results: [] };
                    }

                    let searchTerm = (params.term || "").toLowerCase();

                    let filtered = response.data.filter(item => item.name.toLowerCase().includes(searchTerm));

                    let results = filtered.map(item => ({
                        id: item.code,
                        text: item.name
                    }));

                    return { results: results };
                },
                cache: true,
                error: function (xhr, status, error) {
                    console.error("Gagal memuat data provinsi:", error);
                }
            }
        });

        // KABUPATEN/KOTA
        $('#kabupaten').select2({
            theme: 'bootstrap4',
            minimumInputLength: 1,
            placeholder: 'Pilih Kabupaten/Kota',
            ajax: {
                url: function () {
                    let provCode = $('#provinsi').val();
                    if (!provCode) {
                        return null;
                    }
                    return `https://wilayah.id/api/regencies/${provCode}.json`;
                },
                type: "GET",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (response, params) {
                    if (!response || !response.data) {
                        return { results: [] };
                    }

                    let searchTerm = (params.term || "").toLowerCase();

                    let filtered = response.data.filter(item => item.name.toLowerCase().includes(searchTerm));

                    let results = filtered.map(item => ({
                        id: item.code,
                        text: item.name
                    }));

                    return { results: results };
                },
                cache: true,
                error: function (xhr, status, error) {
                    console.error("Gagal memuat data kabupaten/kota:", error);
                }
            }
        });

        // KECAMATAN
        $('#kecamatan').select2({
            theme: 'bootstrap4',
            minimumInputLength: 1,
            placeholder: 'Pilih Kecamatan',
            ajax: {
                url: function () {
                    let regencyCode = $('#kabupaten').val();
                    if (!regencyCode) {
                        return null;
                    }
                    return `https://wilayah.id/api/districts/${regencyCode}.json`;
                },
                type: "GET",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (response, params) {
                    if (!response || !response.data) {
                        return { results: [] };
                    }

                    let searchTerm = (params.term || "").toLowerCase();

                    let filtered = response.data.filter(item => item.name.toLowerCase().includes(searchTerm));

                    let results = filtered.map(item => ({
                        id: item.code,
                        text: item.name
                    }));

                    return { results: results };
                },
                cache: true,
                error: function (xhr, status, error) {
                    console.error("Gagal memuat data kecamatan:", error);
                }
            }
        });

        // Reset kabupaten dan kecamatan saat provinsi berubah
        $('#provinsi').on('change', function () {
            $('#kabupaten').val(null).trigger('change');
            $('#kecamatan').val(null).trigger('change');
        });

        // Reset kecamatan saat kabupaten berubah
        $('#kabupaten').on('change', function () {
            $('#kecamatan').val(null).trigger('change');
        });

        $('#formPeserta').on('submit', function(e) {
            if (! e.preventDefault()) {
                let idPembelian = '{{ \Session::get('id_pembelian') }}'
                let submitPeserta = $('#submitPeserta').html();

                $('#submitPeserta').html('Loading <div class="spinner-border spinner-border-sm" role="status"></div>');
                $('#submitPeserta').attr('type', 'button');
                $.post($('#formPeserta').attr('action'), $('#formPeserta').serialize())
                .done((response) => {
                    $('#submitPeserta').html(submitPeserta);
                    $('#submitPeserta').attr('type', 'submit');
                    toastr.options = {"positionClass": "toast-bottom-right"};
                    toastr.success(response.message);
                    if (response.check == true && idPembelian != '') {
                        window.location.href = '/pembelian/' + idPembelian;
                    }
                })
                .fail((errors) => {
                    toastr.options = {"positionClass": "toast-bottom-right"};
                    toastr.error(errors);
                    return;
                });
                }
            }
        );

        $('#formPendaftar').on('submit', function(e) {
            if (! e.preventDefault()) {
                let submitPendaftar = $('#submitPendaftar').html();
                let idPembelian = '{{ \Session::get('id_pembelian') }}'

                $('#submitPendaftar').html('Loading <div class="spinner-border spinner-border-sm" role="status"></div>');
                $('#submitPendaftar').attr('type', 'button');
                $.post($('#formPendaftar').attr('action'), $('#formPendaftar').serialize())
                .done((response) => {
                    $('#submitPendaftar').html(submitPendaftar);
                    $('#submitPendaftar').attr('type', 'submit');
                    toastr.options = {"positionClass": "toast-bottom-right"};
                    toastr.success(response.message);

                    if (response.check == true && idPembelian != '') {
                        window.location.href = '/pembelian/' + idPembelian;
                    }
                })
                .fail((errors) => {
                    toastr.options = {"positionClass": "toast-bottom-right"};
                    toastr.error(errors);
                    return;
                });
                }
            }
        );
    });
</script>
@endpush
