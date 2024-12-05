@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-1">Deleted Users</h2>
        <a href="{{ route('users.index') }}">
            <button type="button" class="btn btn-outline-info btn-fw">
                 Back To Users Table
            </button>
        </a>
    </div>
 



    @if(session('delete'))
    <div class="alert alert-success" style="background-color: #FFFFFF; color: #DC3545; border: 1px solid #DC3545; font-weight: bold; margin-left: 36px; ">
        {{ session('delete') }}
    </div>
@endif

    @if(session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; font-weight: bold; margin-left: 36px; ">
        {{ session('success') }}
    </div>
@endif
<style>
  /* Animation to fade out */
  @keyframes fadeOut {
      0% {
          opacity: 1;
      }
      100% {
          opacity: 0;
      }
  }

  /* Apply fade-out animation to messages */
  .alert {
      animation: fadeOut 3s ease-out forwards;
  }
</style>

<div class=" grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   
                    </p>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>First name</th>
                          <th>Last name</th>
                          <th>Email</th>
                          <th>Phone number</th>
                          <th>role</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($deletedUsers as $user)
                        <tr>
                          <td>{{$user->id}}</td>
                          <td>{{$user->Fname}}</td>
                          <td >{{$user->Lname}} </td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->mobile}}</td>

                          @if($user->role == 'manager')
                              <td><label class="badge badge-dark">{{$user->role}}</label></td>

                          @elseif($user->role == 'veterinarian')
                              <td><label class="badge badge-primary">{{$user->role}}</label></td>

                          @elseif($user->role == 'store_manager' )
                            <td><label class="badge badge-info">{{$user->role}}</label></td>

                          @elseif($user->role == 'receptionist' )
                              <td><label class="badge badge-danger">{{$user->role}}</label></td>

                          @elseif($user->role == 'user' )
                            <td><label class="badge badge-success">{{$user->role}}</label></td>

                          @endif
                          <td> 
                            
                            <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display:inline;" title="Restore">
                             @csrf
                                    <button type="submit" class="btn btn-outline-secondary btn-rounded btn-icon">
                                         <i class="mdi mdi-restore text-success"></i>
                                    </button>
                            </form>

                          
                        </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

<!-- Custom Confirmation Modal -->
<div id="confirmationModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Are you sure you want to delete this user forever?</p>
        <button id="confirmButton" class="btn btn-outline-danger">Delete</button>
        <button id="cancelButton" class="btn btn-outline-secondary">Cancel</button>
    </div>
</div>

<script>
    function confirmDeletion(event, url) {
        event.preventDefault(); // Prevent the default form submission -. تريد منع نموذج من الإرسال عند النقر على زر الإرسال
        var modal = document.getElementById('confirmationModal');
        var confirmButton = document.getElementById('confirmButton');
        var cancelButton = document.getElementById('cancelButton');

        // Show the custom confirmation dialog
        modal.style.display = 'flex';

        // Set up the confirm button to submit the form
        confirmButton.onclick = function () {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            // "hidden" يُستخدم للإشارة إلى طرق مختلفة لجعل العناصر غير مرئية أو مخفية
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}'; // Laravel CSRF token
            form.appendChild(csrfToken);

            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        };

        // Set up the cancel button to hide the modal
        cancelButton.onclick = function () {
            modal.style.display = 'none';
        };
    }
</script>

@endsection
