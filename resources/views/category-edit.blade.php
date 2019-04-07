<!DOCTYPE html>
<html>
    <head>
        <title>Szerkesztés</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Kategória módosítása</div>
            </div>
            <form action="/category/{{$category->id}}" method="post">
                <input name="_method" type="hidden" value="PUT">
                <label for="name"></label>
                <input type="text" name="name" id="name" value="{{$category->name}}">
                <label for="is_expense"></label>
                <select name="is_expense" id="is_expense">
                    <option value="0" {{$category->is_expense == 0 ? "selected" : ""}}>Kiadás</option>
                    <option value="1"  {{$category->is_expense == 1 ? "selected" : ""}}>Bevétel</option>
                </select>
                <button type="submit">Kategória módosítása</button>
            </form>

        </div>
    </body>
</html>
<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
