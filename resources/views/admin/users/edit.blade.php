@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<form method="POST" action="{{ route('admin.users.update', $user) }}">
  @csrf
  @method('PUT')
  @include('admin.users._form')
</form>
@endsection
