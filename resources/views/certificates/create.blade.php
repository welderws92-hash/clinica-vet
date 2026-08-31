@extends('layouts.app')

@section('content')

<div class="container my-4">

<h2 class="mb-4">Novo Atestado Médico</h2>

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
    action="{{ route('certificates.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

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
            <option value="">Selecione o animal</option>

            @foreach($animals as $animal)
                <option
                    value="{{ $animal->id }}"
                    {{ old('animal_id') == $animal->id ? 'selected' : '' }}
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
            value="{{ old('title') }}"
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
            value="{{ old('issue_date') }}"
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
        >{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">
            Documento
        </label>

        <input
            type="file"
            name="file"
            id="file"
            class="form-control"
            accept=".pdf,.jpg,.png"
            required
        >

        <small class="text-muted">
            Formatos permitidos: PDF, JPG e PNG. Tamanho máximo: 2 MB.
        </small>
    </div>

    <button type="submit" class="btn btn-primary">
        Salvar
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
