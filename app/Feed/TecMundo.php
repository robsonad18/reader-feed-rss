<?php 

namespace App\Feed;

use App\Utils\Config;

class TecMundo
{
    private $feed = null;

    public function __construct()
    {
        $this->loadFeed();
    }

    /**
     * Metodo responsavel por carregar dados do feed RSS
     * @return boolean
     */
    private function loadFeed():bool
    {
        $obConfig = new Config();

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $obConfig->getFeedUrl(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET"
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $this->parseXML($response);
    }



    /**
     * Metodo responsavel por criar uma instancia SimpleXML com base em uma string
     * @return boolean
     */
    private function parseXML($response):bool
    {
        if (!strlen($response)) return false;

        $this->feed = simplexml_load_string($response);

        return true;
    }

    /**
     * Metodo responsavel por retornar o titulo do feed
     * @return string
     */
    public function getTitle():string
    {
        return $this->feed->channel->title;
    }

    /**
     * Retorna a descrição
     *
     * @return string
     */
    public function getDescription():string 
    {
        return $this->feed->channel->description;
    }

    /**
     * Retorna a data
     *
     * @return string
     */
    public function getLastUpdate():string
    {
        return $this->feed->channel->lastBuildDate;
    }

    /**
     * Retorna logo
     *
     * @return string
     */
    public function getLogo():string
    {
        return $this->feed->channel->image->url;
    }

    /**
     * Retorna os itens do feed
     *
     */
    public function getItems()
    {
        return $this->feed->channel->item;
    }
}