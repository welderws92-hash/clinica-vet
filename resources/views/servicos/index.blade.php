@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h1>Serviços</h1>

        <a href="{{ route('servicos.create') }}" class="btn btn-primary">
            Novo Serviço
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($servicos as $servico)
                <tr>
                    <td>{{ $servico->nome }}</td>
                    <td>{{ $servico->descricao }}</td>
                    <td>R$ {{ number_format($servico->preco, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('servicos.edit', $servico) }}"
                           class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('servicos.destroy', $servico) }}"
                              method="POST"
                              style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Deseja excluir este serviço?')">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        Nenhum serviço cadastrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection