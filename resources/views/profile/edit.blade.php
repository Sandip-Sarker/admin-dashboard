@extends('backend.master')

@section('main_content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xxl-4 col-md-4 ">
                        <div class="card mt-3">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <form action="{{route('profile.update')}}" method="post">
                                        @csrf
                                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                        <img id="profile_preview"
                                            src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                            <input name="avatar" id="profile-img-file-input" type="file" class="profile-img-file-input"
                                                   onchange="previewImage(event, 'profile_preview')">
                                            <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                            </label>
                                        </div>
                                    </div>
                                    </form>
                                    <h5 class="fs-16 mb-1">{{ Auth::user()->name  }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-md-8">
                        <div class="card mt-3">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                            <i class="fas fa-home"></i> Personal Details
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                            <i class="far fa-user"></i> Change Password
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body p-4">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                        <form action="{{route('profile.update')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                {{-- Name --}}
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ Auth::user()->name }}">
                                                    </div>
                                                </div>

                                                <!-- Email -->
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ Auth::user()->email }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit -->
                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- change password tab-pane-->
                                    <div class="tab-pane" id="changePassword" role="tabpanel">
                                        <form action="{{ route('password.update') }}" method="post">
                                            @csrf
                                            <div class="row g-2">
                                                <!-- Old Password -->
                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="current_password" class="form-label">Old Password*</label>
                                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password">
                                                    </div>
                                                </div>

                                                <!--New Password-->
                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="password" class="form-label">New Password*</label>
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
                                                    </div>
                                                </div>

                                                <!-- Password Confirmation -->
                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="password_confirmation" class="form-label">Confirm Password*</label>
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-success">Change Password</button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div>
            <!-- container-fluid -->
        </div><!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Velzon.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

@endsection

@push('scripts')
    <script>
        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById(previewId).src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endpush
