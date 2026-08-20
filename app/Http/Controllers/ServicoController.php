<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoRequest;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $servicos = Servico::query()
            ->when($request->busca, function ($query, $busca) {
                $query->where('nome', 'like', "%{$busca}%");
            })
            ->get();

        return view('servicos.index', compact('servicos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('servicos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServicoRequest $request)
    {
        Servico::create($request->validated());

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        return view('servicos.edit', compact('servico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServicoRequest $request, Servico $servico)
    {
        $servico->update($request->validated());

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servico $servico)
    {
        $servico->delete();

        return redirect()
            ->route('servicos.index')
            ->with('success', 'Serviço excluído com sucesso!');
    }
}