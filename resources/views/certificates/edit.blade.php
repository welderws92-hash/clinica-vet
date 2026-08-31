@extends('layouts.app')

@section('content')

<div class="container my-4">

<h2 class="mb-4">Editar Atestado Médico</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    action="{{ route('certificates.update', $certificate) }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="animal_id" class="form-label">
            Animal
        </label>

        <select
            name="animal_id"
            id="animal_id"
            class="form-select"
            required
        >
            @foreach($animals as $animal)
                <option
                    value="{{ $animal->id }}"
                    {{ old('animal_id', $certificate->animal_id) == $animal->id ? 'selected' : '' }}
                >
                    {{ $animal->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">
            Título
        </label>

        <input
            type="text"
            name="title"
            id="title"
            class="form-control"
            value="{{ old('title', $certificate->title) }}"
            required
        >
    </div>

    <div class="mb-3">
        <label for="issue_date" class="form-label">
            Data de emissão
        </label>

        <input
            type="date"
            name="issue_date"
            id="issue_date"
            class="form-control"
            value="{{ old('issue_date', $certificate->issue_date->format('Y-m-d')) }}"
            required
        >
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">
            Descrição
        </label>

        <textarea
            name="description"
            id="description"
            class="form-control"
            rows="4"
        >{{ old('description', $certificate->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">
            Documento atual
        </label>

        <div>
            <a
                href="{{ asset('storage/' . $certificate->file_path) }}"
                target="_blank"
                class="btn btn-sm btn-info text-white"
            >
                Visualizar documento atual
            </a>
        </div>
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">
            Substituir documento
        </label>

        <input
            type="file"
            name="file"
            id="file"
            class="form-control"
            accept=".pdf,.jpg,.png"
        >

        <small class="text-muted">
            Deixe vazio para manter o documento atual.
            Formatos permitidos: PDF, JPG e PNG. Tamanho máximo: 2 MB.
        </small>
    </div>

    <button type="submit" class="btn btn-primary">
        Atualizar
    </button>

    <a
        href="{{ route('certificates.index') }}"
        class="btn btn-secondary"
    >
        Cancelar
    </a>

</form>


</div>

@endsection
