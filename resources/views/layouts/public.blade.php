<!DOCTYPE html>
<html translate="no">

<head>
  <meta name="google" content="notranslate">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    @yield('head')
    <title>Take a Quiz</title>
</head>
<style>
  body{
    background-image: url("{{asset('img/bg.png')}}");
  }
</style>
<body>
  @include('components.alerts')
    @yield('body')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    @yield('scripts')
</body>
@if(!request()->get('lightbox'))
<footer class="container" style="margin-top: 50px;">
    <div class="row">
      <div class="col md-6 lg-6 s12">
        Copyright © 2021 <strong>{{env('COMPANY_NAME')}}</strong> ∙ All rights reserved.
        <br>
        <small> <a href="#">Privacy Policy</a> - 
            <a href="#">Terms of Service</a></small> 
      </div>
      <div class="col md-6 lg-6 s12">
        <img src="{{env("LOGO")}}" class="float-end" style="width: 250px; max-width: 100%"/>
      </div>
    </div>
  </footer>
  @endif
</html>