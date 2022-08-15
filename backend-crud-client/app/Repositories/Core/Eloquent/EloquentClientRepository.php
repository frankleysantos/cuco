<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Support\Facades\Http;


class EloquentClientRepository extends BaseEloquentRepository implements ClientRepositoryInterface
{
    public function entity() 
    {
        return Client::class;
    }

    public function fakeStore($client_id)
    {

    }
}