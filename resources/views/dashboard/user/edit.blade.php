@extends('layouts.dashboard_master')


@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">

  <div class="pagetitle">
    <h1></h1>
  </div>
     
</div>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
</div>
@endif



  <div class="card">
    <div class="card-body">
      
      <h5 class="card-title">Edit user</h5>
                   
                    <form id="profileForm" class="row g-3" action="{{ route('users.update',$user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">First name</label>
                        <input type="text" class="form-control" id="Fname" placeholder="First name" name="Fname" value="{{$user->Fname}}" required>
                      </div>

                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="Lname" placeholder="Last name" name="Lname" value="{{$user->Lname}}" required>
                      </div>


                      <div class="col-12">
                        <label for="exampleInputEmail3" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{$user->email}}" required>
                      </div>


                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Phone number</label>
                        <input type="text" class="form-control" id="mobile" placeholder="Phone number" name="mobile" value="{{$user->mobile}}" required>
                      </div>

                      
                      <div class="col-12">
                        <label for="exampleSelectGender" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role" required>

                          <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                          <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
                       
                        </select>
                      </div>

                      <div class="text-center">
                      <button type="button" id="editButton" class="btn btn-info">Edit</button>
                      <a href="{{route('users.index')}}" class="btn btn-secondary">Cancel</a>
                      </div>
                    </form>
                  </div>
                </div>
            


              <div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
                <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
                    <h5>Are you sure you want to edit this user?</h5>
                    <button id="confirmButton" class="btn btn-outline-info btn-fw">Edit</button>
                    <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
                </div>
            </div>


            <script>
              // Get the modal
              var modal = document.getElementById('confirmationModal');
              var form = document.getElementById('profileForm');
          
              // Show the modal when the user clicks the "Edit" button
              document.getElementById('editButton').onclick = function (event) {
                  event.preventDefault(); // Prevent form submission
                  modal.style.display = 'flex'; // Show the modal
              };
          
              // Set up the confirm button to submit the form
              document.getElementById('confirmButton').onclick = function () {
                  form.submit(); // Submit the form
              };
          
              // Set up the cancel button to close the modal
              document.getElementById('cancelButton').onclick = function () {
                  modal.style.display = 'none'; // Hide the modal
              };
          </script>
          

@endsection
