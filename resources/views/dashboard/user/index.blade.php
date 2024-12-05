@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

  <div class="pagetitle">
    <h1>Users</h1>
  </div>
  
        <a href="{{ route('users.create') }}">
            <button type="button" class="btn btn-outline-info">
                <i class="zmdi zmdi-plus"></i> Add new user
            </button>
        </a>
      
</div>

    
 
    
    @if(session('delete'))
  
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>
      {{ session('delete') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    @if(session('success'))
   
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i>
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif



<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>

          <!-- Table with stripped rows -->
          <table class="table datatable">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone number</th>
                          <th>role</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                          <td>{{$user->id}}</td>
                          <td>
                            <a href="{{ route('users.show', $user->id) }}" 
                              style="color:#000000;"
                               onmouseover="this.style.color='#0dcaf0';" 
                              onmouseout="this.style.color='#000000';">{{$user->Fname}} {{$user->Lname}}
                            </a>
                          </td>

                          
                          <td>{{$user->email}}</td>
                          <td>{{$user->mobile}}</td>

                          @if($user->role == 'manager')
                              <td>{{$user->role}}</td>

                          @elseif($user->role == 'employee')
                              <td>{{$user->role}}</td>


                          @elseif($user->role == 'user' )
                            <td>{{$user->role}}</td>

                          @endif
                          <td> 
                            
                        

                          
                          <a href="{{ route('users.edit', $user->id) }}"  title="Edit">
                          <button type="button" class="btn btn-info">
                            <i class="bi bi-pencil"></i>
                          </button>
                          </a>
                          
                          <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" title="Delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger"  onclick="confirmDeletion(event, '{{ route('users.destroy', $user->id) }}')">
                            <i class="bi bi-archive"></i>
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
              
            </div>
            
          </section>


                          


                  </div>

<!-- Custom Pagination -->



                </div>
              </div>

<!-- Custom Confirmation Modal -->
<div id="confirmationModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Are you sure you want to delete this user?</p>
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
