<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InertiaController extends Controller
{
    public function mesas(){
        $sql = <<<SQL
            select 
                mesas.id,
                mesas.status,
                mesas."quantidadePessoas",
                123.22 as "valorAtual",
                garcom.nome as garcom,
                cliente.nome as cliente
            from mesas 
            join pessoas cliente  on 
                cliente.id = mesas.cliente
            join pessoas garcom on 
                garcom.id = mesas.garcom
        SQL;
    
        $mesas = DB::select($sql);

        return Inertia::render('Mesas/list',[
            "Mesas" => $mesas
        ]);
    }

    public function produtos(){
        $produtos = Produto::all();

        return Inertia::render('Produtos/list',[
            "Produtos" => $produtos
        ]);
    }
    public function editar(Request $request , string $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->update($request->all());

        return response()->json($produto);
    }
}
