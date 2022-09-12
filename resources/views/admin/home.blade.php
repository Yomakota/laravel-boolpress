@extends('layouts.dashboard')

@section('content')
    <h1>Private Dashboard</h1>
    <div class="profile-datails bg-success p-3">
        <h2>Account details</h2>
        <div> <strong>User Name:</strong> {{ $user->name }}</div>
        <div> <strong>E-mail:</strong> {{ $user->email }}</div>

        @if ($user->userInfo)
            <div> <strong>Phone Number:</strong> {{ $user->userInfo->telephone }}</div>
            <div> <strong>Address:</strong> {{ $user->userInfo->address }}</div>
        @endif
    </div>
@endsection
