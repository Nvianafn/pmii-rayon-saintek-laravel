@extends('layouts.admin')

@section('title', 'Tambah Periode')

@section('content')
<form method="POST" action="{{ route('admin.periode.store') }}">
  @csrf
  @include('admin.periode._form')
</form>
@endsection
