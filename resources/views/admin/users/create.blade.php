@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')
<form method="POST" action="{{ route('admin.users.store') }}">
  @csrf
  @include('admin.users._form')
</form>
@endsection
