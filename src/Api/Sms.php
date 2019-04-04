<?php
namespace TotalVoice\Api;

use TotalVoice\Route;

class Sms extends ApiRelatorio
{
    /**
     * @var string
     */
    const ROTA_SMS = '/sms/';

    /**
     * Envia um sms para um número destino
     * @param string $numeroDestino
     * @param string $mensagem
     * @param boolean $respostaUsuario
     * @param string $tags
     * @param boolean $multiSMS
     * @param \DateTime $dataCriacao
     * @return mixed
     */
    public function enviar($numeroDestino, $mensagem, $respostaUsuario = false, $tags,  $multiSMS = false, \DateTime $dataCriacao = null)
    {
        if($dataCriacao instanceof \DateTime) {
            $dataCriacao->setTimezone(new \DateTimeZone('UTC'));
            $dataCriacao = $dataCriacao->format('Y-m-d H:i:s e');
        }
        return $this->client->post(
            new Route([self::ROTA_SMS]), [
                'numero_destino'  => $numeroDestino,
                'mensagem'        => $mensagem,
                'resposta_usuario'=> $respostaUsuario,
                'tags'            => $tags,
                'multi_sms'       => $multiSMS,
                'data_criacao'    => $dataCriacao
            ]
        );
    }

    /**
     * Busca um sms pelo seu ID
     * @param $id
     * @return mixed
     */
    public function buscaSms($id)
    {
        return $this->client->get(new Route([self::ROTA_SMS, $id]));
    }

    public function getRota()
    {
        return self::ROTA_SMS;
    }
}