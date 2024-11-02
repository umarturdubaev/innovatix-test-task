<?php

namespace App\Livewire;

use App\Jobs\CheckDomainJob;
use Livewire\Component;
use App\Contracts\DomainInterface;

class DomainChecker extends Component
{
    public $domainInput = ''; // Поле для ввода домена
    public $domains = [
        'google.com',
        'yahoo.com',
        'facebook.com',
        'twitter.com',
        'instagram.com',
        'yandex.ru',
        'github.com',
    ]; // Массив доменов
    public $results = []; // Массив результатов проверки

    protected $listeners = ['echo:domain-checked,DomainChecked' => 'updateResults'];
    public function addDomain()
    {
        if ($this->domainInput) {
            $this->domains[] = $this->domainInput;
            $this->domainInput = '';
        }
    }

    public function clearDomains()
    {
        $this->domains = [];
    }

    public function checkDomains()
    {
        $this->results = [];
        foreach ($this->domains as $domain) {
            CheckDomainJob::dispatch(app(DomainInterface::class), $domain);
        }
    }

    public function updateResults($eventData)
    {
        $this->results[] = $eventData['result'];
    }

    public function render()
    {
        return view('livewire.domain-checker');
    }
}
