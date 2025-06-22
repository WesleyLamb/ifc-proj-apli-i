# PGS

## Requisitos

- Git;
- Docker;

## Instalação

1. Clone este repositório;
2. Acesse a pasta raiz;
3. Duplique o arquivo `Dockerfile.app.example` e renomeie a nova cópia para `Dockerfile.app`;
4. Duplique o arquivo `.env.example` e renomeie a nova cópia para `.env`;
5. Duplique o arquivo `docker-compose.dev.yml.example` e renomeie a nova cópia para `docker-compose.yml`;
6. Acesse o diretório `./app/`;
7. Duplique o arquivo `.env.example` e renomeie a nova cópia para `.env`;
8. Volte para o diretório raíz;
9. Rode os seguintes comandos para subir a aplicação:
```bash
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan migrate --seed --force
```

Acesse a aplicação através do link [http://painel.pgs.localhost](http://painel.pgs.localhost)

Há um usuário administrador cadastrado:

- **e-mail:** admin@pgs.localhost
- **senha:** 12345678

## Contribuições

- Valdir Rugiski Jr.
- Wesley Ricardo Lamb.
