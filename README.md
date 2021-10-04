# POC - Projeto Arquitetural - Gestão de Serviços de Logística (GSL) -TCC 2021 - PUC Minas

# Build
> docker-compose -p tcc -f docker-compose.yml build<br>

(Em ambiente de produção(servidor) utilizar o arquivo docker-compose-prod.yml)<br>

# Up/Down
> _docker-compose -p tcc -f docker-compose.yml up_ <br>
> _docker-compose -p tcc -f docker-compose.yml down_ <br>
 
**(Em ambiente de produção(servidor) utilizar o arquivo docker-compose-prod.yml)**

# Documentação API - Swagger 
Para facilitar a documentação dos endpoints de API disponiveis, foi feita a implementação do Swagger através do pacote **_"darkaonline/l5-swagger"._**.<br>

### Acessando a documentação
Após subir os serviços via Docker, a documentação estará disponivel em **_"localhost:9091/api/docs"._**<br>

### Gerar/Atualizar a documentação
Para gerar uma documentação atualizada, acesse o container de serviço **_"gateway"_** e execute o comando **_"php artisan l5-swagger:generate"._**<br>
