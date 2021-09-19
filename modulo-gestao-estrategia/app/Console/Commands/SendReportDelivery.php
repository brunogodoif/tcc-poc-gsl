<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Mailgun\Mailgun;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;


class SendReportDelivery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de relatórios de entregas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $from;
    private $domain;
    private $api_key;

    public function __construct()
    {
        parent::__construct();
        $this->from = 'no-reply@example.com';
        $this->domain = "agodoiimoveis.com.br";
        $this->from = "no-reply@" . $this->domain;
        $this->api_key = env('MAILGUN_KEY', 'key-4c7b047cc760d1ee6d4ede297728bc4d');
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //TODO - RECUPERAR DADOS PARA O RELATORIO VINDO DO MODULO DE DW-BI

        $url = 'nginx-service-dw-bi/api/report';
        $response = Http::get($url, ['date' => Carbon::now()->format('Y-m-d')]);

        if ($response->getStatusCode() != 200) {
            echo ("API Service DW-BI request failed");
            return false;
        }

        $resultBodyRequest = (array) json_decode($response->getBody()->getContents());

        $data = (object) array_merge($resultBodyRequest, ['user' => (object)['name' => 'Bruno Godoi', 'email' => 'brunofgodoi@outlook.com.br']]);

        $html_message = View::make('mail.report.report')->with('data', $data)->render();
        $mg = Mailgun::create($this->api_key); // For US servers
        $mg->messages()->send($this->domain, [
            'from'    => $this->from,
            'to'      => 'brunofgodoi@outlook.com.br, diogooliveiracoelho@gmail.com',
            'subject' => 'Relatório de entregas - ' . Carbon::now()->format('d/m/Y'),
            'html'    => $html_message
        ]);
    }
}
