@extends('layouts.admin')

@section('title', 'Edit Pengurus')

@section('content')
<form method="POST" action="{{ route('admin.kepengurusan.update', $kepengurusan) }}">
  @csrf @method('PUT')
  @include('admin.kepengurusan._form')
</form>
@endsection
