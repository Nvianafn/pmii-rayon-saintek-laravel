@extends('layouts.admin')

@section('title', 'Tambah Kegiatan')

@section('content')
<form method="POST" action="{{ route('admin.kegiatan.store') }}" enctype="multipart/form-data">
  @csrf
  @include('admin.kegiatan._form')
</form>
@endsection
