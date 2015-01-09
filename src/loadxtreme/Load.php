<?php namespace Loadxtreme;

use Goutte\Client;

class Load
{
    private $uid;
    private $pik;
    private $pc;
    private $cellno;
    private $email;

    /**
     * Set necessary loadxtreme info.
     *
     * @param string $uid
     * @param string $pik
     * @param string $pc
     * @param string $cellno
     * @param string $email
     */
    public function __construct($uid = '', $pik = '', $pc = '', $cellno = '', $email = '')
    {
        $this->uid = $uid;
        $this->pik = $pik;
        $this->pc = $pc;
        $this->cellno = $cellno;
        $this->email = $email;
    }

    /**
     * Execute load request.
     *
     * @return array
     */
    public function execute()
    {
        $client = new Client();
        $client->getClient()->setDefaultOption('verify', false);
        $crawler = $client->request('GET', 'https://loadxtreme.ph/cgi-bin/webload.cgi?state=webload');
        $form = $crawler->selectButton('SEND LOAD')->form();
        $crawler = $client->submit($form, array(
            'state' => 'webload',
            'step' => '1',
            'webtype' => '',
            'uid' => $this->uid,
            'pik' => $this->pik,
            'pc' => $this->pc,
            'cellno' => $this->cellno,
            'email' => $this->email
        ));

        return $this->response($crawler->html());
    }

    /**
     * Parse HTML response from a HTTP request, then
     * return a friendly array containing information about the load request.
     *
     * @note $response['status'] can be true or false.
     * @note $response['code'] can be SUCCESS, FAIL or REQUEST_ERROR
     * @note $response['message'] contains the response message.
     *
     * @param $html
     * @return mixed
     */
    private function response($html)
    {
        // Set default response.
        $response['status'] = false;
        $response['code'] = 'REQUEST_ERROR';
        $response['message'] = 'There is something wrong with the request.';

        // Parse HTML for response message.
        preg_match("/<!--RESULT-S-->(.*?)<!--RESULT-E-->/s", $html, $found);

        // Get message.
        $message = isset($found[1]) ? trim($found[1]) : '';

        // If success, set status = true.
        if (strstr($message, 'request has been queued') !== false) {
            $response['status'] = true;
            $response['code'] = 'SUCCESS';
        } else {
            $response['status'] = false;
            $response['code'] = 'FAIL';
        }

        // If message is not empty, update the response message.
        if ($message) {
            $response['message'] = $message;
        }

        return $response;
    }
}
#END OF PHP FILE