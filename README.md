#Teste - 13/Junho/2018

## Dinaerte Neto <dinaerteneto@gmail.com>

### Como executar os testes.

- Os testes estão separador por diretórios de acordo com a ordem do documento enviado, 
  e deve ser executados seraparadamente utilizando o servidor embutido do php.
- Por exemplo, acesse o diretório 1, e digite na linha de comando <blockquote> php -S localhost:8080 </blockquote>
- O Exercício 2 e 3 possuem banco de dados, e por este motivo, existe o arquivo dump.sql dentro dos respectivos diretórios.

- No o exercício 2 é possível acessar o documentação das apis:
    - Após executar <blockquote> php -S localhost:8080 -t public/</blockquote> dentro do diretório 2, vá até o navegador e abra o seguinte endereço <link>http://localhost:8080/apidoc</link>
    - Há neste diretório um arquivo json para ser importado no postman, de modo a facilitar os testes das apis.

- Para o Exercício 3 foi criado um plugin de nome connect, e seu código esta localizado em: <blockquote> /wp-content/plugins/connect </blockquote>