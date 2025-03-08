@extends('layouts/admin/app')

@section('title')
Data User
@endsection

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">User</li>
@endsection

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm('{{ route('user.store') }}')" class="btn btn-outline-success"><i class="fa fa-plus-circle"></i> Tambah</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="" method="post" class="form-member">
                        @csrf
                        <table class="table table-bordered table-striped center-header" id="Table-User">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th style="width: 15%"><i class="fa fa-cog"></i></th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                    <!-- /.row -->
                </div>
                <!-- ./card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->

    <!-- /.row -->
</div>

@includeIf('admin.user.form')
@includeIf('admin.user.reset')
@includeIf('admin.user.detail')

@endsection

@push('scripts')
<script>
    let tableUser;
    $(function() {
        tableUser = $('#Table-User').DataTable({
            processing: true
            , serverside: true
            , responsive: true
            , autoWidth: false
            , ajax: {
                url: '{{ route('user.data') }}'
            , }
            , columns: [{
                    data: 'DT_RowIndex'
                    , searchable: false
                    , sortable: false
                }
                , {
                    data: 'name'
                }
                , {
                    data: 'email'
                }
                , {
                    data: 'no_hp'
                }
                , {
                    data: 'aksi'
                    , searchable: false
                    , sortable: false
                }
            , ]
            , dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip'
            , buttons: ['<a href="{{ route('user.export') }}" class="btn btn-outline-warning"><i class="fa fa-file-export"></i> Export</a>']
            , columnDefs: [
                { className: 'text-center', targets: [0, 3, 4] },
            ]
        });

        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
        })

        $('#modal-form form').on('submit', function(e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                .done((response) => {
                    $('#modal-form').modal('hide');
                    tableUser.ajax.reload();
                    toastr.options = {"positionClass": "toast-bottom-right"};
                    toastr.success('Data berhasil disimpan.');
                })
                .fail((errors) => {
                    // toastr.error('Tidak dapat menyimpan data.');
                    return;
                });
                }
            }
        )

        $('#modal-reset form').on('submit', function(e) {
            if (! e.preventDefault()) {
                $.post($('#modal-reset form').attr('action'), $('#modal-reset form').serialize())
                .done((response) => {
                    $('#modal-reset').modal('hide');
                    toastr.options = {"positionClass": "toast-bottom-right"};
                    toastr.success('Data berhasil disimpan.');
                })
                .fail((errors) => {
                    // toastr.error('Tidak dapat menyimpan data.');
                    return;
                });
                }
            }
        )
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah User');

        $('#modal-form form')[0].classList.remove('was-validated');
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=name]').focus();
    }

    function deleteData(url) {
        Swal.fire({
            title: 'Apakah kamu yakin akan menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
            }).then((result) => {
            if (result.isConfirmed) {
                $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    tableUser.ajax.reload();
                    toastr.options = {"positionClass": "toast-bottom-right"};
                    toastr.success('Data berhasil dihapus.');
                })
                .fail((response) => {
                    toastr.error('Tidak dapat menghapus data.');
                    return;
                })
            }
        })
    }

    function generatePass(name) {
        // change 12 to the length you want the hash
        var pass = '';
        var str='ABCDEFGHIJKLMNOPQRSTUVWXYZ'
        +  'abcdefghijklmnopqrstuvwxyz0123456789@#$';

        for (let i = 1; i <= 8; i++) {
            var char = Math.floor(Math.random()* str.length + 1);
            pass += str.charAt(char)
        }
        if (name === 'reset') {
            $('#PasswordReset').val(pass);
        } else if (name === 'new') {
            $('#Password').val(pass);
        }
    }

    function makeAdmin(url) {
        let action = url.split('/')[6];
        let title = (action === 'make' ? 'Apakah anda yakin akan mengubah user menjadi admin?' : 'Apakah anda yakin akan merevoke hak akses admin?');
        let success = action === 'make' ? 'User berhasil menjadi admin' : 'Hak akses admin user direvoke';
        Swal.fire({
            title: title,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
            }).then((result) => {
            if (result.isConfirmed) {
                $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'post'
                })
                .done((response) => {
                    tableUser.ajax.reload();
                    toastr.options = {"positionClass": "toast-bottom-right"};
                    toastr.success(success);
                })
                .fail((response) => {
                    toastr.error('Proses gagal.');
                    return;
                })
            }
        })
    }

    // Fungsi untuk mengambil data kecamatan berdasarkan kode kabupaten/kota
    async function getDistrict(regencyCode) {
        try {
            const response = await $.ajax({
                url: `https://wilayah.id/api/districts/${regencyCode}.json`,
                type: 'GET',
                dataType: 'json'
            });
            return response.data || [];
        } catch (error) {
            console.error('Error fetching district:', error);
            return [];
        }
    }

    // Fungsi untuk mengambil data kabupaten/kota berdasarkan kode provinsi
    async function getRegency(provinceCode) {
        try {
            const response = await $.ajax({
                url: `https://wilayah.id/api/regencies/${provinceCode}.json`,
                type: 'GET',
                dataType: 'json'
            });
            return response.data || [];
        } catch (error) {
            console.error('Error fetching regency:', error);
            return [];
        }
    }

    // Fungsi untuk mengambil data provinsi
    async function getProvince() {
        try {
            const response = await $.ajax({
                url: 'https://wilayah.id/api/provinces.json',
                type: 'GET',
                dataType: 'json'
            });
            return response.data || [];
        } catch (error) {
            console.error('Error fetching province:', error);
            return [];
        }
    }

    // Fungsi untuk mendapatkan nama provinsi berdasarkan kode
    async function getProvinceName(provinceCode) {
        const provinces = await getProvince();
        const province = provinces.find(prov => prov.code === provinceCode);
        return province ? province.name : 'Tidak ditemukan';
    }

    // Fungsi untuk menampilkan detail data dalam modal
    function detailForm(url) {
        $.get(url)
            .done(async (response) => {
                $('#modal-detail').modal('show');
                $('#modal-detail .modal-title').text(response.name || 'Detail');
                $('#modal-detail [id=idPeserta]').text(response.id || '-');
                $('#modal-detail [id=fotoProfile]').html(
                    `<img id="fotoPeserta" src="${response.profile_photo_url || '#'}" alt="Foto Profil" width="100px">`
                );
                $('#modal-detail [id=nama]').text(response.name || '-');
                $('#modal-detail [id=email]').text(response.email || '-');

                if (response.users_detail) {
                    const userDetail = response.users_detail;
                    $('#modal-detail [id=noHP]').text(userDetail.no_hp || '-');
                    $('#modal-detail [id=asalSekolah]').text(userDetail.asal_sekolah || '-');
                    $('#modal-detail [id=instagram]').text(userDetail.instagram || '-');
                    $('#modal-detail [id=sumber]').text(userDetail.sumber_informasi || '-');

                    // Menggabungkan alamat lengkap
                    let alamat = '';

                    if (userDetail.kecamatan && userDetail.kabupaten && userDetail.provinsi) {
                        try {
                            const districts = await getDistrict(userDetail.kabupaten);
                            const district = districts.find(d => d.code === userDetail.kecamatan);
                            alamat += district ? district.name + ', ' : '';
                        } catch (error) {
                            console.error('Error fetching district:', error);
                        }

                        try {
                            const regencies = await getRegency(userDetail.provinsi);
                            const regency = regencies.find(r => r.code === userDetail.kabupaten);
                            alamat += regency ? regency.name + ', ' : '';
                        } catch (error) {
                            console.error('Error fetching regency:', error);
                        }

                        try {
                            const provinceName = await getProvinceName(userDetail.provinsi);
                            alamat += provinceName || 'Tidak ditemukan';
                        } catch (error) {
                            console.error('Error fetching province:', error);
                        }
                    } else {
                        alamat = 'Alamat tidak lengkap';
                    }

                    $('#modal-detail [id=alamat]').text(alamat);

                    // Mengambil penempatan (asumsi penempatan menggunakan kode provinsi)
                    try {
                        const penempatan = await getProvinceName(userDetail.penempatan);
                        $('#modal-detail [id=penempatan]').text(penempatan || '-');
                    } catch (error) {
                        console.error('Error fetching placement:', error);
                        $('#modal-detail [id=penempatan]').text('Tidak ditemukan');
                    }
                }

                // Menampilkan sesi login
                let textSession = '';
                if (Array.isArray(response.sessions) && response.sessions.length > 0) {
                    response.sessions.forEach(session => {
                        textSession += `<span class='badge bg-primary'>${session.ip_address} (${session.last_activity})</span><br>`;
                    });
                } else {
                    textSession = 'Tidak ada sesi login.';
                }
                $('#modal-detail [id=login]').html(textSession);
            })
            .fail((error) => {
                console.error('Error fetching user details:', error);
                alert('Tidak dapat menampilkan data.');
            });
    }

    function resetPassword(url) {
        $('#modal-reset').modal('show');
        $('#modal-reset .modal-title').text('Reset Password');

        $('#modal-reset form')[0].classList.remove('was-validated');
        $('#modal-reset form')[0].reset();
        $('#modal-reset form').attr('action', url);
        $('#modal-reset [name=_method]').val('post');
        $('#modal-reset [name=name]').focus();
    }

</script>
@endpush
