@extends('layouts.app')

@section('title', 'Detalles del Estudiante')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Detalles del Estudiante</h1>

    <div class="bg-white p-6 rounded-lg shadow-md space-y-4">
        <div>
            <h2 class="text-gray-700 font-semibold">Nombre:</h2>
            <p class="text-gray-900">{{ $student['name'] ?? 'Sin nombre' }}</p>
        </div>

        <div>
            <h2 class="text-gray-700 font-semibold">Correo:</h2>
            <p class="text-blue-600">
                <a href="mailto:{{ $student['email'] ?? '' }}">{{ $student['email'] ?? 'Sin email' }}</a>
            </p>
        </div>

        <div>
            <h2 class="text-gray-700 font-semibold">Teléfono:</h2>
            <p class="text-gray-900">{{ $student['phone'] ?? 'Sin teléfono' }}</p>
        </div>

        <div>
            <h2 class="text-gray-700 font-semibold">Lenguaje:</h2>
            <p class="text-gray-900">{{ $student['language'] ?? 'No especificado' }}</p>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('students.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                Regresar
            </a>

            <a href="{{ route('student.edit', $student['id']) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                Editar
            </a>
        </div>
    </div>
</div>
@endsection
