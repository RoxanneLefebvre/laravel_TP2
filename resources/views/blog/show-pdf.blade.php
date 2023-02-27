<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=h3, initial-scale=1.0">
    <title>Document</title>
    <style>
        p{
            text-align: justify;
        }
    </style>
</head>
<body>
    <h3>{{$blogPost->title}}</h3>
    <p>{!! $blogPost->body !!}</p>
    <strong><span>Categorie :</strong> @isset($blogPost->blogHasCategorie) {{ $blogPost->blogHasCategorie->categorie }} @endisset</span>
    <strong><span> author :</strong> {{ $blogPost->blogHasUser->name }}</span>
</body>
</html>