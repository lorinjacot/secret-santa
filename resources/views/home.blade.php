<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Secret santa</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <h1>Inscription au secret santa</h1>
    <form action="{{ route('submit') }}" method="post">
        @csrf
        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <table>
            <tr>
                <td>
                    <label for="name">Ton nom</label>
                </td>
                <td>
                    <input type="text" name="name" id="name" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">Ton email</label>
                </td>
                <td>
                    <input type="email" name="email" id="email" required>
                </td>
            </tr>
        </table>
        <button type="submit">S'inscrire</button>
    </form>
</body>

</html>
