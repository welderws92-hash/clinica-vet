@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2>Editar Serviço: {{ $servico->nome }}</h2>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('servicos.update', $servico) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome do Serviço</label>
                    <input
                        type="text"
                        name="nome"
                        class="form-control @error('nome') is-invalid @enderror"
                        value="{{ old('nome', $servico->nome) }}"
                        required
                    >
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Preço</label>
                    <input
                        type="number"
                        name="preco"
                        step="0.01"
                        min="0"
                        class="form-control @error('preco') is-invalid @enderror"
                        value="{{ old('preco', $servico->preco) }}"
                        required
                    >
                    @error('preco')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea
                        name="descricao"
                        class="form-control @error('descricao') is-invalid @enderror"
                        rows="4"
                    >{{ old('descricao', $servico->descricao) }}</textarea>

                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    Atualizar Serviço
                </button>

                <a href="{{ route('servicos.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection