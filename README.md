# 📦 Product Management Platform

Sistema completo de gerenciamento de produtos desenvolvido com **Laravel 12** e **Tailwind CSS 4**, oferecendo uma interface moderna e intuitiva para controle de estoque e cadastro de produtos.

## 📖 Sobre o Projeto

O **Product Management Platform** é uma aplicação web robusta para gerenciamento de inventário de produtos, permitindo operações completas de CRUD (Create, Read, Update, Delete) com uma interface responsiva e moderna.

### ✨ Funcionalidades Principais

#### 🛍️ Gestão de Produtos
- **Cadastro de Produtos**: Adicione novos produtos com nome, descrição, preço e quantidade
- **Listagem Inteligente**: Visualize todos os produtos em uma tabela organizada
- **Busca em Tempo Real**: Pesquise produtos por nome com atualização automática via AJAX
- **Edição Rápida**: Atualize informações de produtos existentes
- **Controle de Estoque**: Ajuste a quantidade de produtos de forma rápida e prática
- **Exclusão de Produtos**: Remova produtos do sistema com confirmação

#### 🎯 Destaques Técnicos
- **Interface Dinâmica**: Modals e AJAX para experiência fluida sem recarregar a página
- **Validações Robustas**: Validação de dados tanto no front-end quanto no back-end
- **Design Responsivo**: Interface adaptável para desktop, tablet e mobile
- **API REST**: Endpoints prontos para integração com outras aplicações
- **Controle Automático de Duplicatas**: Sistema inteligente que atualiza estoque automaticamente se produto já existir

#### 💡 Lógica de Negócio Especial
- Ao cadastrar um produto que já existe (mesmo nome e descrição):
  - A quantidade é somada ao estoque existente
  - O preço é atualizado apenas se o novo preço for menor
  - Evita duplicação de produtos no sistema

---

## 🚀 Tutorial Completo: Como Executar do Zero

Siga este guia passo a passo para configurar e executar o projeto em sua máquina.

### 📋 Pré-requisitos

Antes de começar, você precisará ter instalado:

