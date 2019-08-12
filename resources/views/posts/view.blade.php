@extends('layouts.app')
<style type="text/css">
.avatar{
    border-radius:100%;
    width:200px;
    height:200px;
}
img{
 height:250px;
 weidth:350px;
}
.comment{
    background-color: lightgrey;
}
.border{
    padding:5px;
    border: 3px solid black;
}


</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
        @if(session('response'))
        <div class="alert alert-success">{{session('response')}}
        </div>
        @endif
            <div class="card">
                <div class="card-header">Post View</div>

                <div class="card-body row">
            
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <div class="col-md-4">
                   <ul class="list-group">
                 @if(count($categories)>0)
                 @foreach($categories->all() as $category)
                 <li class="list-group-item"><a href="{{url('/category',$category->id)}}">{{ $category->category}}</a>
                 </li>
                 @endforeach
                 @else
                 <p>No category found</p>
                 @endif
                </ul>
                   </div>
                   <div class="col-md-8">
                   @if(count($posts)>0)
                     @foreach($posts->all() as $post)
                       <h4>{{$post->post_title}}</h4>
                       <img src="{{$post->post_image}}" alt="">
                       <p>{{ $post->post_body }}</p>

                       <ul class="nav nav-pills">
                       <li role="presentation">
                       <a href="{{ url('/like',$post->id) }}">
                       <span class="far fa-thumbs-up" aria-hidden="true"> Like {{$likeCtr}}</span>
                       </a>
                       </li>
                       <li role="presentation">
                       <a href="{{ url('/dislike',$post->id) }}">
                      &nbsp &nbsp<span class="far fa-thumbs-down" aria-hidden="true"> Dislike {{$dislikeCtr}}</span>
                       </a>
                       </li>
                       <li role="presentation">
                       <a href="{{ url('/comment',$post->id ) }}">
                      &nbsp &nbsp<span class="far fa-comment-dots" aria-hidden="true"> Comment</span>
                       </a>
                       </li>
                       </ul>
                     @endforeach
                     @else
                     <p>NO Post Availabe</p>
                   @endif
                   <form method="POST" action="{{ url('/comment',$post->id ) }}" >
                   @csrf
                   <div class="form-group">
                   <textarea id="comment" rows="6" class="form-control" name="comment" requires autofocus></textarea>
                   </div>
                   <div class="form-group">
                   <button type="submit" class="btn btn-success btn-lg btn-block">POST COMMENT</button>
                   </div>
                   </form>
                   <h3>comments</h3>
                   <div class="border">
                   @if(count($comments)>0)
                     @foreach($comments->all() as $comment)
                     
                     <h5>{{$comment->name}}</h5>
                   <p class="comment">{{$comment->comment}}</p>
                   
                   <hr/>
                   
                     @endforeach
                     @else
                     <p>NO Comments Availabe</p>
                   @endif
                   
                   </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection