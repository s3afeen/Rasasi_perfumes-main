@extends('layouts.dashboard_master')


@section('content')
<div class="card shadow-sm rounded-lg">
    <div class="card-body" style="border: 1px solid #e7dee9; background-color: #f9fafb; border-radius: 10px;">

        <!-- Date -->
        <div class="mb-4 mt-4">
            <p class="fw-bold text-primary"><i class="bi bi-calendar-date"></i> <strong>Date:</strong> {{$contact->created_at->format('Y-m-d H:i')}}</p>
            <hr class="my-3">
        </div>

        <!-- User Name -->
        <div class="mb-4">
            <p class="fw-bold text-secondary"><i class="bi bi-person-circle"></i> <strong>User Name:</strong> {{$contact->Fname}} {{$contact->Lname}}</p>
            <hr class="my-3">
        </div>

        <!-- User Email -->
        <div class="mb-4">
            <p class="fw-bold text-secondary"><i class="bi bi-envelope"></i> <strong>User Email:</strong> {{$contact->email}}</p>
            <hr class="my-3">
        </div>

        <!-- Subject -->
        <div class="mb-4">
            <p class="fw-bold text-success"><i class="bi bi-chat-left-text"></i> <strong>Subject:</strong> {{$contact->subject}}</p>
            <hr class="my-3">
        </div>

        <!-- Message -->
        <div class="mb-4">
            <p class="fw-bold text-dark"><i class="bi bi-pencil-square"></i> <strong>Message:</strong></p>
            <p class="text-muted" style="white-space: pre-wrap;">{{$contact->message}}</p>
            <hr class="my-3">
        </div>

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ route('contacts.index') }}" class="btn btn-outline-info btn-lg px-4 py-2 rounded-3 shadow-sm">
                <i class="bi bi-arrow-left-circle"></i> Back to list
            </a>
        </div>

    </div>
</div>


@endsection
