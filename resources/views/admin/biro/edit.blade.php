@extends('layouts.admin')

@section('title', 'Edit Biro')

@section('content')
<form method="POST" action="{{ route('admin.biro.update', $biro) }}" enctype="multipart/form-data">
  @csrf @method('PUT')
  @include('admin.biro._form')
</form>
@endsection
