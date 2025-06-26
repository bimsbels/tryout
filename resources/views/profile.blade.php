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
                                <img alt="image" width="75px" height="75px" id="infoPhoto"
                                     src="{{ $user->profile_photo_url }}" class="rounded-circle profile-widget-picture">
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
                                    </select>
                                    <div class="invalid-feedback">
                                        Kolom program tidak boleh kosong.
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
                                <button type="submit" id="submitPendaftar" class="btn btn-primary mt-4 mb-0 float-end">
                                    Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Data Akun</h5>
                            <form id="formAccount" action="{{ route('profile.account') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form-group required mb-2">
                                    <label for="Name" class="col-form-label">Nama Lengkap</label>
                                    <input type="text" value="{{ $user->name }}" name="name" id="Name"
                                           class="form-control" placeholder="Nama" required>
                                    <div class="invalid-feedback">
                                        Kolom nama tidak boleh kosong.
                                    </div>
                                </div>
                                <div class="form-group required mb-2">
                                    <label for="Email" class="col-form-label">Email</label>
                                    <input type="text" value="{{ $user->email }}" readonly name="email" id="Email"
                                           class="form-control" placeholder="Email" required>
                                    <div class="invalid-feedback">
                                        Kolom email tidak boleh kosong.
                                    </div>
                                </div>
                                <div class="form-group required mb-2">
                                    <label for="No_hp" class="col-form-label">No HP</label>
                                    <input type="text" value="{{ $user->usersDetail ? $user->usersDetail->no_hp : '' }}"
                                           name="no_hp" id="No_hp" class="form-control" placeholder="No Handphone"
                                           required>
                                    <div class="invalid-feedback">
                                        Kolom No HP tidak boleh kosong.
                                    </div>
                                </div>
                                <div class="form-group required mb-2">
                                    <label for="sumber" class="col-form-label">Sumber Mendapatkan Tryout</label>
                                    <select class="form-control sumber" id="Sumber" name="sumber[]" multiple="multiple"
                                            data-placeholder="--Pilih Sumber Informasi Mendapatkan Tryout--"
                                            style="width: 100%;">
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
                                    <label for="Image" class="col-form-label">Foto Profil</label>
                                    <input type="file" name="image" placeholder="Pilih Foto Profil" class="form-control"
                                           id="image">
                                    <span style="color: red; font-size: 12px">*Upload foto berukuran maksimal 1MB</span>
                                    <div class="invalid-feedback">
                                        Kolom foto profil tidak boleh kosong.
                                    </div>
                                </div>
                                <button type="submit" id="submitAccount" class="btn btn-primary mt-4 mb-0 float-end">
                                    Simpan
                                </button>
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
                                    <input type="text"
                                           value="{{ $user->usersDetail ? $user->usersDetail->asal_sekolah : '' }}"
                                           name="asal_sekolah" id="Asal_sekolah" class="form-control"
                                           placeholder="Asal Sekolah" required>
                                    <div class="invalid-feedback">
                                        Kolom asal sekolah tidak boleh kosong.
                                    </div>
                                </div>
                                <div class="form-group required mb-2">
                                    <label for="Instagram" class="col-form-label">Instagram</label>
                                    <input type="text"
                                           value="{{ $user->usersDetail ? $user->usersDetail->instagram : '' }}"
                                           name="instagram" id="Instagram" class="form-control" placeholder="Instagram"
                                           required>
                                    <div class="invalid-feedback">
                                        Kolom instagram tidak boleh kosong.
                                    </div>
                                </div>
                                <button type="submit" id="submitPeserta" class="btn btn-primary mt-4 mb-0 float-end">
                                    Simpan
                                </button>
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
        $(function () {
            const initSelect2 = (selector, options) => {
                $(selector).select2({
                    theme: 'bootstrap4',
                    ...options
                });
            };

            const loadData = (url, selector, key) => {
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'json'
                }).then(function (res) {
                    $(selector).append(new Option(res.nama, res[key], true, true)).trigger('change');
                });
            };

            const handleFormSubmit = (formId, submitButtonId, successCallback) => {
                $(formId).on('submit', function (e) {
                    e.preventDefault();
                    let submitButton = $(submitButtonId);
                    let originalHtml = submitButton.html();
                    let idPembelian = '{{ \Session::get('id_pembelian') }}';

                    submitButton.html('Loading <div class="spinner-border spinner-border-sm" role="status"></div>');
                    submitButton.attr('type', 'button');

                    // Create FormData object for file uploads
                    let formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        contentType: false, // Required for file uploads
                        processData: false, // Required for file uploads
                        success: function (response) {
                            submitButton.html(originalHtml);
                            submitButton.attr('type', 'submit');
                            toastr.options = {"positionClass": "toast-bottom-right"};
                            if ($.isEmptyObject(response.error)) {
                                toastr.success(response.message);
                                if (successCallback) successCallback(response);
                                if (response.check && idPembelian) {
                                    window.location.href = '/pembelian/' + idPembelian;
                                }
                            } else {
                                $.each(response.error, function (key, val) {
                                    toastr.error(val);
                                });
                            }
                        },
                        error: function (errors) {
                            submitButton.html(originalHtml);
                            submitButton.attr('type', 'submit');
                            toastr.options = {"positionClass": "toast-bottom-right"};
                            toastr.error(errors.responseJSON.message);
                        }
                    });
                });
            };

            initSelect2('#Sumber', {});

            @if ($user->usersDetail != NULL && $user->usersDetail->prodi != NULL)
            loadData('/api/prodi/{{ $user->usersDetail->prodi }}', '#prodi', 'kode');
            @endif

            initSelect2('#prodi', {
                ajax: {
                    url: '/api/prodi',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {search: params.term};
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(item => ({id: item.kode, text: item.nama}))
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
            });

            // Add event listener for prodi change
            $('#prodi').on('change', function () {
                // Clear any previously selected formasi
                $('#formasi').val(null).trigger('change');

                // Reset the formasi select2 with updated parameters
                updateFormasiSelect2();
            });

            @if ($user->usersDetail != NULL && $user->usersDetail->penempatan != NULL)
            loadData('/api/formasi/{{ $user->usersDetail->penempatan }}', '#formasi', 'kode');
            @endif

            // Function to initialize or update the formasi Select2
            function updateFormasiSelect2() {
                var prodiCode = $('#prodi').val();

                initSelect2('#formasi', {
                    ajax: {
                        url: '/api/formasi',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                prodiCode: prodiCode // Pass the selected prodi code to the API
                            };
                        },
                        processResults: function (data) {
                            // Filter data based on prodi selection
                            var filteredData = data;

                            // If prodi code is not 1, 2, or 3, only show formasi with code "00"
                            if (prodiCode && !['1', '2', '3'].includes(prodiCode)) {
                                filteredData = data.filter(function (item) {
                                    return item.kode.toString() === '00';
                                });

                                // If there's only one result and it's "00", auto-select it
                                if (filteredData.length === 1 && filteredData[0].kode.toString() === '00') {
                                    setTimeout(function () {
                                        $('#formasi').val('00').trigger('change');
                                    }, 100);
                                }
                            }
                            // If prodi code is 1, exclude formasi with code "00"
                            else if (prodiCode === '1') {
                                filteredData = data.filter(function (item) {
                                    return item.kode.toString() !== '00';
                                });
                            }

                            return {
                                results: filteredData.map(function (item) {
                                    return {id: item.kode.toString(), text: item.nama};
                                })
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0,
                });
            }

            // Initialize formasi Select2 when the page loads
            updateFormasiSelect2();

            @if ($user->usersDetail != NULL)
            $('#Sumber').val(@json($user->usersDetail->sumber_informasi)).change();
            @endif

            handleFormSubmit('#formAccount', '#submitAccount', function (response) {
                $('#infoName').html('<b>' + response.data.name + '</b>');
                $("#infoPhoto").attr("src", response.data.profile_photo_url);
            });

            @if ($user->usersDetail != NULL)
            @if ($user->usersDetail->provinsi != NULL)
            loadData('/api/province/{{ $user->usersDetail->provinsi }}', '#provinsi', 'kode');
            @endif
            @if ($user->usersDetail->kabupaten != NULL)
            loadData('/api/regency/{{ $user->usersDetail->kabupaten }}', '#kabupaten', 'kode');
            @endif
            @if ($user->usersDetail->kecamatan != NULL)
            loadData('/api/district/{{ $user->usersDetail->kecamatan }}', '#kecamatan', 'kode');
            @endif
            @endif

            // Location selectors setup
            const setupLocationSelectors = () => {
                // Initialize province select2 - using original implementation but optimized
                initSelect2('#provinsi', {
                    minimumInputLength: 3, // Keep original value
                    ajax: {
                        url: '/api/search',
                        type: 'GET',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return { term: params.term };
                        },
                        processResults: function(response) {
                            let results = [];
                            if (Array.isArray(response)) {
                                results = response
                                    .map(item => ({
                                        id: item.kode,
                                        text: item.nama
                                    }))
                                    // Filter only provinces (2 character code without dots)
                                    .filter(item => item.id && item.id.toString().indexOf('.') === -1);
                            }
                            return { results };
                        },
                        cache: true
                    }
                });

                // Initialize kabupaten select2 - using original implementation but optimized
                initSelect2('#kabupaten', {
                    minimumInputLength: 1,
                    ajax: {
                        url: '/api/search',
                        type: 'GET',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            const provCode = $('#provinsi').val();
                            return {
                                term: params.term,
                                provinsi: provCode
                            };
                        },
                        processResults: function(response) {
                            const provCode = $('#provinsi').val();
                            let results = [];
                            if (provCode && Array.isArray(response)) {
                                results = response
                                    .map(item => ({
                                        id: item.kode,
                                        text: item.nama
                                    }))
                                    // Filter regencies (codes with format xx.xx)
                                    .filter(item =>
                                        item.id &&
                                        item.id.startsWith(provCode) &&
                                        item.id.split('.').length === 2
                                    );
                            }
                            return { results };
                        },
                        cache: true
                    }
                });

                // Initialize kecamatan select2 - using original implementation but optimized
                initSelect2('#kecamatan', {
                    minimumInputLength: 1,
                    ajax: {
                        url: '/api/search',
                        type: 'GET',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            const kabCode = $('#kabupaten').val();
                            return {
                                term: params.term,
                                kabupaten: kabCode
                            };
                        },
                        processResults: function(response) {
                            const kabCode = $('#kabupaten').val();
                            let results = [];
                            if (kabCode && Array.isArray(response)) {
                                results = response
                                    .map(item => ({
                                        id: item.kode,
                                        text: item.nama
                                    }))
                                    // Filter districts (codes with format xx.xx.xx)
                                    .filter(item =>
                                        item.id &&
                                        item.id.startsWith(kabCode) &&
                                        item.id.split('.').length === 3
                                    );
                            }
                            return { results };
                        },
                        cache: true
                    }
                });

                // Set up cascade reset events
                $('#provinsi').on("select2:selecting", function () {
                    $('#kabupaten').empty().append('<option value="" selected="selected">-- Cari kabupaten/kota --</option>').trigger('change');
                    $('#kecamatan').empty().append('<option value="" selected="selected">-- Cari kecamatan --</option>').trigger('change');
                });

                $('#kabupaten').on("select2:selecting", function () {
                    $('#kecamatan').empty().append('<option value="" selected="selected">-- Cari kecamatan --</option>').trigger('change');
                });
            };

            setupLocationSelectors();
            handleFormSubmit('#formPeserta', '#submitPeserta');
            handleFormSubmit('#formPendaftar', '#submitPendaftar');
        });
    </script>
@endpush
