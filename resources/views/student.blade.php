@extends('layouts.app')

@section('title', 'Agregar Estudiante')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Agregar Estudiante</h1>

    <form action="{{ route('student.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" name="name" required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Correo</label>
            <input type="email" name="email" required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Teléfono</label>
            <input type="text" name="phone" required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Language</label>
            <input type="language" name="language" required
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('students.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                Regresar
            </a>

            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection
