@extends('layouts.base')

@section('content')
    <h1>Hello World!</h1>

    <h3>Envie seus dados</h3>

    <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="file" name="file" id="file">

        <input type="submit" value="Enviar">
    </form>

    @if ($sales)
        <table>
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
                        <td>{{ $sale->price_unit }}</td>
                        <td>{{ $sale->lot }}</td>
                        <td>{{ $sale->address }}</td>
                        <td>{{ $sale->vendor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
