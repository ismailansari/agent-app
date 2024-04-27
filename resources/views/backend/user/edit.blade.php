@extends('layouts.app')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#biodata" data-toggle="tab"><i class="far fa-id-card"></i>
                                User Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#login" data-toggle="tab"><i class="fas fa-key"></i> Login</a>
                        </li>
                    </ul>
                </h3>
                <div class="card-tools">
                </div>
            </div><!-- /.card-header -->

            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="chart tab-pane active" id="biodata">
                        <div class="row">
                            <div class="col col-12 col-lg-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           value="{{ old('name', $users->name) }}" required>
                                </div>
                            </div>
                            <div class="col col-12 col-lg-3">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           value="{{ old('phone', $users->phone) }}">
                                </div>
                            </div>
                            <div class="col col-12 col-lg-3">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <br>
                                    <input type="radio" name="gender" id="gender" value="male"
                                           @if ($users->gender == 'male') checked @endif> Male
                                    <input type="radio" name="gender" id="gender" value="female"
                                           @if ($users->gender == 'female') checked @endif> Female
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="current_profile_image">Current Profile Image</label>
                                    @if ($users->profile_image)
                                        <p>
                                            <img width="75" height="75" src="{{ asset('storage/images/users/' . $users->profile_image) }}"
                                                 alt="Profile Image" class="img-fluid">
                                        </p>
                                    @else
                                        <p>No image!</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="profile_image">Profile Image</label>
                                    <br>
                                    <input type="file" name="profile_image" id="profile_image" accept="image/*">
                                </div>
                            </div>
                            <div class="col col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="profile_image">Preview Profile Image</label>
                                    <br>
                                    <img width="75" height="75" id="imagePreview" src="" alt="Preview Gambar" style="display: none;"
                                         class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chart tab-pane" id="login">
                        <div class="row">
                            <div class="col col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           value="{{ $users->email }}">
                                </div>
                            </div>
                            <div class="col col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                           value="" placeholder="password"
                                           autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                    Save
                </button>
                <button type="reset" name="reset" class="btn btn-danger"><i class="fa fa-sync"></i> Reset</button>
                <a href="{{ route('users.index') }}" name="reset" class="btn btn-dark">
                    <i class="fa fa-arrow-left"></i> Cancel</a>
            </div>
            <!-- /.card-body -->
        </div>
    </form>
@endsection

@section('script_addon')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $('form').submit(function () {
            $('#submit').attr('disabled', 'disabled');
            return true;
        });

        const profile_image = document.getElementById("profile_image");
        const imagePreview = document.getElementById("imagePreview");

        profile_image.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block";
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = "";
                imagePreview.style.display = "none";
            }
        });
    </script>
@endsection
