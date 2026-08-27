
<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    /**
     * Lista os atestados.
     */
    public function index()
    {
        $certificates = Certificate::with('animal')->get();

        return view('certificates.index', compact('certificates'));
    }

    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        $animals = Animal::all();

        return view('certificates.create', compact('animals'));
    }

    /**
     * Salva um novo atestado.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'title' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'file' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'notes' => 'nullable|string',
        ]);

        $validated['file_path'] = $request->file('file')
            ->store('certificates', 'public');

        Certificate::create($validated);

        return redirect()
            ->route('certificates.index')
            ->with('success', 'Atestado cadastrado com sucesso!');
    }

    /**
     * Exibe um atestado.
     */
    public function show(Certificate $certificate)
    {
        $certificate->load('animal');

        return view('certificates.show', compact('certificate'));
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Certificate $certificate)
    {
        $animals = Animal::all();

        return view(
            'certificates.edit',
            compact('certificate', 'animals')
        );
    }

    /**
     * Atualiza um atestado.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'title' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'notes' => 'nullable|string',
        ]);

     

        if ($request->hasFile('file')) {

            // 1. Apaga o arquivo antigo
            Storage::disk('public')->delete(
                $certificate->file_path
            );

            // 2. Salva o novo arquivo
            $filePath = $request->file('file')
                ->store('certificates', 'public');

            // 3. Atualiza o caminho do arquivo
            $validated['file_path'] = $filePath;
        }

       

        $certificate->update($validated);

        return redirect()
            ->route('certificates.index')
            ->with('success', 'Atestado atualizado com sucesso!');
    }

    /**
     * Exclui um atestado.
     */
    public function destroy(Certificate $certificate)
    {
        // 1. Apaga o arquivo do storage
        Storage::disk('public')->delete(
            $certificate->file_path
        );

        // 2. Apaga o registro do banco
        $certificate->delete();

        return redirect()
            ->route('certificates.index')
            ->with('success', 'Atestado excluído com sucesso!');
    }
}