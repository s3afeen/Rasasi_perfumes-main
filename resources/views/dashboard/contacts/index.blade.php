@extends('layouts.dashboard_master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-1">Users Contact</h2>
    </div>




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
                          <th>User Name</th>
                          <th>User Email</th>
                          <th>Subject</th>
                          <th>Date</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                          <td>{{$contact->id}}</td>
                          <td>{{$contact->Fname}} {{$contact->Lname}}</td>
                          <td>{{$contact->email}}</td>
                          <td>{{$contact->subject}}</td>
                          <td>{{$contact->created_at->format('Y-m-d')}}</td>

                          <td>


                          <a href="{{ route('contacts.show', $contact->id) }}"  title="View">
                          <button type="button" class="btn btn-info">
                            <i class="bi bi-card-list"></i>
                          </button>
                          </a>


                          @if(Auth::user()->role == 'manager')
                          <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;" title="Delete">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger"  onclick="confirmDeletion(event, '{{ route('contacts.destroy', $contact->id) }}')">
                              <i class="bi bi-basket2"></i>
                            </button>
                        </form>
                        @endif

                        </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                 <!-- Custom Pagination -->
                 <div class="d-flex justify-content-center mt-2">
                  <div class="flex-c-m flex-w w-full p-t-38">
                    {{-- Loop through the pages --}}
                    @foreach ($contacts->getUrlRange(1, $contacts->lastPage()) as $page => $url)
                        @if ($page == $contacts->currentPage())
                            <a href="{{ $url }}"
                               class="flex-c-m how-pagination1 m-all-7 active-pagination1"
                               style="background-color: #14535F; color: white; border-radius: 5px; padding: 8px 12px;">
                                {{ $page }}
                            </a>
                        @else
                            <a href="{{ $url }}"
                               class="flex-c-m how-pagination1 m-all-7"
                               style="color: #14535F; border: 1px solid #14535F; border-radius: 5px; padding: 8px 12px; transition: background-color 0.3s, color 0.3s;"
                               onmouseover="this.style.backgroundColor='#14535F'; this.style.color='white';"
                               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#14535F';">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                  </div>
                </div>

                </div>
              </div>

<!-- Custom Confirmation Modal -->
<div id="confirmationModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Are you sure you want to delete this product?</p>
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


<main id="main" class="main">

    <div class="pagetitle">
      <h1>Contact</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Contact</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section contact">

      <div class="row gy-4">



        <div class="col-xl-6">
          <div class="card p-4">
            <form action="forms/contact.php" method="post" class="php-email-form">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div>

        </div>

      </div>

    </section>

  </main>
