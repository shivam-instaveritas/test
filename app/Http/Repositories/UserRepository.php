<?php

namespace App\Http\Repositories;

use App\User;

class UserRepository{

    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function store($data)
    {
        return User::create($data);
    }

    public function update($id, $data)
    {
        return $this->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
