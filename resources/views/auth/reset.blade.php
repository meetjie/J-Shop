<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>管理员登陆 | wyshop</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="stylesheet" href="{{ asset('amaze/css/amazeui.min.css') }}"/>
  <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>
</head>
<body>
<div class="header">
  <div class="am-g">
    <h1>wyshop</h1>
    <p>長樂未央</p>
  </div>
  <hr />
</div>
<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <h3>找回密码</h3>
    <hr>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <form method="POST" action="/password/reset" class="am-form">
      {!! csrf_field() !!}
      <input type="hidden" name="token" value="{{ $token }}">

      <label for="email">邮箱:</label>
      <input type="email" name="email" id="email" value="{{ old('email') }}">

      <br>
      <label for="password">密码:</label>
      <input type="password" name="password" id="password">
      <br>

      <label for="password_confirmation">密码校验:</label>
      <input type="password" name="password_confirmation" id="password_confirmation">
      <br>
      <div class="am-cf">
        <input type="submit" name="" value="找找看" class="am-btn am-btn-primary am-btn-sm am-fl">
      </div>
    </form>
    <hr>
    <p>© Copyright 2013-2015 长乐未央公司版权所有</p>
  </div>
</div>
</body>
</html>
