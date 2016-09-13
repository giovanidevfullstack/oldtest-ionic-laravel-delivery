@extends('app')

@section('content')

    <div class="container">
        <h3>Produtos</h3>

        <a href="{{ route('admin.products.create') }}" class="btn btn-success">Novo Produto</a>

        <br><br>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Price</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', ['id'=>$product->id]) }}" class="btn btn-block btn-primary">
                            Editar
                        </a>
                        <a href="{{ route('admin.products.destroy', ['id'=>$product->id]) }}" class="btn btn-block btn-danger">
                            Remover
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $products->render() !!}
    </div>

@endsection
