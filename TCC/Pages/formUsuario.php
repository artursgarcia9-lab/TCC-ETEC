<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php require_once '../Config/header.php'; ?>
        <title>Cadastro</title>

        <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4e73df, #224abe);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            padding: 30px;
            width: 350px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }

        input:focus {
            border-color: #4e73df;
            outline: none;
            box-shadow: 0 0 5px rgba(78,115,223,0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #4e73df;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        button:hover {
            background: #2e59d9;
        }

        .error {
            background: #ffe0e0;
            color: #c00;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        a {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #4e73df;
        }

        a:hover {
            text-decoration: underline;
        }
        </style>
    </head>

    <body>

        <div class="container">

            <h2>Cadastro de Usuário</h2>

            <!-- MENSAGENS DE ERRO (AGORA NO LUGAR CERTO) -->
            <?php if (isset($_GET['erro'])): ?>
                <div class="error">
                    <?php
                        if ($_GET['erro'] == 'campos_vazios') echo "Preencha todos os campos.";
                        elseif ($_GET['erro'] == 'email_invalido') echo "Email inválido.";
                        elseif ($_GET['erro'] == 'senha_diferente') echo "As senhas não coincidem.";
                        elseif ($_GET['erro'] == 'erro_cadastro') echo "Erro ao cadastrar.";
                    ?>
                </div>
            <?php endif; ?>

            <form action="salvarUsuario.php" method="POST" onsubmit="return validarSenha()">

                Nome:
                <input type="text" name="nome" required>

                Status da Residência:
                <input type="text" name="status" required>

                Apelido:
                <input type="text" name="apelido">

                Email:
                <input type="email" name="email" required>

                Idioma:
                <input type="text" name="idioma">

                País:
                <input type="text" name="pais">

                Senha:
                <input type="password" id="senha" name="senha" required>

                Confirmar Senha:
                <input type="password" id="confirmar_senha" name="confirmar_senha" required>

                <div id="erroSenha" class="error" style="display:none;">
                    As senhas não coincidem.
                </div>

                <button type="submit">Cadastrar</button>
            </form>

            <a href="index.php">Voltar para login</a>

        </div>

        <script>
        function validarSenha() {
            const senha = document.getElementById("senha").value;
            const confirmar = document.getElementById("confirmar_senha").value;
            const erro = document.getElementById("erroSenha");

            if (senha !== confirmar) {
                erro.style.display = "block";
                return false;
            }

            erro.style.display = "none";
            return true;
        }
        </script>

        <script src="/TCC/registrar-sw.js"></script>
    </body>
</html>
