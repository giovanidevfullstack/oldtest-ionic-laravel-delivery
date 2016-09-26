@extends('app')

@section('content')

    <div class="container">
        <h3>Pedido # {{ $order->id }} - R$ {{ $order->total }}</h3>
        <h3>Cliene: {{ $order->client->user->name }}</h3>
        <h4>Data: {{ $order->created_at }}</h4>

        <p>
            Entregar em: <br>
            {{ $order->client->address }} - {{$order->client->city}} - {{$order->client->state}}
        </p>
        <br>

        {!! Form::model($order, ['route'=>['admin.orders.update', $order->id]]) !!}

        <div class="form-group">
            {!! Form::label('Status', 'status:') !!}
            {!! Form::select('status', $list_status, null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Entregador', 'entregador:') !!}
            {!! Form::select('user_deliveryman_id', $deliveryman, null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>

@endsection
