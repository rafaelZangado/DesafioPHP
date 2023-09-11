<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocalRequest;
use App\Services\LocalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    protected $localService;

    public function __construct(LocalService $local)
    {
        $this->localService = $local;
    }

     /**
     * Adiciona um novo local.
     *
     * @param LocalRequest $request
     * @return JsonResponse
     */
    public function addLocal(LocalRequest $request): JsonResponse
    {
        $input = $request->validated();
        $local = $this->localService->createLocal($input);

        return response()->json([
            'message' => 'Endereço registrado com sucesso.',
            'local' => $local
        ], 201);
    }

     /**
     * Editar local.
     *
     * @param LocalRequest $request
     * @return JsonResponse
     */
    public function editarLocal(LocalRequest $request, $id): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['id'] = $id;
        $local = $this->localService->updateLocal($validatedData);

        return response()->json([
            'message' => 'Endereço alterado com sucesso.',
            'local' => $local
        ], 201);
    }

    /**
     * Deleta local.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deletarLocal($id): JsonResponse
    {
        $local = $this->localService->deletarLocal($id);

        if (!$local) {
            return response()->json([
                'error' => 'Endereço não encontrado'
            ], 404);
        }

        return response()->json([
            'message' => 'Endereço excluído com sucesso',
            'local' => $local
        ], 200);
    }

    /**
     * Pesquisa o local pelo cep.
     *
     * @param int $cep
     * @return JsonResponse
     */
    public function pesquisarLocal(Request $cep): JsonResponse
    {

        $local = $this->localService->pesquisarLocal($cep['cep']);

        if (!$local) {
            return response()->json([
                'error' => 'Endereço não encontrado'
            ], 404);
        }

        return response()->json([
            'message' => 'Endereço encontrado com sucesso',
            'local' => $local
        ], 200);
    }
    
    /**
     * Lista todos os locais.
     *
     * @param
     * @return JsonResponse
     */
    public function listarLocal(): JsonResponse
    {
        $local = $this->localService->localall();
        return response()->json($local);
    }

}
