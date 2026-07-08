@extends('layouts.admin')

@section('title', 'Edit Karya')

@section('content')
<form method="POST" action="{{ route('admin.karya.update', $karya) }}" enctype="multipart/form-data">
  @csrf @method('PUT')
  @include('admin.karya._form')
</form>
@endsection
