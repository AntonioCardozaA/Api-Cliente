@extends('layouts.app')

@section('title', 'Estudiantes')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Lista de Estudiantes</h2>
    <a href="{{ route('student.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Nuevo Estudiante</a>
</div>

@if($students->isEmpty())
    <p class="text-gray-400">No hay estudiantes registrados.</p>
@else
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Language</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->language }}</td>
                <td class="flex gap-2">
                    <a href="{{ route('student.show', $student->id) }}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('student.edit', $student->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('student.destroy', $student->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este estudiante?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
