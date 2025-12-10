<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentsController extends Controller {

    private $api;

    public function __construct()
    {
        $this->api = env('URL_SERVER_API', 'http://127.0.0.1:8000') . '/api/students';
    }

    public function index(){
        $response = Http::get($this->api);
        $data = $response->json();
        return view('students', compact('data'));
    }

    public function create(){
        return view('student');
    }

    public function store(Request $request){
        Http::post($this->api, [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'language' => $request->language,
        ]);

        return redirect()->route('students.index');
    }

    public function destroy($id){
        Http::delete($this->api.'/'.$id);
        return redirect()->route('students.index');
    }

    public function view($id){
        $response = Http::get($this->api.'/'.$id);
        $student = $response->json();
        return view('studentDetail', compact('student'));
    }

    public function edit($id)
{
    $response = Http::get($this->api.'/'.$id);

    // Verificar si la API respondió correctamente
    if (!$response->successful()) {
        return redirect()->route('students.index')
            ->with('error', 'No se pudo cargar el estudiante');
    }

    // Extraer los datos del estudiante
    $student = $response->json()['data'] ?? null;

    if (!$student) {
        return redirect()->route('students.index')
            ->with('error', 'Estudiante no encontrado');
    }

    return view('studentEdit', compact('student'));
}

public function update(Request $request, $id)
{
    // Validar los datos antes de enviar a la API
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'language' => 'required|string|max:50',
    ]);

    $response = Http::put($this->api.'/'.$id, $validated);

    if (!$response->successful()) {
        return redirect()->back()->with('error', 'No se pudo actualizar el estudiante');
    }

    return redirect()->route('students.index')->with('success', 'Estudiante actualizado correctamente');
}

}