@extends('layouts.app')

@section('content')

<h3>詳細ページ</h3>

    <table class="table">
        <tr>
            <th>画像</th>
            <td>{{ $product->image_file_name }}</td>
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
    
    <div class='container'>
        <div class="row">
            <div class="col-2">
                {{-- 編集ページへのリンク --}}
                {!! link_to_route('products.edit', '編集', ['product' => $product->id], ['class' => 'btn btn-outline-secondary btn-block']) !!}
            </div>
            　
            <div class="col-2">
                {{-- 削除フォーム --}}
                {!! Form::model($product, ['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                {!! Form::submit('削除', ['class' => 'btn btn-outline-danger btn-block']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        
    </div>
       


@endsection