<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Scripts -->
  <script type="text/javascript" src="{{ secure_asset('js/app.js') }}"></script>
  <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet" type="text/css">
  <style>@import url("https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap");@import url("https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200;300;400;500;600;700;900&display=swap");@import url("https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap");:root{--color-blue: #001e62;--color-red: #ef8200;--color-yellow: #c63527;--color-gray: #222;--font-content: 'Noto Sans JP', sans-serif;--font-text: 'Noto Sans JP', sans-serif;--font-custom: 'Noto Serif JP', serif;--font-title: 'Libre Baskerville', serif;--background-rgba: linear-gradient(90.07deg, #F68121 -0.48%, #F86E54 100.22%)}html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after{content:'';content:none}q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}*{margin:0;padding:0;box-sizing:border-box}body,html{font-size:16px;font-family:var(--font-text)}a{text-decoration:none !important}img,a{transition:all .3s}button,img,input,select{outline:none !important}.clearfix:after{content:"";clear:both;display:block}.clear{clear:both;background-image:linear-gradient(to right, transparent, rgba(255,255,255,0.5), transparent)}@media screen and (device-aspect-ratio: 2 / 3){select,textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"]{font-size:16px}}@media screen and (device-aspect-ratio: 40 / 71){select,textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"]{font-size:16px}}@media screen and (device-aspect-ratio: 375 / 667){select,textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="tel"],input[type="url"]{font-size:16px}}@media screen and (device-aspect-ratio: 9 / 16){select,textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="tel"],input[type="url"]{font-size:16px}}.container{max-width:1200px;padding:0px 15px;margin:0 auto;position:relative;width:100%}.container-fluid{padding:0px 50px}.header{padding:30px 0px;border-bottom:1px solid #333}.header .logo{display:flex;align-items:center}.header .logo img{width:305px}.header .btn-custom{padding:5px 20px;border-radius:30px;border:1px solid #333;text-align:center;text-transform:uppercase;font-size:16px;color:#333;margin-left:30px;background:#f9fafc}.header .btn-custom:hover{background:#333;color:#fff}.footer{padding:20px 0px;background:#000;font-size:16px;text-align:center;color:#fff}.footer p{margin-bottom:0;text-align:center}.container-main{display:flex;min-height:100vh;flex-direction:column}.container-main .main{flex:1;display:flex;align-items:center;background:#f9fafc}.form{max-width:565px;width:100%;border:1px solid #333;border-radius:20px;padding:100px 50px;background:#fff;margin:0 auto}.form .logo{margin-bottom:30px;text-align:center}.form .logo img{max-width:300px;margin:0 auto}.form .form-group{margin-bottom:15px}.form .form-group label{display:block;font-size:16px;color:#333;margin-bottom:10px}.form .form-group input{height:45px;border:1px solid #333;padding-left:15px;font-size:16px;width:100%;outline:none;border-radius:5px}.form .form-group .btn-custom{height:50px;background:#333;line-height:50px;text-align:center;color:#fff;font-weight:bold;font-size:18px;display:block;width:100%;border:0;outline:none;cursor:pointer;border-radius:5px;margin-top:30px;transition:all .3s}.form .form-group .btn-custom:hover{transform:scale(1.05)}</style>
  @yield('style')
</head>
<body>
  <div id="app" class="container-main">
    @yield('nav-top')
    <main class="main py-4">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <nav class="navbar bg-dark text-white">
              <div class="container-fluid @yield('class')">
                <a class="navbar-brand text-white">@yield('title')</a>
              </div>
            </nav>
          </div>
        </div>
      </div>
      @yield('main')
    </main>
    @yield('nav-footer')
  </div>
  @yield('script')
  @yield('script-ct')
  <script>
    $(function () {
      $(".submenu").hide();
      $(".parent").click(function (e) {
          e.preventDefault();
          $(".submenu", this).toggle();
      });
    });
  </script>
</body>
</html>
