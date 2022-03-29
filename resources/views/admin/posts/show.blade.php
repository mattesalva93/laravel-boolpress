@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ $post->title }}</h1>
                <p>{{ $post->content }}</p>
                <p> CATEGORIA: {{ $post->category ? $post->category->name : 'none' }}</p>
                <p> TAGS:
                    @foreach ($post->tags as $tag)
                        <i>{{ $tag->name }}</i>
                    @endforeach
                </p>
                @if ($post->image != null)
                    <div>
                        <img src="{{ asset('storage/' . $post->image) }}" alt="">
                    </div>
                @else
                    <div>
                        <img src="{{ asset('img/empty_image.jpg') }}" alt="">
                    </div>
                @endif

                <div class="mt-2">
                    <h5>Commenti in attesa</h5>
                    <table class="table">
                        <tbody>
                            @foreach ($post->comments as $elemento)
                                <tr>
                                    <td>{{ $elemento->testo }}</td>
                                    <td>
                                        @if (!$elemento->approvato)
                                            <form action="{{ route('admin.comments.update', $elemento->id) }}"
                                                method="post">
                                                @csrf
                                                @method("PATCH")
                                                <button type="submit" class="btn btn-success">Approva commento</button>
                                            </form>
                                        @else
                                            <span>Approvato</span>
                                        @endif
                                    </td>
                                    <td>
                                            <form action="{{ route('admin.comments.destroy', $elemento->id) }}"
                                                method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-danger">Cancella commento</button>
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('admin.posts.index') }}">
                    <button type="button" class="btn btn-secondary mt-5">
                        Ritorna all'elenco
                    </button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col mt-5">
                <h5>Rimuovi il post</h5>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">Rimuovi</button>
                </form>
            </div>
        </div>
    </div>
@endsection
