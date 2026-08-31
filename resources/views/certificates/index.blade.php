@extends('layouts.app')

@section('content')

<div class="container my-4">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Atestados Médicos</h2>

    <a href="{{ route('certificates.create') }}" class="btn btn-primary">
        Novo Atestado
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Animal</th>
                    <th>Título</th>
                    <th>Data de emissão</th>
                    <th>Documento</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>

            <tbody>

                @forelse($certificates as $certificate)

                    <tr>

                        <td>{{ $certificate->id }}</td>

                        <td>
                            <strong>{{ $certificate->animal->name }}</strong>
                        </td>

                        <td>
                            {{ $certificate->title }}
                        </td>

                        <td>
                            {{ $certificate->issue_date->format('d/m/Y') }}
                        </td>

                        <td>
                            <a
                                href="{{ asset('storage/' . $certificate->file_path) }}"
                                target="_blank"
                                class="btn btn-sm btn-info text-white"
                            >
                                Visualizar
                            </a>

                            <a
                                href="{{ asset('storage/' . $certificate->file_path) }}"
                                download
                                class="btn btn-sm btn-secondary"
                            >
                                Baixar
                            </a>
                        </td>

                        <td class="text-end">

                            <a
                                href="{{ route('certificates.show', $certificate) }}"
                                class="btn btn-sm btn-info text-white"
                            >
                                Ver
                            </a>

                            <a
                                href="{{ route('certificates.edit', $certificate) }}"
                                class="btn btn-sm btn-warning"
                            >
                                Editar
                            </a>

                            <form
                                action="{{ route('certificates.destroy', $certificate) }}"
                                method="POST"
                                class="d-inline"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger"
                                >
                                    Excluir
                                </button>
                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Nenhum atestado cadastrado.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</div>


</div>

@endsection
