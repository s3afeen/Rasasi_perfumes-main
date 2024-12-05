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
                          
                          <h5 class="card-title">Add new user</h5>

                    <form class="row g-3" action="{{ route('users.store')}}" method="POST">
                        @csrf
                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">First name</label>
                        <input type="text" class="form-control" id="Fname" placeholder="First name" name="Fname" value="{{ old('Fname') }}" required>
                      </div>

                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="Lname" placeholder="Last name" name="Lname" value="{{ old('Lname') }}" required>
                      </div>


                      <div class="col-12">
                        <label for="exampleInputEmail3" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                      </div>


                      <div class="col-12">
                        <label for="exampleInputName1" class="form-label">Phone number</label>
                        <input type="text" class="form-control" id="mobile" placeholder="Phone number" name="mobile" value="{{ old('mobile') }}" required>
                      </div>

                      <div class="col-12">
                        <label for="exampleInputPassword4" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="{{ old('password') }}" required>
                      </div>

                      <div class="col-12">
                        <label for="exampleInputPassword4" class="form-label">Confirm password</label>
                        <input type="password" class="form-control" id="password" placeholder="Confirm password" name="password_confirmation" required>
                      </div>

                      <div class="col-12">
                        <label for="exampleSelectGender" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role" required>

                          <option value="user"  {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                          <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                 
                        </select>
                      </div>

                      <div class="text-center">
                      <button type="submit" class="btn btn-info">Create</button>
                      <a href="{{route('users.index')}}" class="btn btn-secondary">Cancel</a>
                      </div>
                    </form>
                  </div>
                </div>
              

@endsection
