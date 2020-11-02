@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
        </aside>
        <div class="col-sm-8">
            {{-- タブ --}}
            @include('users.navtabs')
            {{--お気に入り一覧 --}}
    

@if (count($favorites) > 0)

    <ul class="list-unstyled">
        @foreach ($favorites as $favorite)
         <li class="media mb-3">
                {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
            
            <div class="media-body">
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $favorite->user->name, ['user' => $favorite->user->id]) !!}
                       <span class="text-muted">posted at {{ $favorite->created_at }}</span
            
                
                      {{-- お気に入り一覧 --}}
                       <p class="mb-0">{!! $favorite->content !!}</p>
                       
                @if (Auth::user()->is_favorite($favorite->id))
                {{-- お気に入り削除のフォーム --}}
                {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                {!! Form::submit('Unfavorite', ['class' => "btn btn-success btn-sm"]) !!}
                {!! Form::close() !!}
                 @else
                   {{-- お気に入り追加ボタンのフォーム --}}
                {!! Form::open(['route' => ['favorites.favorite', $favorite->id]]) !!}
                {!! Form::submit('Favorite', ['class' => "btn btn-secondary btn-sm"]) !!}
                  {!! Form::close() !!}
                 @endif
                    
                        @if (Auth::id() == $favorite->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['microposts.destroy', $favorite->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                
            </div>
        </li>
        @endforeach
    </ul>
    
@endif


@endsection
