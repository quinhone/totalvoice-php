<?php
namespace TotalVoice\Tts;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class TtsService
{
    /**
     * @var string
     */
    const ROTA_TTS = '/tts/';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Service constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Envia um TTS (text-to-speach) para um número destino
     * @param array $data
     * @return mixed
     */
    public function enviar($data)
    {
        return $this->client->post(
            new Route([self::ROTA_TTS]),
            $data
        );
    }

    /**
     * Busca um tts pelo seu ID
     * @param $id
     * @return mixed
     */
    public function buscaTts($id)
    {
        return $this->client->get(new Route([self::ROTA_TTS, $id]));
    }

    /**
     * Relatório de mensagens de Tts
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @return mixed
     */
    public function relatorio(\DateTime $dataInicio, \DateTime $dataFinal)
    {
        return $this->client->get(
            new Route([self::ROTA_TTS, 'relatorio']), [
            'data_inicio' => $dataInicio->format('d/m/Y'),
            'data_fim'    => $dataFinal->format('d/m/Y')
        ]);
    }
}