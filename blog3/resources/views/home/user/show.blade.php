@extends("home.layout.main")

@section("content")

    <div class="col-sm-8">
        <blockquote>
            <p><img src="{{$user->avatar}}" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{$user->username}}
            </p>


            <footer>关注：{{$user->star_count}}｜粉丝：{{$user->fans_count}}｜文章：{{$user->articles_count}}</footer>
            @include('home.user.badges.like', ['target_user' => $user])
        </blockquote>
    </div>
    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @foreach($posts as $post)
                        <div class="blog-post" style="margin-top: 30px">
                            <?php \Carbon\Carbon::setLocale('zh');?>
                            <p class=""><a href="/user/{{$post->user_id}}">{{$post->user->name}}</a> {{$post->created_at->diffForHumans()}}</p>
                            <p class=""><a href="/posts/{{$post->id}}" >{{$post->title}}</a></p>


                            <p>{!! $post->content !!}</p>
                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    @foreach($suser as $user)

                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$user->name}}</p>
                            <p class="">关注：{{$user->star_count}} | 粉丝：{{$user->fans_count}}｜ 文章：{{$user->articles_count}}</p>

                            @include('home.user.badges.like', ['target_user' => $user])
                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    @foreach($fuser as $fan)

                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$fan->name}}</p>
                            <p class="">关注：{{$fan->star_count}} | 粉丝：{{$fan->fans_count}}｜ 文章：{{$fan->articles_count}}</p>

                        @include('home.user.badges.like', ['target_user' => $fan])
                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>


    </div><!-- /.blog-main -->


@endsection
