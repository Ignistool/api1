<?php

namespace App\Models\v1\Manager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'logo',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'pais',
        'tipo',
        'cpf_cnpj',
        'inscricao_estadual',
        'razao_social',
        'nome_fantasia',
        'nome_responsavel',
        'sobrenome_responsavel',
        'telefone_responsavel',
        'email_responsavel',
        'dominio',
        'database',
    ];
}
