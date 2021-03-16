<?php

namespace App\Http\Controllers\v1\Manager;

use App\Http\Controllers\Controller;
use App\Models\v1\Manager\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContaController extends Controller
{
    private $model = Conta::class;

    private $storeRules =  [
            'nome' => 'required|min:3|max:255',
            'cep' => 'required|min:10|max:10',
            'endereco' => 'required|min:10|max:255',
            'bairro' => 'required|min:2|max:255',
            'cidade' => 'required|min:3|max:255',
            'estado' => 'required|min:2|max:2',
            'pais' => 'required|min:2|max:100',
            'tipo' => 'required|min:1|max:1',
            'cpf_cnpj' => 'required|min:14|max:18',
            'nome_responsavel' => 'required|min:3|max:255',
            'sobrenome_responsavel' => 'required|min:2|max:255',
            'telefone_responsavel' => 'required|min:14|max:15',
            'email_responsavel' => 'required|min:9|max:100',
            'dominio' => 'required|min:15|max:100|unique:contas',
            'database' => 'required|min:2|max:100|unique:contas',
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

        if( $request->input('dominio') == 'ws.ignistool.com' || $request->input('dominio') == 'gerenciador.ignistool.com'  ){
            return response()->json([
                'dominio' => 'Este dominio não está disponível'
            ], 400);
        }

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $modelCreate = $this->model::create($request->all());

            DB::statement("
                CREATE DATABASE {$request->input('database')} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
            ");

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
