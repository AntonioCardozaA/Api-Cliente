@extends('layouts.app')

@section('title', 'Editar Estudiante')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Editar Estudiante</h1>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('student.update', $student['id']) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" name="name" required
                   value="{{ old('name', $student['name']) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Correo -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Correo</label>
            <input type="email" name="email" required
                   value="{{ old('email', $student['email']) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Teléfono -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Teléfono</label>
            <input type="text" name="phone" required
                   value="{{ old('phone', $student['phone']) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            @error('phone') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Lenguaje -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Lenguaje</label>
            <input type="text" name="language" required
                   value="{{ old('language', $student['language']) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            @error('language') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-between mt-6">
            <a href="{{ route('students.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                Regresar
            </a>

            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
