@extends('layouts.app')

@section('content')

    

    <h3>商品を登録</h3>

    <div class="row">
        <div class="col-6">
            {!! Form::model($product, ['route' => 'products.store']) !!}

                <div class="form-group">
                    {!! Form::label('content', '商品名:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection