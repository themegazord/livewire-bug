<?php

namespace App\Livewire;

use Livewire\Component;

class TestComponent extends Component
{

    public array $endereco = [
        'cep' => null,
        'rua' => null,
        'numero' => null,
        'complemento' => null,
        'bairro' => null,
        'zona_distrito' => null,
        'cidade' => null,
        'uf' => null,
    ];

    public function validaDados()
    {
        dd($this->endereco);
    }

    public function render()
    {
        return view('livewire.test-component');
    }
}
