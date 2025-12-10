@extends('layouts.app')

@section('title', 'Detalle del Estudiante')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Detalle del Estudiante</h1>

    <div class="bg-gray-800 p-6 rounded-lg shadow-md">
        <p><strong>ID:</strong> {{ $student->id }}</p>
        <p><strong>Nombre:</strong> {{ $student->name }}</p>
        <p><strong>Correo:</strong> {{ $student->email }}</p>
        <p><strong>Teléfono:</strong> {{ $student->phone }}</p>
        <p><strong>Language:</strong> {{ $student->language }}</p>
    </div>

    <div class="flex gap-4 mt-6">
        <a href="{{ route('students.index') }}" class="btn btn-danger">Regresar</a>
        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-primary">Editar</a>
    </div>
</div>
@endsection
