<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <h3>{{$article->title}}</h3>
    <small>Created at: {{date('l jS \of F Y h:i:s A', strtotime($article->created_at))}}</small>
    <small>By {{$article->author->name}}</small>

    <div style="margin:15px 0">{{$article->body}}</div>
</body>
</html>

