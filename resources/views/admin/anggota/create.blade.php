@extends('layouts.admin')

@section('title', 'Tambah Anggota')

@section('content')
<form method="POST" action="{{ route('admin.anggota.store') }}" enctype="multipart/form-data">
  @csrf
  @include('admin.anggota._form')
</form>
@endsection
