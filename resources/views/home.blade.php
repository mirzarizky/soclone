@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-lg-12">
            <div class="my-3 card-deck row m-0 justify-content-center shadow">
                <div class="card-body text-center">
                    <h1 class="p-3 display-4">Larahub | Forum</h1>
                    <div class="links">
                        <a href="{{url('/')}}">Home</a>
                        <a href="{{url('/home')}}">Forum</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
        </div>
        <div class="col-lg-8">
            <div class="card-deck row m-0 justify-content-center shadow">
                <div class="card-body">
                    <h3>Daftar Pertanyaan.</h3>
                    <hr>

                    {{-- daftar pertanyaan --}}
                    @foreach ($questions as $question)

                    <h5>{{$question->title}}
                        <a href="/pertanyaan/{{$question->id}}/edit" class="badge badge-pill badge-primary"><i
                                class="far fa-edit"></i></a>
                        <form action="/pertanyaan/{{$question->id}}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge badge-pill badge-danger"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </h5>

                    <p>{{$question->content}}</p>
                    @foreach ($users as $user)
                    @if ($user->id == $question->user_id)
                    <p class="text-muted">By {{ $user->name }}, {{$question->created_at->format('D M Y, H:i')}}</p>
                    @endif

                    {{-- daftar komentar pertanyaan --}}
                    <a data-toggle="collapse" data-target="#collapse_komentar_pertanyaan{{$question->id}}" aria-expanded="false"
                        aria-controls="collapse_komentar_pertanyaan{{$question->id}}"><i class="btn btn-warning far fa-comment"></i></a>

                        <div class="collapse" id="collapse_komentar_pertanyaan{{$question->id}}">

                            {{-- form --}}
                            <form method="POST" action="/answer">
                                @csrf
                                <div class="form-group">
                                    <label for="content">Isi Komentar</label>
                                    <input type="text" name="question_id" value="{{$question->id}}" hidden>
                                    <input type="text" name="user_id" value="{{$user->id}}" hidden>
                                    <input type="text" class="form-control  @error('content') is-invalid @enderror "
                                        id="content" name="content" placeholder="Masukan komentar dari pertanyaan!">

                                    @error('content')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror

                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Komentari Pertanyaan!</button>
                            </form>
                        </div>


                    @endforeach

                    {{-- daftar jawaban --}}
                    <h6 class="text-right">- Jawaban -</h6>

                    @foreach ($answers as $answer)
                    @if ($answer->question_id == $question->id)
                    <p class="text-muted text-right blockquote-footer">{{$answer->content}} - at
                        {{$question->created_at->format('D M Y')}} By {{Auth::user()->name}}</p>

                    <a href="/jawaban/{{$answer->id}}/edit" class="badge badge-pill badge-primary"><i
                            class="far fa-edit"></i></a>
                    <form action="/jawaban/{{$answer->id}}" method="POST" class="d-inline">
                        <span>
                            @method('delete')
                            @csrf
                            <button class="badge badge-pill badge-danger text-right"><i
                                    class="far fa-trash-alt"></i></button>
                        </span>
                    </form>

                    {{-- daftar komentar jawaban --}}
                    <p><i class="btn btn-warning far fa-comment"></i></p>

                    <hr>

                    @endif
                    @endforeach

                    {{-- membuat jawaban --}}

                    <div class="text-right mt-3">
                        <button class="btn btn-success btn-sm" type="button" data-toggle="collapse"
                            data-target="#collapse{{$question->id}}" aria-expanded="false"
                            aria-controls="collapse{{$question->id}}">
                            Jawab Pertanyaan!
                        </button>
                        </p>
                        <div class="collapse" id="collapse{{$question->id}}">

                            {{-- form --}}
                            <form method="POST" action="/answer">
                                @csrf
                                <div class="form-group">
                                    <label for="content">Isi Jawaban</label>
                                    <input type="text" name="question_id" value="{{$question->id}}" hidden>
                                    <input type="text" name="user_id" value="{{$user->id}}" hidden>
                                    <input type="text" class="form-control  @error('content') is-invalid @enderror "
                                        id="content" name="content" placeholder="Masukan jawaban kamu!">

                                    @error('content')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror

                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Jawab Pertanyaan!</button>
                            </form>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-deck row m-0 justify-content-center shadow">
                <div class="card-body">

                    {{-- membat pertanyaan --}}
                    <h3>Buat Pertanyaan.</h3>

                    {{-- form --}}
                    <form method="POST" action="/question">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul Pertanyaan</label>
                            <input type="text" class=" @error('title') is-invalid @enderror form-control" id="title"
                                name="title" placeholder="Masukan title Pertanyaan" value="{{old('title')}}">
                            @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Isi Pertanyaan</label>
                            <textarea type="text" class="form-control  @error('content') is-invalid @enderror "
                                id="content" name="content" placeholder="Masukan Pertanyaan kamu!"
                                value="{{old('content')}}"></textarea>
                            @error('content')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <input type="text" name="user_id" id="" value="{{Auth::user()->id}}" hidden>
                        <button type="submit" class="btn btn-primary">Buat Pertanyaan!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
