@extends('layouts.base')

@section('styles')
    <link rel="stylesheet" href="css/app.css">
@endsection

@section('content')
    @isset($errors)
        @if ($errors->has('file'))
            @foreach($errors->get('file') as $erro)
                <strong class="error">{{ $erro }}</strong>
            @endforeach
        @endif

        @if ($errors->has('error'))
            <strong class="error">{{ $errors->get('error')[0] }}</strong>
        @endif
    @endisset

    <h1>Envie seus dados</h1>

    <form class="form-upload" action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="file" class="form-label">Escolha um arquivo com os dados das vendas:</label>
            <input class="form-control" type="file" name="file" id="file" required accept=".txt,.csv">
        </div>

        <input class="btn btn-primary submit" type="submit" value="Enviar">
    </form>

    @if ($sales)
        <table class="table">
            <thead>
                <tr>
                    <th>Comprador</th>
                    <th>Descrição</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Endereço</th>
                    <th>Fornecedor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->buyer }}</td>
                        <td>{{ $sale->description }}</td>
                        <td>R$ {{ number_format($sale->price_unit, 2, ',', '.') }}</td>
                        <td>{{ $sale->lot }}</td>
                        <td>{{ $sale->address }}</td>
                        <td>{{ $sale->vendor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
