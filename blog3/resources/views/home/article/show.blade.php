@extends("home.layout.main")

@section("content")


    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display:inline-flex">
                <h2 class="blog-post-title">{{$article->title}}</h2>
                @if (auth()->user()->can('update', $article))
                    <a style="margin: auto" href="/article/{{$article->id}}/edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                @endif
                @if (auth()->user()->can('delete', $article))
                    <form action="/article/{{$article->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="glyphicon glyphicon-remove" style="border: none;background: none"
                                aria-hidden="true"></button>

                    </form>
                @endif
            </div>

            <p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}} by <a
                    href="/user/{{$article->user->id}}">{{$article->user->username}}</a></p>

            <p>{!! $article->content !!}</p>
            <div>
                @if($article->zan(auth()->id())->exists())
                    <a href="/article/{{$article->id}}/unzan" type="button" class="btn btn-default btn-lg">取消赞</a>
                @else
                    <a href="/article/{{$article->id}}/zan" type="button" class="btn btn-primary btn-lg">赞</a>
                @endif

            </div>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>

            <!-- List group -->
            <ul class="list-group">
                @foreach($article->comment as $comment)
                    <li class="list-group-item">
                        <h5>{{$comment->created_at}} by {{$comment->user->username}}</h5>
                        <div>
                            {{$comment->content}}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">发表评论</div>

            <!-- List group -->
            <ul class="list-group">
                <form action="/article/{{$article->id}}/comment" method="post">
                    @csrf
                    <input type="hidden" name="article_id" value="{{$article->id}}"/>
                    <li class="list-group-item">
                        <textarea name="content" class="form-control" rows="10"></textarea>
                        @include('home.layout.error')
                        <button class="btn btn-default" type="submit">提交</button>
                    </li>
                </form>

            </ul>
        </div>

    </div><!-- /.blog-main -->



@endsection
