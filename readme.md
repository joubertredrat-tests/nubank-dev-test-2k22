# Nubank DevTest

## Dependências

```
docker
docker compose
```

## Execução do projeto

```
docker compose up -d
```

Após execução do comando acima, será possível interagir com o cli do projeto, bem como visualizar o relatório de coverage em `http://0.0.0.0:8000/`.

## Executando o cli

Como o cli foi projetado para receber os dados via stdin, basta interagir com o cli, conforme exemplos abaixo:

```
docker compose exec nubank-test-cli php cli/index.php < yourfile.txt
cat yourfile.txt | docker compose exec nubank-test-cli php cli/index.php
echo '[{"operation":"buy", "unit-cost":10, "quantity": 100},{"operation":"sell", "unit-cost":15, "quantity": 50},{"operation":"sell", "unit-cost":15, "quantity": 50}]' | docker compose exec nubank-test-cli php cli/index.php
```

Outro comando disponível é a geração do coverage, com resposta no terminal, sendo o comando abaixo:

```
docker compose exec nubank-test-cli php composer.phar run coverage
```

## Sobre o projeto

O projeto foi realizado seguindo o pdf presente neste repositório e usando PHP.

Para a separação da lógica, foi utilizado alguns conceitos de Domain Driven Design.

As lógicas de análise de lucro e aplicação de taxa estão em classes de cálculos na camada de Application, porém, implementando interfaces, o que torna possível a troca por outras classes de cálculos que também implementem estas interfaces, seguindo o princípio de inversão e injeção de dependências.

Como a questão de "simplicidade" e "elegância" exigida no teste é subjetivo e eu não vi uma estruturação de dados, a persistência de dados em memória está separada em 2 classes de cálculo.
Eu poderia ter optado por um repository pattern com interface na camada de domínio e a implementação como repositório em memória na camada de Infra, porém, julguei isto como over engineering, então não achei necessidade em fazer.