<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8">
  <title>webrtc ex</title>
</head>
<body>
<h1>흠</h1>
<div id="videos">
    <video id="localVideo" autoplay muted></video>
    <video id="remoteVideo" autoplay></video>
</div>
  {{--<script src="{{ asset('js/photo.js') }}"></script>--}}
 <script src="http://{{ Request::getHost() }}:8000/socket.io/socket.io.js"></script>
 <script src="{{ asset('js/lib/adapter.js')}}"></script>
 <script src="{{ asset('js/main.js')}}"></script>
</body>
</html>
