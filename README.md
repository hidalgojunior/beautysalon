# Sistema de Gerenciamento de Inventário

Sistema desenvolvido em PHP para gerenciamento de inventário de equipamentos, mobiliários e itens.

## Estrutura do Projeto
'''
mobiliario/
├── assets/
│ ├── css/
│ ├── js/
│ └── images/
├── config/
├── controllers/
├── models/
├── views/
├── utils/
└── uploads/
## Requisitos

- PHP 7.4+
- MySQL 5.7+
- Servidor Web (Apache/Nginx)

## Instalação

1. Clone o repositório
2. Copie `config/config.example.php` para `config/config.php`
3. Configure as credenciais do banco de dados em `config/config.php`
4. Importe o arquivo SQL da pasta `database/`
5. Acesse o sistema através do navegador

## Funcionalidades

- [ ] Sistema de autenticação
- [ ] Gestão de usuários
- [ ] Controle de inventário
- [ ] Movimentação de itens
- [ ] Gestão de manutenções
- [ ] Relatórios
- [ ] Dashboard

## Convenções de Commit

- `feat`: Nova funcionalidade
- `fix`: Correção de bug
- `docs`: Documentação
- `style`: Formatação
- `refactor`: Refatoração de código
- `test`: Testes
- `chore`: Tarefas gerais

## Paleta de Cores

- Black: #000000
- Cambridge Blue: #839788
- Champagne: #eee0cb
- Khaki: #baa898
- Columbia Blue: #bfd7ea 