<?php

namespace App\Http\Controllers\user;

use App\Events\NewUserCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AgeMiddleware;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\UserStoreRequest;
use App\Jobs\SendMail;

class UserController extends Controller
{

    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->userRepository->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->all();
        $newUser = $this->userRepository->store($data);
        // dispatch(new SendMail($newUser));
        event(new NewUserCreated($newUser));

        Cache::put($newUser, $newUser->name, 60);

        return response('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware(AgeMiddleware::class);
        return $this->userRepository->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->authorize('update', $this->userRepository->find($id));

        $this->userRepository->update($id, $request->all());

        return response('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('update', $this->userRepository->find($id));

        $this->userRepository->delete($id);

        return response('success', 200);

    }
}
