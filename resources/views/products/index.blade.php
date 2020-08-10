@extends('layouts.app')

@section('content')

<h3>商品一覧</h3>

    @if (count($products) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>画像</th>
                    <th>商品名</th>
                    <th>説明</th>
                    <th>価格</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->image_file_name }}</td>
                    <td>{!! link_to_route('products.show', $product->content, ['product' => $product->id]) !!}</td>
                    <td>{{ $product->description }}</td>
                    <td>¥{{ $product->price }}</td>
                    <td>            
                         {{-- 編集ページへのリンク --}}
                         {!! link_to_route('products.edit', '編集', ['product' => $product->id], ['class' => 'btn btn-outline-secondary btn-block']) !!}
            
            　　　　　　　　     {{-- 削除フォーム --}}
                         {!! Form::model($product, ['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                             {!! Form::submit('削除', ['class' => 'btn btn-outline-danger btn-block']) !!}
                         {!! Form::close() !!}
                    </td>
                    
                </tr>
    
                @endforeach
            </tbody>
        </table>
    @endif
    
    {!! link_to_route('products.create', '商品を追加', [], ['class' => 'btn btn-primary'])!!}

@endsection