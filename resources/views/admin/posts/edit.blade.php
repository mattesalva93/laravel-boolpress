@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1>Nuovo post</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">

                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="title">Titolo</label>
                        <input type="text" class="@error('title') is-invalid @enderror form-control" id="name" name="title"
                            value="{{ old('title') ?? $post->title }}" placeholder="Titolone bello">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="content">Contenuto</label>
                            <textarea class="@error('content') is-invalid @enderror form-control" id="content" name="content"
                                placeholder="Scrivi qui">{{ old('content') ?? $post->content }}</textarea>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Categoria</label>
                            <select class="form-control form-control-md" id="category_id" name="category_id">
                                <option value="">
                                    Modifica la categoria del post
                                </option>
                                @foreach ($categories as $elemento)
                                    <option value="{{ $elemento->id }}"
                                        {{ $elemento->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                                        {{ $elemento->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            Modifica i tags del tuo post
                        </div>
                        @foreach ($tags as $elemento)
                        <div class="form-check">
                            <input class="form-check-input"  id="{{$elemento->slug}}" type="checkbox" name="tags[]" value="{{$elemento->id}}" {{$post->tags->contains($elemento) ? " checked" : ""}}>
                            <label class="form-check-label" for="{{$elemento->slug}}">
                                {{$elemento->name}}
                            </label>
                          </div>
                        @endforeach
                        @if ($post->image != null)
                            <div>
                                <img src="{{ asset('storage/' . $post->image) }}" alt="">
                            </div>
                        @else
                            <div>
                                <img src="{{ asset('img/empty_image.jpg') }}" alt="">
                            </div>
                        @endif
                        <div class="form-group mt-3">
                            <label for="image">Modifica l'immagine dell tuo post</label>
                            <input type="file" name="image" class="@error('image') is-invalid @enderror form-control-file" id="image">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Modifica</button>
                        <div>
                            <a href="{{ route('admin.posts.index') }}">
                                <button type="button" class="btn btn-secondary mt-5">
                                    Ritorna all'elenco
                                </button>
                            </a>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
    @endsection
