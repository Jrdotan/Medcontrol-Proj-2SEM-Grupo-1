<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prontuário</title>
    <style>
        form{
            margin: 20px;
        }
        div{
            margin-bottom: 10px;
        }
        label{
            display: block;
            margin-bottom: 5px;
        }
        input{
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <form id="medicalRecordForm">
        <div>
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf">
        </div>
        <div>
            <label for="nomeCompleto">Nome: </label>
            <input type="text" id="nomeCompleto" name="nomeCompleto" readonly>
        </div>
        <div>
            <label for="idade">Idade:</label>
            <input type="text" id="idade" name="idade" readonly>
        </div>
        <div>
            <label for="sexo">Sexo:</label>
            <input type="text" id="sexo" name="sexo" readonly>
        </div>
        <div>
            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" readonly>
        </div>
        <div>
            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" readonly>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" readonly>
        </div>
        <div>
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" readonly>
        </div>

        <hr>

        <div>

        <label for="cid">CID:</label>
        <input type="text" id="cid" name="cid">
        </div>
        <div>
            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" readonly>
        </div>
    </form>

    
    
</body>
</html>