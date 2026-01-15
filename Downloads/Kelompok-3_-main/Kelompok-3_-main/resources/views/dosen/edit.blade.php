@extends('layouts.app')

@section('title', 'Edit Dosen')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Data Dosen</h2>

    <form action="{{ route('dosen.update', $dosen->id) }}" method="POST">
        @csrf
        @method('PUT')
       @include('dosen.partials.form', ['button' => 'Update'])
        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
