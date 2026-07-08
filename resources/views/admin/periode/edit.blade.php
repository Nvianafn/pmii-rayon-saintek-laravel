@extends('layouts.admin')

@section('title', 'Edit Periode')

@section('content')
<form method="POST" action="{{ route('admin.periode.update', $periode) }}">
  @csrf @method('PUT')
  @include('admin.periode._form')
</form>
@endsection
