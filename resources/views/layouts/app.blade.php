<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name')}} : @yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{ asset('css/test.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
  {{-- Request::server('HTTP_ACCEPT_LANGUAGE') --}}
  @php $locale = session()->get('locale'); @endphp
  <nav class="nav_test">
    <div>
      <span>FORUM</span>

    </div>




    <div class="">
      @guest
      <a class="" href="{{route('user.create')}}">@lang('lang.nav_registration')</a>
      <a class="" href="{{route('login')}}">@lang('lang.text_login')</a>
      @else
      <a class="" href="{{route('logout')}}">@lang('lang.nav_logout')</a>

      @endguest

    </div>


  </nav>

  <div class="body_content">
    <div class="side_nav">
      <h4 class="" href="#">Hello @if(Auth::check()) {{ Auth::user()->name }} @else guest @endif</h4>

      @guest

      @else
      <a class="" href="{{route('blog.index')}}">Forum</a>
      <a class="" href="{{route('repo.repository')}}">@lang('lang.nav_repo')</a>

      @endguest


      <a class=" @if($locale=='en') bg-secondary @endif" href="{{route('lang', 'en')}}"><i class="flag flag-united-states"></i></a>
      <a class=" {{ $locale == 'fr' ? 'bg-secondary' : '' }}" href="{{route('lang', 'fr')}}"><i class="flag flag-france"></i></a>
    </div>
    @yield('content')
  </div>

</body>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>

</html>