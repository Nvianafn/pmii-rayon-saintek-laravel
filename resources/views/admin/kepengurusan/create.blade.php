@extends('layouts.admin')

@section('title', 'Tambah Pengurus')

@section('content')
<form method="POST" action="{{ route('admin.kepengurusan.store') }}">
  @csrf
  @include('admin.kepengurusan._form')
</form>
@endsection
