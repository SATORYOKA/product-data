@extends('layouts.app')

@section('content')

<h3>商品一覧</h3>

    @if (count($products) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>no</th>
                    <th>商品名</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{!! link_to_route('products.show', $product->id, ['product' => $product->id]) !!}</td>
                    <td>{{ $product->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {!! link_to_route('products.create', '新規商品の登録', [], ['class' => 'btn btn-primary'])!!}

@endsection