<?php

namespace App\Http\Controllers\v1\Manager;

use App\Http\Controllers\Controller;
use App\Models\v1\Manager\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    private $model = User::class;

    private $storeRules =  [
        'name' => 'required|min:2|max:255',
        'email' => 'required|min:2|max:255|unique:users',
        'password' => 'required|min:6|max:100',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->storeRules, $this->getValidatorMessages());

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $modelCreate = $this->model::create($request->all());
            return response()->json($modelCreate, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->model::findOrfail($id);
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
        $model = $this->model::findOrfail($id);
        $model->update($request->all());
        return response()->json($model, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model =  $this->model::findOrfail($id);
        $model->delete();
    }
}
