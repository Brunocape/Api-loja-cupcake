<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>Use o codigo abaixo para validação</h4>
    <br>
    <h1>{{$codigo}}</h1>
    <br>
    @if($cupom != "")

    <h4>Use o cupom abaixo para obter 10% de desconto na primeira compra.</h4>
    <br>
    <h1>{{$cupom}}</h1>
    <br>

    @endif
    <h5>não responda este email.</h5>
</body>
</html>