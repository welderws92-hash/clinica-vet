@extends('layouts.app')

@section('content')

<div class="container my-4">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detalhes do Atestado</h2>

    <a
        href="{{ route('certificates.index') }}"
        class="btn btn-secondary"
    >
        Voltar
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="mb-3">
            <strong>Animal:</strong>
            {{ $certificate->animal->name }}
        </div>

        <div class="mb-3">
            <strong>Título:</strong>
            {{ $certificate->title }}
        </div>

        <div class="mb-3">
            <strong>Data de emissão:</strong>
            {{ $certificate->issue_date->format('d/m/Y') }}
        </div>

        <div class="mb-3">
            <strong>Descrição:</strong>
            {{ $certificate->description ?: 'Nenhuma descrição informada.' }}
        </div>

        <div class="mb-3">
            <strong>Documento:</strong>

            <div class="mt-2">
                <a
                    href="{{ asset('storage/' . $certificate->file_path) }}"
                    target="_blank"
                    class="btn btn-info text-white"
                >
                    Visualizar documento
                </a>

                <a
                    href="{{ asset('storage/' . $certificate->file_path) }}"
                    download
                    class="btn btn-secondary"
                >
                    Baixar documento
                </a>
            </div>
        </div>

        <div class="mt-4">

            <a
                href="{{ route('certificates.edit', $certificate) }}"
                class="btn btn-warning"
            >
                Editar
            </a>

            <a
                href="{{ route('certificates.index') }}"
                class="btn btn-secondary"
            >
                Voltar para lista
            </a>

        </div>

    </div>
</div>


</div>

@endsection

