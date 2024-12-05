@extends('layouts.dashboard_master')


@section('content')

<section class="section">
  <div class="row align-items-top">
  

      <!-- Default Card -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $user->Fname }} {{ $user->Lname }}</h5>
        
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone number:</strong> {{ $user->mobile }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>

    
        <a href="{{ route('users.index') }}" class="btn btn-outline-info btn-fw">Back to list</a>
       
    </div>
</div>

</div>
</section>
@endsection