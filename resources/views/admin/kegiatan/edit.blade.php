@extends('layouts.admin')

@section('title', 'Edit Kegiatan')

@section('content')
<form method="POST" action="{{ route('admin.kegiatan.update', $kegiatan) }}" enctype="multipart/form-data">
  @csrf @method('PUT')
  @include('admin.kegiatan._form')
</form>
@endsection
