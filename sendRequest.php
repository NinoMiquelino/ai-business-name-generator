<?php
require_once 'vendor/autoload.php';

// Configuração básica para permitir requests do frontend
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido']);
    exit;
}

// Sua chave da API OpenAI - use variável de ambiente em produção!
$apiKey = 'sk-sua-chave-api-aqui';

$industry = $_POST['industry'] ?? '';
$concept = $_POST['concept'] ?? '';

if (empty($industry) || empty($concept)) {
    echo json_encode(['error' => 'Setor e conceito são obrigatórios.']);
    exit;
}

try {
    // Construa o cliente da API OpenAI
    $auth = new \Tectalic\OpenAi\Authentication($apiKey);
    $httpClient = new \GuzzleHttp\Client();
    $client = \Tectalic\OpenAi\Manager::build($httpClient, $auth);
    
    // Crie o prompt
    $prompt = sprintf(
        "Sugira 3 nomes criativos e slogans para uma empresa no setor de %s com um conceito %s. Formate cada sugestão como 'Nome: [nome] | Slogan: [slogan]'",
        $industry,
        $concept
    );
    
    // Faça a requisição para a API
    $response = $client->chatCompletions()->create(
        new \Tectalic\OpenAi\Models\ChatCompletions\CreateRequest([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => 500,
            'temperature' => 0.8
        ])
    )->toModel();
    
    // Retorne a resposta para o frontend
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao comunicar com a API: ' . $e->getMessage()]);
}
?>