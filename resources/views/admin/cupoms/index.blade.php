@extends('app')

@section('content')

    <div class="container">
        <h3>Cupons</h3>

        <a href="{{ route('admin.cupoms.create') }}" class="btn btn-success">Novo Cupom</a>

        <br><br>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Valor</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
            @foreach($cupoms as $cupom)
                <tr>
                    <td>{{ $cupom->id }}</td>
                    <td>{{ $cupom->code }}</td>
                    <td>{{ $cupom->value }}</td>
                    <td>
                        <a href="#" class="btn btn-block btn-default">
                            Editar
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $cupoms->render() !!}
    </div>

@endsection
