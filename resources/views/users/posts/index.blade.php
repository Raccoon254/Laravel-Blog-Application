@extends('layouts.app')

@section('content')
    <div class="flex justify-center flex-wrap">
        <div class="flex flex-col w-full justify-center flex-wrap items-center">
        <div class="p-6 ">
            <h1 class="text-2xl font-medium mb-1">{{ $user->name }}</h1>
            <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and received {{ $user->receivedLikes->count() }} likes</p>
        </div>
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @if($posts->count())
                @foreach($posts as $post)
                    <div class="mb-3">
                        <a href="{{ route('users.posts',$post->user) }}" class="font-bold">{{$post->user->name}}</a> <span class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span><br>
                        @php

                            $post_decode = json_decode($post, true);
                            $body = $post_decode['body'];
                        @endphp

                        <a href="" class="font-bold">{{$body}}</a>

                        @auth
                            <div class="flex items-center">
                                @if(!$post->likedBy(auth()->user()))
                                    <form action="{{ route('posts.like', $post) }}" method="post" class="mr-1">
                                        @csrf
                                        <button type="submit" class="text-blue-500">Like</button>
                                    </form>
                                @else
                                    <form action="{{ route('posts.like' ,$post) }}" method="post" class="mr-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-blue-500">Dislike</button>
                                    </form>
                                @endif
                                @can('delete', $post)
                                    <form action="{{ route('posts.destroy', $post) }}" method="post" class="mr-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-blue-500">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        @endauth

                        <span>{{$post->likes->count()}} {{Str::plural('like', $post->likes->count())}}</span>

                    </div>
                @endforeach

                {{ $posts->links() }}
            @else
                <p>There are no posts</p>
            @endif
            <div>

            </div>
        </div>
    </div>
@endsection
