<?php
defined('BASEPATH') or exit('No direct script access allowed');
use GuzzleHttp\Client;
class Agente_i_a
{
    /**
     * Undocumented function
     *
     * @param string $mensagem
     * @return string
     */
    public function gpt($mensagem, $agente = NULL)
    {
        // object(stdClass)#548 (14) {
        //     ["id"]=>
        //     string(1) "1"
        //     ["name"]=>
        //     string(6) "Vendas"
        //     ["description"]=>
        //     string(16) "Agente de vendas"
        //     ["agente"]=>
        //     string(3) "gpt"
        //     ["modelo"]=>
        //     string(11) "gpt-4o-mini"
        //     ["role"]=>
        //     string(6) "system"
        //     ["content"]=>
        //     string(22) "Especialista em Vendas"
        //     ["max_tokens"]=>
        //     string(3) "250"
        //     ["temperature"]=>
        //     string(3) "0.2"
        //     ["token"]=>
        //     string(12) "1da56w1561da"
        //     ["status"]=>
        //     string(6) "active"
        //     ["atuacao"]=>
        //     string(3) "all"
        //     ["created_at"]=>
        //     string(19) "2025-05-28 16:35:45"
        //     ["updated_at"]=>
        //     string(19) "2025-05-28 16:35:45"
        // }

        $data = [
            "model" => "gpt-4o-mini", //"gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Você é um especialista contabil, fiscal e financeiro e também um assistente chamado Liquida SP Bot.
                        Você é especializado no Perfex CRM.
                        Sempre use exemplos claros em suas respostas.
                        Aqui estão os dados do DRE de uma empresa.
                        Considere sempre que o usurio tem cadastro de staff e que ele já está logado no sistema.
                        Quando você não souber a resposta, indique o link https://liquidasp.com.br/knowledge-base.
                        Quando a pessoa precisar de um módulo indique o link https://liquidasp.com.br.
                    "
                ],
                ["role" => "user", "content" => $mensagem]
            ],
            'max_tokens' => 250,
            "temperature" => 0.2, // Respostas mais diretas
        ];
        $token = get_option('openai_api_key');

        if($agente){
            if(isset($agente->token) && $agente->token != ''){
                $token = $agente->token;
            }
            if(isset($agente->modelo) && $agente->modelo != ''){
                $data['model'] = $agente->modelo;
            }
            if(isset($agente->max_tokens) && $agente->max_tokens != ''){
                $data['max_tokens'] = (int)$agente->max_tokens;
            }
            if(isset($agente->temperature) && $agente->temperature != ''){
                $data['temperature'] = (float)$agente->temperature;
            }
            if(isset($agente->content) && $agente->content != ''){
                $data['messages'][0]['content'] = $agente->content;
            }
        }

        $client = new Client();
        try {
            $url = "https://api.openai.com/v1/chat/completions";
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer $token"
                ],
                'json' => $data
            ]);
            $body = $response->getBody();
            $data = json_decode($body);
            // echo "<pre>";
            // var_dump($data);
            if(isset($data->choices[0]->message->content)){
                return $data->choices[0]->message->content;
            }
            return false;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            echo "Erro ao acessar a API: " . $e->getMessage();
            if ($e->hasResponse()) {
                echo "\nDetalhes do erro: " . $e->getResponse()->getBody()->getContents();
            }
            return false;
        }
    }
}