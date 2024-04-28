<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>

    <style type="text/css">
        #text {
            height: 20px;
            padding: 4px;
            border: solid thin #aaa;
            text-align: center;
            width: 100%
        }

        #button {
            padding: 10px;
            width: 100px;
            margin: 1px;
            color: white;
            background-color: darkblue;
            border: 5px;
        }

        #box {
            background-color: grey;
            margin: auto;
            width: 300px;
            padding: 20px;
            justify-content: auto;

        }
    </style>
    <div id="box">

        <form action="./includes/cadastro.php" method="post">
            <div style="font-size: 20px;margin: 10px;color:blue;text-align:center;">Cadastro</div>
            <label>Usuário:</label>
            <input id="text" type="text" name="username"><br />

            <label>Senha: </label>
            <input id="text" type="text" name="password"><br />

            <label>Repita a Senha: </label>
            <input id="text" type="text" name="password_rpt"><br />

            <label>Email:</label>
            <input id="text" type="text" name="email"><br />
            <input id="button" type="submit" name="submit" value="Cadastrar"><br />

        </form>
    </div>
</body>

</html>