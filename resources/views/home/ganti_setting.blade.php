@extends('layout.main')

@section('title', 'Profil')

@section('breadcrums')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Profil</h1>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
@endsection

@section('content')
    @php
        $setting = DB::table('tbl_setting')->where('id', 1)->first();
        $foto = $setting->foto == null ? asset('img/profil/kosong.jpg') : asset('storage/setting/' . $setting->foto);
    @endphp

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('ganti_setting/resetsetting') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="ml-auto">
                                    <a href="{{ url('invoice/index') }}" class="btn btn-default">
                                        <i class="fas fa-reply"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="profile-image-container mb-3">
                                        <img src="{{ $foto }}" id="profile-preview" class="img-thumbnail"
                                            style="width: 200px; height: 200px; object-fit: cover;">
                                        <div class="mt-2 d-flex justify-content-center align-items-center gap-5">
                                            <label for="foto" class="mb-0 btn btn-sm btn-primary">
                                                <i class="fas fa-camera"></i> Ganti Foto
                                            </label>
                                            <input type="file" name="foto" id="foto" accept="image/*"
                                                style="display: none;" onchange="previewImage(this)">
                                            @if ($setting->foto)
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="confirmDeleteFoto()">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>NAMA SEKOLAH</label>
                                    <input type="text" class="form-control" name="namasekolah"
                                        value="{{ $setting->namasekolah }}" required>
                                </div>
                                <div class="form-group">
                                    <label>ALAMAT</label>
                                    <textarea class="form-control" name="alamat" rows="3" required>{{ $setting->alamat }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>AKREDITASI</label>
                                    <input type="text" class="form-control" name="akreditasi"
                                        value="{{ $setting->akreditasi }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Profil
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Preview image before upload
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Confirm delete foto
        function confirmDeleteFoto() {
            Swal.fire({
                title: 'Hapus Foto Profil?',
                text: "Anda yakin ingin menghapus foto profil?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('ganti_setting/delete-foto') }}";
                }
            });
        }

        // Notification
        function edit_sukses() {
            Swal.fire({
                icon: 'success',
                title: 'Edit Data Berhasil',
                showConfirmButton: false,
                timer: 1500
            });
        }

        @if (session('edit_sukses'))
            edit_sukses();
        @endif
    </script>
@endsection
