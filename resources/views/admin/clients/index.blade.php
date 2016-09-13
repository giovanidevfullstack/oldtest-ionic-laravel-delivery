@extends('app')

@section('content')

    <div class="container">
        <h3>Clientes</h3>

        <a href="{{ route('admin.clients.create') }}" class="btn btn-success">Novo Cliente</a>

        <br><br>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Cidade</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->user->name }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->city }}</td>
                    <td>
                        <a href="{{ route('admin.clients.edit', ['id'=>$client->id]) }}" class="btn btn-block btn-primary">
                            Editar
                        </a>
                        <a href="{{ route('admin.clients.destroy', ['id'=>$client->id]) }}" class="btn btn-block btn-danger">
                            Remover
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $clients->render() !!}
    </div>

@endsection
