@extends('layouts.dashboard_master')

@section('content')
<div class="pagetitle">
    <h1>Profile</h1>
    <!-- <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav> -->
</div><!-- End Page Title -->

<section class="section profile">
    <div class="row">
        <!-- Profile Card -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'assets/img/profile-img.jpg' }}" alt="Profile" class="rounded-circle" style="width: 100px; height: 100px;">
                    <h2 class="text-start w-50">{{ auth()->user()->Fname }} {{ auth()->user()->Lname }}</h2>
                    <p class="text-start w-50"><b>Email:</b> {{ auth()->user()->email }}</p>
                    <p class="text-start w-50"><b>Mobile:</b> {{ auth()->user()->mobile }}</p>
                </div>
            </div>
        </div>


        <!-- Profile Edit Form -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                    <h5>Edit Profile</h5>
                    <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="Fname">First Name</label>
                            <input type="text" class="form-control" id="Fname" name="Fname" value="{{ auth()->user()->Fname }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="Lname">Last Name</label>
                            <input type="text" class="form-control" id="Lname" name="Lname" value="{{ auth()->user()->Lname }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="mobile">Phone Number</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ auth()->user()->mobile }}" required>
                        </div>

                         <!-- Profile Image Upload -->
                        <div class="row mb-3">
                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Test Profile Image</label>
                            <div class="col-md-8 col-lg-9">
                                <div class="pt-2">
                                    <input type="file" name="profile_image" class="form-control-file">
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-outline-info" onclick="confirmUpdate(event)">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Confirmation Modal -->
<div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <h5>Are you sure you want to update your profile?</h5>
        <button id="confirmButton" class="btn btn-outline-info">Confirm</button>
        <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
    </div>
</div>

<script>
    function confirmUpdate(event) {
        event.preventDefault();
        var modal = document.getElementById('confirmationModal');
        modal.style.display = 'flex';

        document.getElementById('confirmButton').onclick = function () {
            document.getElementById('profileForm').submit();
        };

        document.getElementById('cancelButton').onclick = function () {
            modal.style.display = 'none';
        };
    }
</script>
@endsection
