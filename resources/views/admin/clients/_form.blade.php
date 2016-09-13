<div class="form-group">
    {!! Form::label('Name','Nome:') !!}
    {!! Form::text('name',null,['class'=>'form-control']) !!}

    {!! Form::label('Email','e-mail:') !!}
    {!! Form::text('email',null,['class'=>'form-control']) !!}

    {!! Form::label('Password','Senha:') !!}
    {!! Form::password('password',['class'=>'form-control']) !!}
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