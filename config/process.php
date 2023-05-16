<?php

    session_start();

    $conn;

    include_once("connection.php");
    include_once("url.php");

    $data = $_POST;

    //MODIFICAÇÃO DE DADOS
    if (!empty($data)) {
        //CADASTRAR PRODUTO
        if ($data["type"] == "create") {
            $nomeProduto = $data["nome"];
            $valor = $data["valor"];
            $quantidade = $data["quantidade"];

            $query = "INSERT INTO produtos (nome, valorVenda, quantidade) VALUES (:nome, :valor, :quantidade)";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":nome", $nomeProduto);
            $stmt->bindParam(":valor", $valor);
            $stmt->bindParam(":quantidade", $quantidade);

            try {
                $stmt->execute();
                $_SESSION["msg"] = "Produto cadastrado com sucesso";
            } catch (PDOException $e) {
                //erro na conexão
                $error = $e->getMessage();
                echo "Erro; $error";
            }
        //EDITAR PRODUTO
        } else if ($data["type"] == "update") {
            $nomeProduto = $data["nome"];
            $valor = $data["valor"];
            $quantidade = $data["quantidade"];
            $id = $data["id"];

            $query = "UPDATE produtos SET nome = :nome, valorVenda = :valor, quantidade = :quantidade WHERE id = :id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":nome", $nomeProduto);
            $stmt->bindParam(":valor", $valor);
            $stmt->bindParam(":quantidade", $quantidade);
            $stmt->bindParam(":id", $id);

            try {
                $stmt->execute();
                $_SESSION["msg"] = "Produto atualizado com sucesso!";

            } catch (PDOException $e) {
                //Erro na conexão
                $error = $e->getMessage();
                echo "Erro: $error";
            }
        //DELETA PRODUTO
        } else if ($data["type"] == "delete") {
            $id = $data["id"];

            $query = "DELETE FROM produtos WHERE id = :id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":id", $id);

            try {
                $stmt->execute();
                $_SESSION["msg"] = "Produto deletado com sucesso!";
            } catch (PDOException $e) {
                $error = $e->getMessage();
                echo "Erro: $error";
            }
        }

        // REDIRECT HOME
         header("location:" . $BASE_URL . "/../index.php");

    } else {
        $id;

        if(!empty($_GET)) {
            $id = $_GET['id'];
        }

        // Retorna o dado de um contato
        if (!empty($id)) {
            $query = "SELECT * FROM produtos WHERE id = :id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $product = $stmt->fetch();
        } else {
            // Retorna todos os contatos
            $products = [];
    
            $query = "SELECT * FROM produtos";
        
            $stmt = $conn->prepare($query);
        
            $stmt->execute();
        
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    // FECHAR CONEXÃO
    $conn = null;