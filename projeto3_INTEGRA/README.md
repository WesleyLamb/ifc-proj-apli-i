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
docker compose exec app php artisan key:generate
docker compose exec app php artisan passport:keys
docker compose exec app php artisan migrate --seed --force
```

Acesse a aplicação através do link [http://painel.pgs.localhost](http://painel.pgs.localhost)

Há um usuário administrador cadastrado:

- **e-mail:** admin@pgs.localhost
- **senha:** 12345678

## Resumo

Este documento apresenta o planejamento e os elementos fundamentais do projeto “PGS: Você mais próximo de seus usuários”. Trata-se de uma plataforma web desenvolvida para software houses controlarem licenças de seus produtos e gerenciarem o relacionamento com os usuários finais. Serão abordados o contexto e objetivos do projeto, sua relevância para o ambiente de negócio, além dos resultados esperados. O projeto utiliza tecnologias modernas e adota boas práticas de engenharia de software, visando entregar uma solução escalável, segura e com alto grau de usabilidade.

## Tema e Contexto do Projeto

O projeto tem foco no desenvolvimento de uma plataforma gerencial web para controle de licenças e aproximação entre a software house e seus usuários. Atualmente, muitas software houses criam soluções sob medida para controle de licenças e assinaturas, o que demanda tempo, conhecimento técnico e altos custos. O PGS propõe um sistema unificado e pronto para uso, que as empresas podem configurar rapidamente, otimizando tempo de entrega e facilitando a manutenção futura.

## Conclusão

O projeto PGS propõe uma solução inovadora, objetiva e viável para um problema recorrente enfrentado por software houses. Ao centralizar as funcionalidades de controle de licenças, integração com pagamentos e comunicação com usuários, a plataforma oferece ganho de produtividade e redução de custo de desenvolvimento para as empresas. Com uma arquitetura moderna e foco em usabilidade, o PGS tem potencial de impacto real no ambiente de negócio ao qual se destina, podendo ser expandido futuramente como produto comercial ou open-source.

## Contribuições

- Valdir Rugiski Jr.
- Wesley Ricardo Lamb.
