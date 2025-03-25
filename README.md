# 🍔 Kiero Burguer

Sistema de pedidos online para uma hamburgueria, desenvolvido em PHP com interface moderna e responsiva.

## 📋 Sobre o Projeto

O Kiero Burguer é uma aplicação web que permite aos clientes fazerem pedidos de hambúrgueres e outros itens do cardápio online. O sistema inclui funcionalidades como cadastro de usuários, login, carrinho de compras, finalização de pedidos e área administrativa.

## 🚀 Funcionalidades

### Cliente
- Cadastro de usuário com validação de dados
- Login seguro com hash de senha
- Visualização do cardápio
- Carrinho de compras
- Finalização de pedido com múltiplas formas de pagamento
- Histórico de pedidos

### Administrador
- Gerenciamento de produtos
- Controle de pedidos
- Visualização de relatórios
- Gestão de usuários

## 🛠️ Tecnologias Utilizadas

- **Frontend:**
  - HTML5
  - CSS3 (com Flexbox e Grid)
  - JavaScript
  - Phosphor Icons
  - Google Fonts (Josefin Sans)

- **Backend:**
  - PHP
  - MySQL
  - PDO para conexão com banco de dados

## 📦 Estrutura do Projeto

```
Kiero-Burguer-PI/
├── assets/                # Recursos estáticos
│   ├── css/              # Arquivos de estilo
│   │   ├── components/   # Componentes reutilizáveis
│   │   │   ├── header.css
│   │   │   ├── footer.css
│   │   │   └── forms.css
│   │   ├── pages/        # Estilos específicos de páginas
│   │   │   ├── login.css
│   │   │   ├── cadastro.css
│   │   │   └── finaliza.css
│   │   └── style.css     # Estilos gerais
│   ├── js/               # Scripts JavaScript
│   │   ├── components/   # Componentes JS reutilizáveis
│   │   └── pages/        # Scripts específicos de páginas
│   └── images/           # Imagens do projeto
├── config/               # Configurações
│   ├── database.php     # Configuração do banco de dados
│   └── constants.php    # Constantes do sistema
├── includes/            # Arquivos PHP reutilizáveis
│   ├── header.php      # Cabeçalho comum
│   ├── footer.php      # Rodapé comum
│   └── functions.php   # Funções utilitárias
├── src/                # Código fonte principal
│   ├── controllers/    # Controladores
│   ├── models/        # Modelos
│   └── views/         # Views
├── admin/             # Área administrativa
│   ├── assets/       # Recursos específicos do admin
│   ├── controllers/  # Controladores do admin
│   └── views/        # Views do admin
├── database/         # Scripts do banco de dados
│   └── schema.sql    # Estrutura do banco
├── vendor/           # Dependências (se usar Composer)
├── .gitignore       # Arquivos ignorados pelo Git
├── composer.json    # Configuração do Composer
├── index.php        # Ponto de entrada
└── README.md        # Documentação
```

## 🔒 Segurança

- Proteção contra SQL Injection usando PDO
- Hash de senhas com password_hash()
- Validação de dados no frontend e backend
- Proteção de sessão
- Sanitização de inputs
- Proteção contra XSS
- Validação de CPF
- Validação de CEP com API ViaCEP

## 🎨 Design

- Interface moderna e responsiva
- Paleta de cores consistente
- Animações suaves
- Layout adaptativo para diferentes dispositivos
- Feedback visual para interações
- Componentes reutilizáveis
- Sistema de grid flexível

## 📱 Responsividade

O sistema é totalmente responsivo e se adapta a diferentes tamanhos de tela:
- Desktop (> 1450px)
- Tablet (750px - 1450px)
- Mobile (< 750px)

## 🚀 Como Executar

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/Kiero-Burguer-PI.git
```

2. Instale as dependências (se usar Composer):
```bash
composer install
```

3. Configure um servidor web (Apache/Nginx) com PHP

4. Importe o banco de dados:
```bash
mysql -u seu_usuario -p seu_banco < database/schema.sql
```

5. Configure as variáveis de ambiente:
```bash
cp .env.example .env
# Edite o arquivo .env com suas configurações
```

6. Acesse o sistema através do navegador

## 👥 Desenvolvedores

- Gabriel Gevezier
- Hemily Batista
- Luana Peracini
- Vinicius Luciano
- Wesley Scolaro

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 🤝 Contribuindo

1. Faça um Fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📞 Suporte

Para suporte, envie um email para suporte@kieroburger.com ou abra uma issue no repositório.

## 🙏 Agradecimentos

- Equipe de desenvolvimento
- Professores orientadores
- Todos os contribuidores do projeto
 