## 👨‍💻 Autor

<div align="center">
  <img src="https://avatars.githubusercontent.com/ninomiquelino" width="100" height="100" style="border-radius: 50%">
  <br>
  <strong>Onivaldo Miquelino</strong>
  <br>
  <a href="https://github.com/ninomiquelino">@ninomiquelino</a>
</div>

---

# 🚀 AI Business Name Generator

[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777BB4?logo=php)](https://www.php.net/)
[![OpenAI API](https://img.shields.io/badge/OpenAI-GPT--3.5-412991?logo=openai)](https://openai.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E?logo=javascript)](https://developer.mozilla.org/javascript)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.2-7952B3?logo=bootstrap)](https://getbootstrap.com/)
![License MIT](https://img.shields.io/badge/License-MIT-green)
![Status Stable](https://img.shields.io/badge/Status-Stable-success)
![Version 1.0.0](https://img.shields.io/badge/Version-1.0.0-blue)
![GitHub stars](https://img.shields.io/github/stars/NinoMiquelino/ai-business-name-generator?style=social)
![GitHub forks](https://img.shields.io/github/forks/NinoMiquelino/ai-business-name-generator?style=social)
![GitHub issues](https://img.shields.io/github/issues/NinoMiquelino/ai-business-name-generator)

> Gerador inteligente de nomes e slogans para negócios utilizando OpenAI API, PHP e JavaScript

---

## 🎯 Funcionalidades

- **🤖 IA Generativa**: Utiliza OpenAI GPT para criar nomes e slogans criativos
- **⚡ Rápido e Eficiente**: Respostas em tempo real da API
- **🎨 Interface Moderna**: Design responsivo com Bootstrap 5
- **🔧 Fácil Configuração**: Setup simples e intuitivo
- **📱 Responsivo**: Funciona em desktop e mobile
- **🚀 Full-Stack**: Combina PHP backend com JavaScript frontend

---

## 🛠 Tecnologias Utilizadas

### Backend
- **PHP 8.0+** - Linguagem server-side
- **OpenAI API** - Modelo GPT-3.5-turbo
- **Guzzle HTTP** - Cliente para requisições HTTP
- **Composer** - Gerenciador de dependências

### Frontend
- **JavaScript ES6+** - Interatividade e chamadas assíncronas
- **Bootstrap 5** - Framework CSS para styling
- **HTML5** - Estrutura semântica
- **Fetch API** - Comunicação com backend

---

## 📦 Estrutura do Projeto

```
ai-business-name-generator/
├── index.html
├── sendRequest.php
├── README.md
├── .gitignore
└── LICENSE
```

---

## 🚀 Como Usar

### Pré-requisitos
- Servidor web com PHP 8.0+
- Chave da API OpenAI
- Composer (para gerenciar dependências)

Opção 1 - Usando a biblioteca Tectalic (recomendado)

```
composer init
composer require tectalic/openai
```

Opção 2 - Usando cURL (Abordagem mais simples)

Se preferir não usar bibliotecas externas

```php
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido']);
    exit;
}

$apiKey = 'sk-sua-chave-api-aqui';
$industry = $_POST['industry'] ?? '';
$concept = $_POST['concept'] ?? '';

if (empty($industry) || empty($concept)) {
    echo json_encode(['error' => 'Setor e conceito são obrigatórios.']);
    exit;
}

$prompt = "Sugira 3 nomes criativos e slogans para uma empresa no setor de $industry com um conceito $concept. Formate cada sugestão como 'Nome: [nome] | Slogan: [slogan]'";

$data = [
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        [
            'role' => 'user',
            'content' => $prompt
        ]
    ],
    'max_tokens' => 500,
    'temperature' => 0.8
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    echo json_encode(['error' => 'Erro cURL: ' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode(['error' => 'API retornou erro: ' . $httpCode]);
    exit;
}

echo $response;
?>
```

### Instalação Passo a Passo

1. **Clone o repositório**

```bash
git clone https://github.com/ninomiquelino/ai-business-name-generator.git
cd ai-business-name-generator
```

2. Configure a API Key
   · Acesse OpenAI API
   · Crie uma nova API Key
   · No arquivo sendRequest.php, substitua:
     ```php
     $apiKey = 'sk-sua-chave-api-aqui';
     ```
3. Execute o projeto
   ```bash
   # Usando servidor PHP embutido
   php -S localhost:8000
   ```
   Ou configure em seu servidor web preferido (Apache, Nginx)
4. Acesse a aplicação
   · Abra: http://localhost:8000/index.html

Como Utilizar

1. Informe o setor do negócio (ex: Tecnologia, Restaurante, Moda)
2. Descreva o conceito (ex: Inovador, Sustentável, Luxuoso)
3. Clique em "Gerar Ideias"
4. Receba sugestões criativas de nomes e slogans

💡 Exemplos de Uso

Entrada:

· Setor: Tecnologia
· Conceito: Inovação e Simplicidade

Saída (exemplo):

```
Nome: TechFlow | Slogan: Inovação que flui naturalmente
Nome: SimpleCode | Slogan: Tecnologia complexa, experiência simples
Nome: NovaMind | Slogan: Pensando no futuro, hoje
```

⚙️ Configuração da API

Obtenha sua Chave OpenAI

1. Acesse OpenAI Platform
2. Crie uma conta ou faça login
3. Vá para "API Keys" no menu
4. Clique em "Create new secret key"
5. Copie a chave gerada

Configurações de Modelo

O projeto utiliza por padrão:

· Modelo: gpt-3.5-turbo
· Temperature: 0.8 (criatividade)
· Max Tokens: 500 (tamanho da resposta)

🔧 Personalização

Modificar o Prompt

No arquivo sendRequest.php, edite a variável $prompt:

```php
$prompt = "Sugira 5 nomes criativos para $industry com conceito $concept...";
```

Alterar Parâmetros da API

Ajuste os parâmetros da chamada da API:

```php
'max_tokens' => 1000,      // Aumenta o tamanho da resposta
'temperature' => 0.7,      // Controla a criatividade (0-1)
'model' => 'gpt-4',        // Usa modelo mais avançado
```

🌐 Deploy

Opções de Hospedagem

· Shared Hosting: Upload via FTP (certifique-se do suporte a PHP 8+)
· VPS/Cloud: DigitalOcean, AWS, Google Cloud
· Platform as a Service: Heroku, Railway, Vercel (com buildpack PHP)

Variáveis de Ambiente (Produção)

Para maior segurança, use variáveis de ambiente:

```php
$apiKey = getenv('OPENAI_API_KEY');
```

⚠️ Troubleshooting

Erros Comuns

"API key não configurada"

· Verifique se a API Key foi inserida corretamente
· Confirme se a chave tem créditos disponíveis

"Erro de CORS"

· Certifique-se de que os headers estão configurados no PHP
· Verifique se está acessando via servidor web

"Composer não encontrado"

· Instale o Composer: https://getcomposer.org/download/

🎯 Próximos Passos

Ideias para expandir o projeto:

· Adicionar banco de dados para histórico
· Sistema de favoritos
· Geração de logos com DALL·E
· Análise de domínios disponíveis
· Export para PDF das ideias
· Multi-idioma

---

## 🙏 Agradecimentos

· OpenAI pela incrível API
· Bootstrap pelo framework CSS
· Comunidade PHP e JavaScript

---

## 🤝 Contribuições
Contribuições são sempre bem-vindas!  
Sinta-se à vontade para abrir uma [*issue*](https://github.com/NinoMiquelino/ai-business-name-generator/issues) com sugestões ou enviar um [*pull request*](https://github.com/NinoMiquelino/ai-business-name-generator/pulls) com melhorias.

---

## 💬 Contato
📧 [Entre em contato pelo LinkedIn](https://www.linkedin.com/in/onivaldomiquelino/)  
💻 Desenvolvido por **Onivaldo Miquelino**

---
