<?php
namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;
use HelpersCuco;
use Illuminate\Http\Request;

class ClientServices
{
    private $repo;

    public function __construct(ClientRepositoryInterface $repo)
    {
       $this->repo = $repo; 
    }
    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getEntity($id = null, $full_name = null, $cpf = null)
    {
        return $this->repo->getEntity($id, $full_name, $cpf);
    }

    public function store($request)
    {
        try {
            $clientData = $request->all();
            $birthDate = HelpersCuco::formatDate('24/07/1994');
            $clientData['birth_date'] = $birthDate;
            $client = $this->repo->store($clientData);
            $message = $client;
            if( !isset($client->id))
                $message = 'Erro ao cadastrar Cliente.';
            return $message;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

	public function update($request)
    {
        $clientData = $request->all();
        $clientExists = $this->repo->getEntity((int)$clientData['id']);
        if ($clientExists) {
            $client = $this->repo->update(new Request($clientData));
            $message = $clientData;
            if( $client == 0)
                $message = 'Erro ao atualizar cliente.';
            return $message;
        }
        return 'Cliente não cadastrado.';
    }

	public function delete($id)
    {
        $clientExists = $this->repo->getEntity($id);
        if (isset($clientExists)) {
            $this->repo->delete($id);
            $message = "Cliente deletado com sucesso.";
        } else {
            $message = 'Cliente não existe';
        }
        return $message;
    }
}