<?php

namespace App\Services;

use App\Models\Local;

class LocalService
{
    protected $local;

    public function __construct(Local $local)
    {
      $this->local = $local;  
    }

    /**
     * Adiciona um novo usuário.
     *
     * @param array $data
     * @return Local
     */
    public function createLocal(array $data)
    {
        return Local::create($data);
    }

    /**
     * Edita local existente.
     *
     * @param array $data
     * @return User|null
     */
    public function updateLocal(array $data): ?Local
    {
        $local = $this->local->find($data['id']);

        if (!$local) {
            return null;
        }

        $local->nome_local = $data['nome_local'];
        $local->cep = $data['cep'];
        $local->cidade = $data['cidade'];
        $local->rua = $data['rua'];
        $local->numero = $data['numero'];
        $local->save();

        return $local;
    }

     /**
     * Deleta local.
     *
     * @param int $id
     * @return Local
     */
    public function deletarLocal($id)
    {
        $local = Local::find($id);

        if (!$local) {
            return null;
        }

        $local->delete();

        return $local;
    }

    /**
     * Buscar o local pelo cep.
     *
     * @param int $id
     * @return Local
     */
    public function pesquisarLocal($cep)
    {
        return Local::where('cep', $cep)->first();
    }

    /**
     * Listar todos os locais.
     *
     * @param int $id
     * @return Local
     */
    public function localall()
    {
        return Local::all();
    }
}
