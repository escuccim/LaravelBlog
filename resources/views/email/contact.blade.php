<html>
<head></head>
<body>
<p>A Contact Me message was sent from skoo.ch:

<p>From: {{ $messageContent['name'] }} < {{ $messageContent['email'] }} >
<P>Body:<br>
{{ $messageContent['body'] }}
</body>
</html>