@extends('layout')
@section('content')

<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
    <div class="page-wrapper">
        <div class="blog-title-area text-center">
            <ol class="breadcrumb hidden-xs-down">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                <li class="breadcrumb-item">{{ $post->category->name}}</li>
                <li class="breadcrumb-item active">{{ $post->title}}</li>
            </ol>
            <span class="color-orange"><a href="{{route('categories.show',$post->category)}}">{{ $post->category->name}}</a></span>
            <h3>{{ $post->title}}</h3>
            <div class="blog-meta big-meta">
                <small>{{optional($post->published_at)->format('d M Y')}}</small>
                <small>by OHSD</small>
            </div><!-- end meta -->
        </div><!-- end title -->
        <div class="single-post-media">
            <img src="/storage/{{$post->photos->first()?$post->photos->first()->url:''}}" alt="" class="img-fluid">
        </div><!-- end media -->
        <div class="blog-content">
            <div class="pp" style="text-align:justify">
                {!! $post->body!!}
            </div><!-- end pp -->
        </div><!-- end content -->
        <div class="blog-title-area">
            <div class="tag-cloud-single">
                <span>Tags</span>
                @foreach ($post->tags as $tag )
                <small>#{{ $tag->name}}</small>
                @endforeach
            </div><!-- end meta -->
            <div class="post-sharing">
                <ul class="list-inline">
                    <li><a href="http://www.facebook.com/sharer.php?u={{ request()->fullurl()}}" class="fb-button btn btn-primary"><i class="fab fa-facebook"></i> <span class="down-mobile">Compartir en Facebook</span></a></li>
                    <li><a href="https://twitter.com/intent/tweet?url={{ request()->fullurl()}}&text={{$post->title}}&via={{"OHSD"}}&hashtags={{"OHSD"}}" class="tw-button btn btn-primary"><i class="fab fa-twitter"></i> <span class="down-mobile">Compartir en Twitter</span></a></li>
                </ul>
            </div><!-- end post-sharing -->
        </div><!-- end title -->
        <hr class="invis1">
        <div class="custombox authorbox clearfix">
            <h2 class="small-title">Author</h2>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <img src="upload/author.jpg" alt="" class="img-fluid rounded-circle">
                </div><!-- end col -->
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <h4>OHSD</h4>
                    <p>El Observatorio Hondureño sobre Drogas (OHSD) es la entidad que organiza, recopila y coordina estadísticas y otra información relacionada con las drogas.</p>
                    <!-- <div class="topsocial">
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                    </div>end social -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end author-box -->
        <hr class="invis1">
        <div class="custombox clearfix">
            <h4 class="small-title">{{$post->comments->count()}} Comentarios</h4>
            <div class="row">
                <div class="col-lg-12">
                    <div class="comments-list">
                        @foreach ($post->comments as $comment )
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading user_name">{{$comment->autor}}<small>{{$comment->created_at->format('M d Y')}}</small></h4>
                                <p>{{$comment->body}}.</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end custom-box -->
        <hr class="invis1">
        <div class="custombox clearfix">
            <h4 class="small-title">Agrega tu comentario</h4>
            <div class="row">
                @include('admin.partials.error-messages')
                <div class="col-lg-12">
                    <form action="{{ route('comments.store')}}" method="POST" class="form-wrapper">
                        {{ csrf_field() }}
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <input type="hidden" name="email" value="{{$post->autor->email}}">
                        <input type="text" name="autor" value="{{old('autor')}}" class="form-control" placeholder="Nombre">
                        <input type="email"  name="autor_email" value="{{old('autor_email')}}" class="form-control" placeholder="Correo">
                        <textarea name="body" class="form-control" placeholder="Comentario">{{old('body')}}</textarea>
                        <button type="submit" class="btn btn-primary">Enviar comentario</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- end page-wrapper -->
</div><!-- end col -->

@endsection
