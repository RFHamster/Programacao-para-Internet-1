<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>VW | Veículos e Transporte</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="assets/img/icon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styleRef.css">
</head>

<body>
    <div class="modal" id="meuModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Cabeçalho do modal -->
                <div class="modal-header">
                    <h4 class="modal-title">CONFIRA SEUS DADOS</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Corpo do modal -->
                <div class="modal-body">
                    <p class="modal-body-text">Conteúdo do modal aqui...</p>
                </div>

                <!-- Rodapé do modal -->
                <div class="modal-footer">
                    <!-- limpar = reload pagina, salvar = post php -->
                    <button type="button" id="clear" class="btn btn-secondary">Limpar</button>
                    <button type="button" id="edit" class="btn btn-secondary" data-dismiss="modal">Editar</button>
                    <button type="submit" form="formCompraVenda" value="Update" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.html">
                <img src="assets/img/Logo VW.png" width="220" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="#navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="comprar.php">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="refinanciar.html">Refinanciar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="atendimento.html">Atendimento</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Menu</a></li>
            <li class="breadcrumb-item"><a href="comprar.php">Catálogo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Comprar</li>
        </ol>
    </nav>

    <?php
    require "acesso.php";
    $codigoProduto = $_GET["codProd"];
    ?>
    <main>
        <div class="container">
            <h2 class="margin">FORMULÁRIO DE CONTATO</h2>
            <form id="formCompraVenda" name="formCompraVenda"
                action="agradecimento.php?codCarro=<?php echo $codigoProduto; ?>" method="post">
                <fieldset>
                    <legend>
                        <?php
                        $pdo = mysqlConnect();

                        try {
                            $sql = <<<SQL
                                        SELECT marca, modelo, anoMod, preco
                                        FROM carro
                                        WHERE id = ? 
                                    SQL;
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$codigoProduto]);
                        } catch (Exception $e) {
                            exit($e->getMessage());
                        }

                        while ($row = $stmt->fetch()) {
                            $marca = htmlspecialchars($row['marca']);
                            $modelo = htmlspecialchars($row['modelo']);
                            $anoMod = htmlspecialchars($row['anoMod']);
                            $preco = htmlspecialchars($row['preco']);
                            echo <<<HTML
                                    <h3>Compra/Troca do $marca $modelo $anoMod</h3>
                                    <h4>R$ $preco</h4>
                                    HTML;
                        }

                        ?>

                    </legend>
                    <fieldset>
                        <legend>SEUS DADOS</legend>
                        <div class="inp">
                            <label for="nome">Nome:</label>
                            <input class="input" type="text" id="nome" name="nome" required>
                            <span></span>
                        </div>
                        <div class="inp">
                            <label for="email">E-mail:</label>
                            <input class="input" type="email" id="email" name="email" required>
                            <span></span>
                        </div>
                        <div class="inp">
                            <label for="cpf">CPF:</label>
                            <input class="input" type="text" id="cpf" name="cpf" required>
                            <span></span>
                        </div>
                        <div class="inp">
                            <label for="dataNasc">Data de nascimento:</label>
                            <input class="input" type="date" id="dataNasc" name="dataNasc" required>
                            <span></span>
                        </div>
                        <div class="inp">
                            <label for="telefone">Telefone:</label>
                            <input class="input" type="tel" id="telefone" name="telefone" required>
                            <span></span>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>POSSUI CNH?</legend>
                        <div class="inp">
                            <input type="radio" id="sim" name="resposta" value="sim" required>
                            <label for="sim">Sim</label>
                        </div>
                        <div class="inp">
                            <input type="radio" id="nao" name="resposta" value="nao" required>
                            <label for="nao">Nao</label>
                        </div>
                        <div class="inp cnh-inp">
                            <label for="cnh">CNH: </label>
                            <input type="text" id="cnh" name="cnh">
                            <span></span>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>TIPO DE PAGAMENTO</legend>
                        <div class="inp">
                            <label for="tipo">Escolha o Tipo:</label>
                            <select id="tipo" name="tipo">
                                <option value="troca">Troca</option>
                                <option value="compra">Dinheiro/Financiamento</option>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset class=carro-inp>
                        <legend>DADOS DO CARRO</legend>
                        <div class="inp">
                            <label for="marca">Marca:</label>
                            <input class="input" type="text" id="marca" name="marca">
                            <span></span>
                        </div>
                        <div class="inp">
                            <label for="modelo">Modelo:</label>
                            <input class="input" type="modelo" id="modelo" name="modelo">
                            <span></span>
                        </div>
                        <div class="inp">
                            <label for="anoFab">Ano Fabricação:</label>
                            <input class="input" type="text" id="anoFab" name="anoFab">
                            <span></span>
                        </div>
                        <div class="inp">
                            <label for="anoMod">Ano Modelo:</label>
                            <input class="input" type="text" id="anoMod" name="anoMod">
                            <span></span>
                        </div>
                        <div class="inp">
                            <label for="placa">Placa:</label>
                            <input class="input" type="text" id="placa" name="placa">
                            <span></span>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>CONFIRMAÇÕES</legend>
                        <div class="inp">
                            <div class="inp">
                                <input type="checkbox" id="verdades" name="confirmacao[]" value="verdades" required>
                                <label for="verdades">Confirmo a veracidade dos dados acima</label>
                            </div>
                            <input type="checkbox" id="sistCred" name="confirmacao[]" value="sistCred" required>
                            <label for="sistCred">Abdico uso dos dados para análise em sistemas de crédito</label>
                        </div>
                    </fieldset>
                    <div class="inp">
                        <button class="btn btn-secondary" id="reset" type="reset">Limpar</button>
                        <button class="btn btn-primary" id="submit" type="submit">Submeter</button>
                    </div>
                </fieldset>
            </form>
        </div>

    </main>


    <footer class="container-fluid bg-footer marginb">
        <div class="container-fluid marginb">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h5>COMPRAR OU VENDER</h5>
                        <h6><a href="comprar.php">Carros usados ou seminovos</a></h6>
                        <h6><a href="comprar.php">Motos usadas ou seminovas</a></h6>
                        <h6><a href="comprar.php">Vender o seu veículo</a></h6>
                    </div>
                    <div class="col-md-3">
                        <h5>SERVIÇOS</h5>
                        <h6>
                            <a href="comprar.php">Trocar o seu carro</a>
                        </h6>
                        <h6>
                            <a href="financiar.html">Refinanciar</a>
                        </h6>
                        <h6>
                            <a href="telaLogin.php">Página do ADM</a>
                        </h6>
                    </div>
                    <div class="col-md-3">
                        <h5>AJUDA</h5>
                        <h6>
                            <a href="atendimento.html">Atendimento</a>
                        </h6>
                        <h6>
                            <a href="atendimento.html">Como comprar</a>
                        </h6>
                        <h6>
                            <a href="atendimento.html">Como vender</a>
                        </h6>
                        <h6>
                            <a href="atendimento.html">Sobre nós</a>
                        </h6>
                        <a href="http://www.planalto.gov.br/ccivil_03/leis/l8078compilado.htm" target="_blank">
                            <h6>Código de Defesa do Consumidor</h6>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <h5>PARCEIROS</h5>
                        <h6>
                            <a href="https://www.omni.com.br/" target="_blank">
                                Omni Financeira
                            </a>
                        </h6>
                        <h6>
                            <a href="https://www.bv.com.br/" target="_blank">
                                BV Financeira
                            </a>
                        </h6>
                        <h6>
                            <a href="https://www.bancopan.com.br/" target="_blank">
                                Pan Financeira
                            </a>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="assets/js/scriptCompraVenda.js"></script>
</body>

</html>