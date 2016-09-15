<div class="form-group">
    {!! Form::label('Name','Nome:') !!}
    {!! Form::text('name',$client->user->name,['class'=>'form-control']) !!}

    {!! Form::label('Email','e-mail:') !!}
    {!! Form::text('email',$client->user->email,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Phone','Telefone:') !!}
    {!! Form::text('phone',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Address','Endereço:') !!}
    {!! Form::text('address',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('City','Cidade:') !!}
    {!! Form::text('city',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('State','Estado:') !!}
    {!! Form::text('state',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Zipcode','CEP:') !!}
    {!! Form::text('zipcode',null,['class'=>'form-control']) !!}
</div>