| Software | Versão Mínima | Download |
|----------|---------------|----------|
| **PHP** | 8.2 ou superior | [php.net](https://www.php.net/downloads) |
| **Composer** | 2.0 ou superior | [getcomposer.org](https://getcomposer.org/) |
| **Laravel** | 12.x | Instalado via Composer (incluído nas dependências) |
| **Node.js** | 18.x ou superior | [nodejs.org](https://nodejs.org/) |
| **MySQL** | 8.0 ou superior | [mysql.com](https://www.mysql.com/downloads/) |
| **Git** | Qualquer versão | [git-scm.com](https://git-scm.com/) |

> **💡 Dica**: No Windows, você pode usar o [XAMPP](https://www.apachefriends.org/) para instalar PHP e MySQL de uma vez.
> 
> **ℹ️ Nota sobre Laravel**: O Laravel 12 será instalado automaticamente via Composer ao executar `composer setup`. Não é necessário instalá-lo globalmente.

#### ✅ Verificando as Instalações

Abra o terminal (CMD ou PowerShell) e execute:

```bash
php --version
composer --version
node --version
npm --version
mysql --version
```

Se todos os comandos retornarem as versões instaladas, você está pronto para continuar! 🎉

---

### 📥 Passo 1: Clonar o Repositório

```bash
git clone <url-do-repositorio>
cd product-mgmt-plat
```

---

### 🗄️ Passo 2: Configurar o Banco de Dados

#### 2.1 Criar o Banco de Dados

Abra o MySQL (pode ser via linha de comando, phpMyAdmin ou MySQL Workbench):

```sql
CREATE DATABASE product_mgmt_plat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 2.2 Configurar Variáveis de Ambiente

**No Windows:**
```bash
copy .env.example .env
```

**No Linux/Mac:**
```bash
cp .env.example .env
```

#### 2.3 Editar o arquivo `.env`

Abra o arquivo `.env` com seu editor preferido e configure:

```env
APP_NAME="Product Management"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=product_mgmt_plat
DB_USERNAME=root
DB_PASSWORD=sua_senha_mysql
```

> **⚠️ Importante**: Substitua `sua_senha_mysql` pela senha do seu MySQL. Se você não definiu senha, deixe em branco.

---

### ⚙️ Passo 3: Instalar Dependências e Configurar

Agora vamos instalar todas as dependências e configurar o projeto automaticamente:

```bash
composer setup
```

**O que este comando faz:**
1. ✅ Instala todas as dependências PHP via Composer
2. ✅ Cria o arquivo `.env` (se não existir)
3. ✅ Gera a chave de segurança da aplicação
4. ✅ Executa as migrações do banco de dados
5. ✅ Instala as dependências JavaScript via NPM
6. ✅ Compila os assets (CSS e JavaScript)

> **⏱️ Tempo estimado**: 2-5 minutos dependendo da sua conexão

---

### 🌱 Passo 3.1: Executar migrações com factory

Para criar automaticamente produtos de exemplo gerados pela `ProdutoFactory`, execute:

```bash
php artisan migrate --seed
```

Esse comando aplica todas as migrações e roda o seeder padrão (`DatabaseSeeder`), que chama `Produto::factory(10)` para popular o banco.

---

### 🎮 Passo 4: Executar a Aplicação

#### Opção A: Modo Desenvolvimento Completo (Recomendado) 🌟

Execute tudo com um único comando:

```bash
composer dev
```

Este comando inicia simultaneamente:
- 🌐 **Servidor Web** em `http://localhost:8000`
- 📨 **Worker de Filas** (para processamento em background)
- ⚡ **Vite Dev Server** (para hot-reload de CSS/JS)

**Acesse a aplicação:** Abra seu navegador em **http://localhost:8000**

#### Opção B: Modo Manual (Três Terminais)

Se preferir controle individual, abra 3 terminais separados:

**Terminal 1 - Servidor Web:**
```bash
php artisan serve
```

**Terminal 2 - Worker de Filas:**
```bash
php artisan queue:listen
```

**Terminal 3 - Vite (Assets):**
```bash
npm run dev
```

---

### 🎨 Passo 5: Usando a Aplicação

#### 🏠 Página Inicial
Ao acessar `http://localhost:8000`, você será redirecionado para `/produtos`

#### ➕ Cadastrar Produto
1. Clique no botão **"Novo Produto"**
2. Preencha os campos:
   - **Nome**: Nome do produto (obrigatório)
   - **Descrição**: Detalhes do produto (opcional)
   - **Preço**: Valor em reais (obrigatório, mínimo 0)
   - **Quantidade**: Quantidade em estoque (obrigatório, mínimo 0)
3. Clique em **"Salvar"**

#### 🔍 Buscar Produtos
- Use a barra de pesquisa no topo da página
- A busca é realizada em tempo real conforme você digita
- Funciona para pesquisa por nome do produto

#### ✏️ Editar Produto
1. Clique no ícone de **editar** na linha do produto
2. Altere os campos desejados
3. Clique em **"Atualizar"**

#### 📊 Ajustar Quantidade
- Clique nos botões **+** ou **-** ao lado da quantidade
- A atualização é instantânea

#### 🗑️ Excluir Produto
1. Clique no ícone de **lixeira** na linha do produto
2. Confirme a exclusão

---

## 📁 Estrutura do Projeto

```
product-mgmt-plat/
├── 📂 app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── ProdutoController.php    # Controlador principal de produtos
│   │   └── Requests/
│   │       └── ProdutoRequest.php       # Validações de formulário
│   └── Models/
│       └── Produto.php                  # Model do produto
│
├── 📂 database/
│   └── migrations/
│       └── 2025_11_08_051736_create_produtos_table.php  # Estrutura da tabela
│
├── 📂 resources/
│   ├── css/                             # Estilos Tailwind CSS
│   ├── js/                              # Scripts JavaScript/AJAX
│   └── views/
│       └── produto/                     # Views de produtos
│           ├── index.blade.php          # Listagem
│           ├── create.blade.php         # Formulário de criação
│           ├── edit.blade.php           # Formulário de edição
│           └── ...
│
├── 📂 routes/
│   ├── web.php                          # Rotas web
│   └── api.php                          # Rotas API
│
├── 📂 public/                           # Arquivos públicos
├── 📂 storage/                          # Arquivos gerados
├── 📂 tests/                            # Testes automatizados
├── .env.example                         # Exemplo de variáveis de ambiente
├── composer.json                        # Dependências PHP
└── package.json                         # Dependências JavaScript
```

---

## 🔌 API REST

A aplicação também oferece uma API REST para integração:

### Endpoints Disponíveis

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/produtos` | Lista todos os produtos |
| `POST` | `/produtos` | Cria um novo produto |
| `GET` | `/produtos/{id}` | Exibe um produto específico |
| `PUT` | `/produtos/{id}` | Atualiza um produto |
| `DELETE` | `/produtos/{id}` | Deleta um produto |
| `PATCH` | `/produtos/{id}/quantidade` | Atualiza apenas a quantidade |
| `GET` | `/produtos/search?q=termo` | Busca produtos por nome |

### Exemplo de Requisição (usando cURL)

```bash
# Listar produtos
curl http://localhost:8000/api/produtos

# Criar produto
curl -X POST http://localhost:8000/api/produtos \
  -H "Content-Type: application/json" \
  -d '{"nome":"Notebook","descricao":"Dell Inspiron","preco":3500.00,"quantidade":10}'

# Atualizar quantidade
curl -X PATCH http://localhost:8000/api/produtos/1/quantidade \
  -H "Content-Type: application/json" \
  -d '{"quantidade":15}'
```

---

## 🛠️ Comandos Úteis para Desenvolvedores

### Limpeza de Cache
```bash
php artisan cache:clear        # Limpa cache da aplicação
php artisan config:clear       # Limpa cache de configuração
php artisan route:clear        # Limpa cache de rotas
php artisan view:clear         # Limpa cache de views
php artisan optimize:clear     # Limpa todos os caches
```

### Banco de Dados
```bash
php artisan migrate            # Executa migrações pendentes
php artisan migrate --seed     # Executa migrações e roda a factory padrão
php artisan migrate:fresh      # Recria o banco do zero
php artisan migrate:rollback   # Reverte última migração
php artisan db:seed            # Popula o banco com dados de teste
```

### Compilação de Assets
```bash
npm run dev                    # Modo desenvolvimento com hot-reload
npm run build                  # Compila para produção (otimizado)
```

### Testes
```bash
composer test                  # Executa todos os testes
php artisan test               # Executa testes do Pest
php artisan test --filter NomeDoTeste  # Executa teste específico
```

### Código Limpo
```bash
./vendor/bin/pint              # Formata o código PHP automaticamente
./vendor/bin/pint --test       # Verifica formatação sem alterar
```

---

## 📦 Tecnologias Utilizadas

### Back-end
- **[Laravel 12](https://laravel.com/)** - Framework PHP moderno e elegante
- **[PHP 8.2+](https://www.php.net/)** - Linguagem de programação
- **[MySQL 8.0+](https://www.mysql.com/)** - Banco de dados relacional

### Front-end
- **[Tailwind CSS 4](https://tailwindcss.com/)** - Framework CSS utility-first
- **[Alpine.js](https://alpinejs.dev/)** - Framework JavaScript leve (via Laravel)
- **[Vite](https://vitejs.dev/)** - Build tool rápido e moderno

### Desenvolvimento
- **[Composer](https://getcomposer.org/)** - Gerenciador de dependências PHP
- **[NPM](https://www.npmjs.com/)** - Gerenciador de pacotes JavaScript
- **[Pest PHP](https://pestphp.com/)** - Framework de testes elegante
- **[Laravel Pint](https://laravel.com/docs/pint)** - Formatador de código PHP

---

## ⚙️ Configurações Avançadas

### Sistema de Filas

O projeto utiliza filas baseadas em banco de dados para processamento assíncrono:

```bash
php artisan queue:listen              # Worker persistente
php artisan queue:work                # Processa e encerra
php artisan queue:work --tries=3      # Com tentativas de retry
```

### Sessões e Cache

- **Sessões**: Armazenadas no banco de dados (tabela `sessions`)
- **Cache**: Driver de banco de dados (tabela `cache`)
- **Filas**: Driver de banco de dados (tabela `jobs`)

Todas as tabelas são criadas automaticamente nas migrações.

### Ambiente de Produção

Para produção, ajuste o `.env`:

```env
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error
```

E execute:

```bash
php artisan config:cache    # Cache configurações
php artisan route:cache     # Cache rotas
php artisan view:cache      # Cache views
npm run build               # Build de produção
```

---

## 🐛 Solução de Problemas Comuns

### ❌ Erro: "No application encryption key has been specified"

**Solução:**
```bash
php artisan key:generate
```

### ❌ Erro: "SQLSTATE[HY000] [1045] Access denied"

**Causa**: Credenciais incorretas no `.env`

**Solução**: Verifique usuário e senha do MySQL no arquivo `.env`

### ❌ Erro: "SQLSTATE[HY000] [1049] Unknown database"

**Causa**: Banco de dados não foi criado

**Solução**: 
```sql
CREATE DATABASE product_mgmt_plat;
```

### ❌ Erro: Porta 8000 já em uso

**Solução**: Use outra porta
```bash
php artisan serve --port=8080
```

### ❌ Erro: Permissão negada em storage/

**Linux/Mac:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

**Windows:** Execute o terminal como Administrador

### ❌ Erro: npm install falha

**Solução**: Limpe o cache do NPM
```bash
npm cache clean --force
rm -rf node_modules package-lock.json
npm install
```

### ❌ Erro: Vite não conecta

**Solução**: Verifique se a porta 5173 está livre ou configure no `vite.config.js`

---

## 📝 Observações Importantes

### 🖥️ Compatibilidade de Sistemas Operacionais

- **Windows**: Projeto totalmente funcional. Use `copy` ao invés de `cp`
- **Linux/Mac**: Funcional. Use `cp` ao invés de `copy` e ajuste permissões

### 🔒 Segurança

- ✅ Validação de dados em todas as entradas
- ✅ Proteção contra SQL Injection (Eloquent ORM)
- ✅ Proteção CSRF em formulários
- ✅ Sanitização de inputs
- ⚠️ Em produção, sempre use HTTPS

### 🚀 Performance

- O comando `composer dev` usa **concurrently** para rodar múltiplos processos
- Hot-reload ativo: mudanças no código são refletidas automaticamente
- Assets otimizados em produção com `npm run build`

### 📱 Responsividade

A interface é totalmente responsiva e funciona perfeitamente em:
- 🖥️ Desktop (1920x1080 e superiores)
- 💻 Laptop (1366x768 e similares)
- 📱 Tablet (iPad, Android tablets)
- 📱 Mobile (iPhone, Android phones)

---

## 🧪 Executando Testes

O projeto inclui testes automatizados com Pest PHP:

```bash
# Executar todos os testes
composer test

# Executar com coverage
php artisan test --coverage

# Executar teste específico
php artisan test --filter ProdutoTest
```

---

## 🤝 Contribuindo

Contribuições são bem-vindas! Para contribuir:

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/MinhaFeature`)
3. Commit suas mudanças (`git commit -m 'Adiciona MinhaFeature'`)
4. Push para a branch (`git push origin feature/MinhaFeature`)
5. Abra um Pull Request

---

## 📄 Licença

Este projeto está sob a licença **MIT**. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

## 🔗 Links Úteis

### Documentação Oficial
- 📚 [Documentação Laravel 12](https://laravel.com/docs/12.x)
- 🎨 [Documentação Tailwind CSS](https://tailwindcss.com/docs)
- ⚡ [Documentação Vite](https://vitejs.dev/guide/)
- 🧪 [Documentação Pest PHP](https://pestphp.com/docs)

### Tutoriais e Recursos
- 🎥 [Laracasts - Tutoriais em vídeo](https://laracasts.com)
- 📖 [Laravel News](https://laravel-news.com/)
- 💬 [Comunidade Laravel Brasil](https://github.com/laravelbrasil)

### Ferramentas Recomendadas
- 🔧 [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar) - Debug em desenvolvimento
- 📊 [Laravel Telescope](https://laravel.com/docs/telescope) - Monitoramento da aplicação
- 🎯 [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper) - Autocomplete no IDE

---

## 👨‍💻 Suporte

Se você encontrar algum problema ou tiver dúvidas:

1. ❓ Verifique a seção [Solução de Problemas](#-solução-de-problemas-comuns)
2. 📖 Consulte a [documentação oficial do Laravel](https://laravel.com/docs)
3. 🐛 Abra uma [issue](../../issues) no GitHub
4. 💬 Entre em contato com a comunidade Laravel

---

<div align="center">

**Desenvolvido com ❤️ usando Laravel e Tailwind CSS**

⭐ Se este projeto te ajudou, considere dar uma estrela no GitHub!

</div>
