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
</style>
<script>
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}
</script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
        @if(session('response'))
        <div class="alert alert-success">{{session('response')}}
        </div>
        @endif
            <div class="card">
                <div class="card-header">
                <div class="row">
                <div class="col-md-4">Dashboard</div>
                <div class="col-md-8">
                <form methos="POST" action='{{url("/search")}}'>
                @csrf
                <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="search">
                <span class="input-group-btn">
                <button type="submit" class="btn btn-default">Go</button>
                </span>
                </div>
                </form>
                </div>
                </div>
                </div>

                <div class="card-body row">
            
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <div class="col-md-4">
                   @if(!empty($profile))
                   <img src="{{$profile->profile_pic}}" class="avatar" alt="Avatar">
                   @else
                   <img src="{{url('images/avatar.jpg')}}" class="avatar" alt="Avatar">
                   @endif
                   @if(!empty($profile))
                   <p class="lead">{{$profile->name}}</p>
                   @else
                   <p class="lead"></p>
                   
                   @endif
                   @if(!empty($profile))
                   <p>{{$profile->designation}}</p>
                   @else
                   <p></p>
                   
                   @endif
                   </div>
                   <div class="col-md-8">
                   @if(count($posts)>0)
                     @foreach($posts->all() as $post)
                       <h4>{{$post->post_title}}</h4>
                       <img src="{{ $post->post_image }}" alt="">
                       
                       <p>{{ substr($post->post_body,0,150) }}....</p>
                       

                       <ul class="nav nav-pills">
                       <li role="presentation">
                       <a href="{{ url('/view',$post->id) }}">
                       <span class="fa fa-eye" aria-hidden="true"> View</span>
                       </a>
                       </li>
                       @if(Auth::id()==1)
                       <li role="presentation">
                       <a href="{{ url('/edit',$post->id) }}">
                       &nbsp &nbsp<span class="fas fa-edit" aria-hidden="true"> Edit</span>
                       </a>
                       </li>
                       <li role="presentation">
                       <a href="{{ url('/delete',$post->id) }}">
                       &nbsp &nbsp<span class="fas fa-trash" aria-hidden="true"> Delete</span>
                       </a>
                       </li>
                       @endif
                       </ul>
                       <cite style="float:left">Posted on:{{date('M j,Y H:i',strtotime($post->updated_at))}}</cite>
                       <hr/>
                     @endforeach
                     @else
                     <p>NO Post Availabe</p>
                   @endif
                   
                 
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
