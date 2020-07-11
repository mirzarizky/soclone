@extends('layouts.app')

@push('script-head')

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

@endpush

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

            @if(session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
            @endif
        </div>
        <div class="col-lg-8">
            <div class="card-deck row m-0 justify-content-center shadow mb-3">
                <div class="card-body">
                    <h3>Daftar Pertanyaan.</h3>
                </div>
            </div>
            {{-- daftar pertanyaan --}}
            @foreach ($questions as $question)
            <div class="card-deck row m-0 justify-content-center shadow my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-1">
                            {{-- untuk vote --}}

                            <div class="quantity">
                                <input type="number" data-vote="question" data-id="{{$question->id}}" disabled min="1" max="100" step="1" value="{{ $question->vote_point() }}">
                            </div>
                            <form id="vote-question-up-{{$question->id}}" action="{{ route('question.vote', $question) }}" method="post">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <form id="vote-question-down-{{$question->id}}" action="{{ route('question.vote', $question) }}" method="post">
                                @csrf
                                <input type="hidden" name="vote" value="0">
                            </form>
                        </div>
                        <div class="col-sm-11">
                            <h4>{{$question->title}} <br>
                                @if ($question->user_id == Auth::user()->id)

                                <a href="/pertanyaan/{{$question->id}}/edit" class="btn btn-sm btn-primary"><i
                                        class="far fa-edit"></i></a>
                                <form action="/pertanyaan/{{$question->id}}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                                </form>
                                @endif
                            </h4>
                            <div class="my-2">
                                @foreach ($question->tags as $tag)
                                    <span class="bg-success px-2 py-1 rounded-sm text-white">{{$tag->name}}</span>
                                @endforeach
                            </div>
                            {{-- <p>{{$question->content}}</p> --}}

                            <p>{!! $question->content !!}</p>
                   
                            @foreach ($users as $user)
                            @if ($user->id == $question->user_id)
                            <p class="text-muted">By {{ $user->name }}, {{$question->created_at->format('D M Y, H:i')}}
                            </p>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <h6 class="text-left">- Komentar Pertanyaannya -<a data-toggle="collapse"
                            data-target="#collapse_komentar_pertanyaan{{$question->id}}" aria-expanded="false"
                            aria-controls="collapse_komentar_pertanyaan{{$question->id}}"><i
                                class="btn btn-warning far fa-comment"></i></a></h6>

                    {{-- daftar komentar pertanyaan --}}

                    @foreach ($questComents as $questComent)
                    @if ($questComent->question_id == $question->id)
                    <p class="text-muted text-left blockquote-footer">{!! $questComent->content !!} - at
                        {{$question->created_at->format('D M Y')}} By @foreach ($users as $user)
                        @if ($user->id == $questComent->user_id)
                        {{$user->name}}
                        @endif
                        @endforeach</p>
                    @if ($questComent->user_id == Auth::user()->id)
                    <div></div>
                    <a href="/questionComment/{{$questComent->id}}/edit" class="btn btn-sm btn-primary"><i
                            class="far fa-edit"></i></a>
                    <form action="/questionComment/{{$questComent->id}}" method="POST" class="d-inline">
                        <span>
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-danger text-right"><i class="far fa-trash-alt"></i></button>
                        </span>
                    </form>
                    @endif
                    @endif
                    @endforeach
                    <div class="collapse" id="collapse_komentar_pertanyaan{{$question->id}}">

                        {{-- form --}}
                        <form method="POST" action="/questionComment">
                            @csrf
                            <div class="form-group">
                                <label for="content">Isi Komentar</label>
                                <input type="text" name="question_id" value="{{$question->id}}" hidden>
                                <input type="text" name="user_id" value="{{Auth::user()->id}}" hidden>
                                {{-- <input type="text" class="form-control  @error('content') is-invalid @enderror "
                                    id="content" name="content" placeholder="Masukan komentar dari pertanyaan!"> --}}
                                <textarea type="text" class="form-control my-editor  @error('content') is-invalid @enderror "
                                    id="content" name="content" placeholder="Masukan komentar dari pertanyaan!"
                                    value="{{old('content')}}">{!! old('content') !!}</textarea>

                                @error('content')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror

                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Komentari Pertanyaan!</button>
                        </form>
                    </div>
                    <hr>

                    {{-- daftar jawaban --}}
                    <h3 class="text-right">- Jawaban -</h3>
                    @foreach ($answers as $answer)
                    @if ($answer->question_id == $question->id)
                    {{-- <p class="text-muted text-right blockquote-footer">{!! $answer->content !!} - at
                        {{$question->created_at->format('D M Y')}} By {{$user->name}}</p> 
                    
                    (backup)--}} 

                    <div class="quantity">
                        <input type="number" data-vote="answer" data-id="{{$answer->id}}" disabled min="1" max="100" step="1" value="{{ $answer->vote_point() }}">
                    </div>
                    <form id="vote-answer-up-{{$answer->id}}" action="{{ route('answer.vote', $answer) }}" method="post">
                        @csrf
                        <input type="hidden" name="vote" value="1">
                    </form>
                    <form id="vote-answer-down-{{$answer->id}}" action="{{ route('answer.vote', $answer) }}" method="post">
                        @csrf
                        <input type="hidden" name="vote" value="0">
                    </form>
                    <h5 class="text-right">{!! $answer->content !!} - at
                        {{$question->created_at->format('D M Y')}} By @foreach ($users as $user)
                        @if ($user->id == $answer->user_id)
                        {{$user->name}}
                        @endif
                        @endforeach</p>
                    </h5>
                    @if ($answer->user_id == Auth::user()->id)
                    <a href="/jawaban/{{$answer->id}}/edit" class="btn btn-sm btn-primary"><i
                            class="far fa-edit"></i></a>
                    <form action="/jawaban/{{$answer->id}}" method="POST" class="d-inline">
                        <span>
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-danger text-right"><i class="far fa-trash-alt"></i></button>
                        </span>
                    </form>

                    @endif



                    {{-- daftar komentar jawaban --}}
                    
                    {{-- <a data-toggle="collapse" data-target="#collapse_komentar_jawaban{{$question->id}}"
                        aria-expanded="false" aria-controls="collapse_komentar_jawaban{{$question->id}}"><i
                            class="btn btn-warning far fa-comment"></i></a>
                            <br> --}}

                            {{-- <h6 class="text-right">- Komentar Jawabannya -</h6> --}}


                            {{-- @foreach ($answerComents as $answerComent)
                            @if ($answerComent->answer_id == $answer->id)
                            <p class="text-muted text-right blockquote-footer pt-3">{!! $answerComent->content !!} - at
                                {{$answerComent->created_at->format('D M Y')}} By {{$user->name}}</p>
        
                            <a href="/answerComment/{{$answerComent->id}}/edit" class="btn btn-sm btn-primary"><i
                                    class="far fa-edit"></i></a>
                            <form action="/answerComment/{{$answerComent->id}}" method="POST" class="d-inline">
                                <span>
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-danger text-right"><i class="far fa-trash-alt"></i></button>
                                </span>
                            </form>
                            @endif
                            @endforeach --}}


                    <h6 class="text-right"><a data-toggle="collapse"
                            data-target="#collapse_komentar_jawaban{{$answer->id}}" aria-expanded="false"
                            aria-controls="collapse_komentar_jawaban{{$answer->id}}"><i
                                class="btn btn-warning far fa-comment"></i></a> - Komentar Jawabannya -</h6>


                    @foreach ($answerComents as $answerComent)
                    @if ($answerComent->answer_id == $answer->id)
                    <p class="text-muted text-right blockquote-footer">{!! $answerComent->content !!} - at
                        {{$answerComent->created_at->format('D M Y')}} By @foreach ($users as $user)
                        @if ($user->id == $answerComent->user_id)
                        {{$user->name}}
                        @endif
                        @endforeach</p>

                    @if ($answerComent->user_id == Auth::user()->id)
                    <a href="/answerComment/{{$answerComent->id}}/edit" class="btn btn-sm btn-primary"><i
                            class="far fa-edit"></i></a>
                    <form action="/answerComment/{{$answerComent->id}}" method="POST" class="d-inline">
                        <span>
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-danger text-right"><i class="far fa-trash-alt"></i></button>
                        </span>
                    </form>
                    @endif


                    @endif
                    @endforeach

                    <div class="collapse text-right pb-3" id="collapse_komentar_jawaban{{$answer->id}}">

                        {{-- form --}}
                        <form method="POST" action="/answerComment">
                            @csrf
                            <div class="form-group">
                                <label for="content">Isi Komentar</label>
                                <input type="text" name="answer_id" value="{{$answer->id}}" hidden>
                                <input type="text" name="user_id" value="{{Auth::user()->id}}" hidden>
                                {{-- <input type="text" class="form-control  @error('content') is-invalid @enderror "
                                    id="content" name="content" placeholder="Masukan komentar dari Jawaban!"> --}}
                                <textarea type="text" class="form-control my-editor  @error('content') is-invalid @enderror "
                                    id="content" name="content" placeholder="Masukan komentar dari jawaban!"
                                    value="{{old('content')}}">{!! old('content') !!}</textarea>
    
                                @error('content')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror

                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Komentari Jawaban!</button>
                        </form>
                    </div>


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
                                    <input type="text" name="user_id" value="{{Auth::user()->id}}" hidden>
                                    {{-- <input type="text" class="form-control  @error('content') is-invalid @enderror "
                                        id="content" name="content" placeholder="Masukan jawaban kamu!"> --}}
                                    <textarea type="text" class="form-control my-editor  @error('content') is-invalid @enderror "
                                        id="content" name="content" placeholder="Masukan jawaban kamu!"
                                        value="{{old('content')}}">{!! old('content') !!}</textarea>

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
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-lg-4">
            <div class="card-deck row m-0 justify-content-center shadow">
                <div class="card-body">

                    {{-- membuat pertanyaan --}}
                    <h3>Buat Pertanyaan.</h3>

                    {{-- form --}}
                    <form method="POST" action="/question">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul Pertanyaan</label>
                            <input type="text" class=" @error('title') is-invalid @enderror form-control" id="title"
                                name ="title" placeholder="Masukan title Pertanyaan" value="{{old('title')}}" required>
                            @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Isi Pertanyaan</label>
                            <textarea type="text" class="form-control my-editor @error('content') is-invalid @enderror "
                                id="content" name="content" placeholder="Masukan Pertanyaan kamu!" 
                                value="{{old('content')}}">{!! old('content') !!}</textarea>  {{--required rows="3"--}}
                            @error('content')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Tag Pertanyaan</label>
                            <textarea type="text" class="form-control @error('content') is-invalid @enderror"
                                id="tag" name="tags" placeholder="Masukan Tag Pertanyaan kamu! (Pisahkan dengan spasi)" required>{{ old('tags') }}</textarea>
                            @error('tags')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <input type="hidden" name="user_id" id="" value="{{Auth::user()->id}}">
                        <button type="submit" class="btn btn-primary">Buat Pertanyaan!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var editor_config = {
      path_absolute : "/",
      selector: "textarea.my-editor",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
  
        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }
  
        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };
  
    tinymce.init(editor_config);
</script>

<script>
    $(document).ready(function() {
        $('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
        $('.quantity').each(function() {
            var spinner = $(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');


            btnUp.click(function() {
                var model = spinner.find('input').data('vote');
                var modelId = spinner.find('input').data('id');
                $(`#vote-${model}-up-${modelId}`).submit();
            });

            btnDown.click(function() {
                var model = spinner.find('input').data('vote');
                var modelId = spinner.find('input').data('id');
                $(`#vote-${model}-down-${modelId}`).submit();
            });
        });
    });
</script>
@endpush
