@extends('layouts.app')
@section('title', 'Alumnos')
@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1 style="margin: 0;">Estudiantes</h1>
    <div style="display: flex; gap: 1rem; align-items: center;">
        <a href="{{ route('students.index') }}" 
           style="background: #3b82f6; color: white; padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
            <i class="fas fa-sync-alt"></i> Recargar
        </a>
        <a href="{{ route('student.create') }}" 
           style="background: #10b981; color: white; padding: 0.5rem 1.5rem; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 500;">
            <i class="fas fa-user-plus"></i> Nuevo Estudiante
        </a>
    </div>
</div>

{{-- Mostrar mensajes de sesión --}}
@if(session('success'))
    <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid #10b981; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; color: #10b981;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid #ef4444; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; color: #ef4444;">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
@endif

{{-- Mostrar error si existe --}}
@isset($error)
    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid #ef4444; border-radius: 8px; padding: 1.5rem; margin-bottom: 1.5rem;">
        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Error de Conexión</strong>
        </div>
        <p style="margin: 0; color: #ef4444;">{{ $error }}</p>
    </div>
@endisset

@php
    // Normalizar datos
    $students = is_array($data) ? $data : [];
@endphp

@if(empty($students) && !isset($error))
    <div style="text-align: center; padding: 3rem; background: rgba(30, 41, 59, 0.7); border-radius: 12px; margin: 2rem 0;">
        <div style="font-size: 4rem; color: #3b82f6; margin-bottom: 1rem;">
            <i class="fas fa-user-graduate"></i>
        </div>
        <h3 style="color: #e2e8f0; margin-bottom: 0.5rem;">No hay estudiantes registrados</h3>
        <p style="color: #94a3b8; margin-bottom: 1.5rem;">Comienza agregando tu primer estudiante</p>
        <a href="{{ route('student.index') }}" 
           style="background: #10b981; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
            <i class="fas fa-plus"></i> Crear Primer Estudiante
        </a>
    </div>
@elseif(!empty($students))
    <div style="overflow-x: auto; border-radius: 12px; border: 1px solid rgba(255, 255, 255, 0.1);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: linear-gradient(135deg, #1e40af, #3b82f6);">
                    <th style="padding: 1rem; text-align: left; color: white; font-weight: 600;">ID</th>
                    <th style="padding: 1rem; text-align: left; color: white; font-weight: 600;">Nombre</th>
                    <th style="padding: 1rem; text-align: left; color: white; font-weight: 600;">Email</th>
                    <th style="padding: 1rem; text-align: left; color: white; font-weight: 600;">Teléfono</th>
                    <th style="padding: 1rem; text-align: left; color: white; font-weight: 600;">Lenguaje</th>
                    <th style="padding: 1rem; text-align: left; color: white; font-weight: 600;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); transition: background 0.2s;"
                    onmouseover="this.style.background='rgba(59, 130, 246, 0.05)'"
                    onmouseout="this.style.background='transparent'">
                    <td style="padding: 1rem; color: #e2e8f0; font-family: 'Courier New', monospace;">
                        #{{ $student['id'] ?? 'N/A' }}
                    </td>
                    <td style="padding: 1rem; color: #e2e8f0;">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #3b82f6, #8b5cf6); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                                {{ substr($student['name'] ?? '?', 0, 1) }}
                            </div>
                            <span style="font-weight: 500;">{{ $student['name'] ?? 'Sin nombre' }}</span>
                        </div>
                    </td>
                    <td style="padding: 1rem; color: #e2e8f0;">
                        <a href="mailto:{{ $student['email'] ?? '' }}" 
                           style="color: #60a5fa; text-decoration: none;">
                            {{ $student['email'] ?? 'Sin email' }}
                        </a>
                    </td>
                    <td style="padding: 1rem; color: #e2e8f0;">
                        {{ $student['phone'] ?? 'Sin teléfono' }}
                    </td>
                    <td style="padding: 1rem;">
                        @if(!empty($student['language']))
                        <span style="background: rgba(59, 130, 246, 0.2); color: #60a5fa; padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.875rem; border: 1px solid rgba(59, 130, 246, 0.3);">
                            {{ $student['language'] }}
                        </span>
                        @else
                        <span style="color: #94a3b8; font-size: 0.875rem;">No especificado</span>
                        @endif
                    </td>
                    <td style="padding: 1rem;">
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                            @if(isset($student['id']))
                            
                        
                            <a href="{{ route('student.edit', $student['id']) }}" 
                               title="Editar"
                               style="background: rgba(234, 179, 8, 0.1); color: #eab308; padding: 0.5rem; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; transition: all 0.2s;"
                               onmouseover="this.style.background='rgba(234, 179, 8, 0.2)'; this.style.transform='translateY(-2px)'"
                               onmouseout="this.style.background='rgba(234, 179, 8, 0.1)'; this.style.transform='translateY(0)'">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            
                            <a href="{{ route('student.delete.get', $student['id']) }}" 
                               title="Eliminar"
                               style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 0.5rem; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; transition: all 0.2s;"
                               onclick="return confirm('¿Estás seguro de eliminar a {{ $student['name'] ?? 'este estudiante' }}?');"
                               onmouseover="this.style.background='rgba(239, 68, 68, 0.2)'; this.style.transform='translateY(-2px)'"
                               onmouseout="this.style.background='rgba(239, 68, 68, 0.1)'; this.style.transform='translateY(0)'">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; color: #94a3b8; font-size: 0.875rem;">
        <div>
            <i class="fas fa-info-circle"></i>
            Mostrando {{ count($students) }} estudiante(s)
        </div>
    </div>
@endif

@endsection