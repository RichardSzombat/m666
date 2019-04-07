<!DOCTYPE html>
<html>
    <head>
        <title>Test1</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Új kategória felvétele</div>
            </div>
            <form action="/category" method="post">
                <label for="name"></label>
                <input type="text" name="name" id="name">
                <label for="is_expense"></label>
                <select name="is_expense" id="is_expense">
                    <option value="0">Kiadás</option>
                    <option value="1">Bevétel</option>
                </select>
                <button type="submit">Kategória felvétele</button>
            </form>
            <hr>
            <div class="content">
                <div class="title">Kategóriák</div>
            </div>
            <table style="border: 1px solid black;">
                <tr>
                    <th>Név</th>
                    <th>Bevétel/Kiadás</th>
                    <th>Törlés</th>
                    <th>Szerkesztés</th>
                </tr>
                @foreach($categories as $category)
                <tr class="category-{{$category->id}}">
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->is_expense ? "Bevétel" : "Kiadás" }}</td>
                    <td><button type="button" value="{{ $category->id }}" class="category-delete">Törlés</button></td>
                    <td><a href="/category/{{$category->id}}/edit"><button type="button" > Szerkesztés</button></a></td>
                </tr>
                @endforeach
            </table>
            <hr>
            <div class="content">
                <div class="title">Új tétel felvétele</div>
            </div>
            <form action="/item" method="post">
                <label for="name"></label>
                <input type="text" name="name" id="name">
                <input type="hidden" name="time" id="time" value="<?php echo date('Y-m-d H:i');?>">
                <label for="category_id"></label>
                <select name="category_id" id="category_id">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <input type="number" name="value" id="value">
                <button type="submit">Tétel felvétele</button>
            </form>
            <hr>
            <div class="content">
                <div class="title">Tételek</div>
            </div>
            <table style="border: 1px solid black;">
                <tr>
                    <th>Név</th>
                    <th>Idő</th>
                    <th>Összeg</th>
                    <th>Kategória id</th>
                    <th>Törlés</th>
                </tr>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->time }}</td>
                        <td>{{ $item->value  }}</td>
                        <td>{{ $item->category_id }}</td>
                        <td><button type="button" value="{{ $item->id }}" class="item-delete">Törlés</button></td>
                    </tr>
                @endforeach
            </table>
            <hr>
        </div>
    </body>
</html>
<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script>
    function deleteRequest($type){
        let id = $(this).attr('value');
        $.ajax({
            url: '/'+$type+'/'+id,
            method: 'DELETE',
            success: function () {
            }

        })
    }
    $(document).ready(function () {
        $('.item-delete').on('click',function () {
            let id = $(this).attr('value');
            $.ajax({
                url: '/item/'+id,
                method: 'DELETE',
                success: function () {
                    window.location.replace("/category");
                }

            })
        });
        $('.category-delete').on('click',function () {
            let id = $(this).attr('value');
            $.ajax({
                url: '/category/'+id,
                method: 'DELETE',
                success: function () {
                    window.location.replace("/category");
                }

            })
        });
        $('.category-update').on('click',function () {
            let id = $(this).attr('value');
            $.ajax({
                url: '/category/'+id,
                method: 'PATCH',
                data: $('.category-'+id).serialize(),
                success: function () {
                    window.location.replace("/category");
                }

            })
        })
    })
</script>
