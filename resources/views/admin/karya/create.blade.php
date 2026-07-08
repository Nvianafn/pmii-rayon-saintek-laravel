@extends('layouts.admin')

@section('title', 'Tambah Karya')

@section('content')
<form method="POST" action="{{ route('admin.karya.store') }}" enctype="multipart/form-data">
  @csrf
  @include('admin.karya._form')
</form>
@endsection
