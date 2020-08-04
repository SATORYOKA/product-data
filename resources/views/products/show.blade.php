@extends('layouts.app')

@section('content')

<h3>詳細ページ</h3>

    <table class="table">
        <tr>
            <th>no</th>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <th>商品名</th>
            <td>{{ $product->content }}</td>
        </tr>
         <tr>
            <th>説明</th>
            <td>{{ $product->description }}</td>
        </tr>
         <tr>
            <th>価格</th>
            <td>{{ $product->price }}</td>
        </tr>
    </table>
    
   {{-- 編集ページへのリンク --}}
    {!! link_to_route('products.edit', '編集', ['product' => $product->id], ['class' => 'btn btn-light']) !!}

    {{-- 削除フォーム --}}
    {!! Form::model($product, ['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection