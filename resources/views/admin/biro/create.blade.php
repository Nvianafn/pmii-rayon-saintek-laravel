@extends('layouts.admin')

@section('title', 'Tambah Biro')

@section('content')
<form method="POST" action="{{ route('admin.biro.store') }}" enctype="multipart/form-data">
  @csrf
  @include('admin.biro._form')
</form>
@endsection
