@extends('layouts.admin')

@section('title', 'Edit Anggota')

@section('content')
<form method="POST" action="{{ route('admin.anggota.update', $anggota) }}" enctype="multipart/form-data">
  @csrf @method('PUT')
  @include('admin.anggota._form')
</form>
@endsection
