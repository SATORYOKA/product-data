@extends('layouts.app')

@section('content')

    <h1>id: {{ $product->id }} の商品編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('content', '商品:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
    
@endsection
