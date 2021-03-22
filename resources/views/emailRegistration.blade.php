<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
</head>
<body>

    <form method="post" action="{{ route('emailVerified', $user->id) }}">
        @csrf 
        <label> Click on link to verify </label> <br><br>
        <a href="{{ URL::route('emailVerified', $user->id) }}"> Verify </a>        
    </form>

</body>
</html>
