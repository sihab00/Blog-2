
<!doctype html>
<html lang="en">
  @include('partials._head')
  @yield('stylesheet')

  <body>
    <div class="container">
      @include('partials._header')
      @include('partials._message')
      @yield('jumbotron')
      <main role="main" class="container">
        <div class="row">
          <div class="col-md-8 blog-main">

            @yield('content')
          </div>
          
            @yield('aside')
        </div>
      </main>

      @include('partials/_footer')
      @yield('script')
    </div>
  </body>
</html>
