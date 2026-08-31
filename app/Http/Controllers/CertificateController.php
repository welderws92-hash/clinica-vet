<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Animal;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CertificateRequest;

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
    public function store(CertificateRequest $request)
    {
        $validated = $request->validated();

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
    public function update(CertificateRequest $request, Certificate $certificate)
    {
        $validated = $request->validated();

        if ($request->hasFile('file')) {

            Storage::disk('public')->delete(
                $certificate->file_path
            );

            $filePath = $request->file('file')
                ->store('certificates', 'public');

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
        Storage::disk('public')->delete(
            $certificate->file_path
        );

        $certificate->delete();

        return redirect()
            ->route('certificates.index')
            ->with('success', 'Atestado excluído com sucesso!');
    }
}