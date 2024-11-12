<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InertiaController extends Controller
{
    public function mesas(){
        $sql = <<<SQL
            select distinct on (1)
                pedido_cab.id_mesa,
                pedido_cab.pedido_aberto,
                round(cast((select sum(pedido_det.quantidade * pedido_det.preco) from pedido_det where pedido_det.id_pedido = pedido_cab.id) as numeric),2)as valor_total,
                garcom.nome as garcom,
                cliente.nome as cliente
            from pedido_cab 
            join pessoas cliente  on 
                cliente.id = pedido_cab.id_cliente
            join pessoas garcom on 
                garcom.id = pedido_cab.id_funcionario
            group by pedido_cab.id_mesa,pedido_cab.pedido_aberto,garcom.nome,cliente.nome,valor_total
        SQL;
    
        $mesas = DB::select($sql);

        return Inertia::render('Mesas/list',[
            "Mesas" => $mesas
        ]);
    }

    public function editarPedido(string $id)
    {
        $sql = <<<SQL
            select 
                pedido_cab.id,
                pedido_cab.id_mesa,
                pedido_cab.pedido_aberto,
                round(cast((select sum(pedido_det.quantidade * pedido_det.preco) from pedido_det where pedido_det.id_pedido = pedido_cab.id)as numeric),2) as valor_total,
                garcom.nome as garcom,
                cliente.nome as cliente,
                pedido_cab.pedido_aberto
            from pedido_cab 
            join pessoas cliente  on 
                cliente.id = pedido_cab.id_cliente
            join pessoas garcom on 
                garcom.id = pedido_cab.id_funcionario
            where pedido_cab.id = $id
        SQL;

        $pedido = DB::select($sql);

        $sql = <<<SQL
            select 
                produtos.descricao,
                pedido_det.* 
            from 
                pedido_det 
            join produtos on 
                produtos.id = pedido_det.id_produto
            where 
                pedido_det.id_pedido = $id
        SQL;

        $Produtos = DB::select($sql);
        $produtosCadastrados = Produto::all();

        return Inertia::render('Pedidos/edit',
        [
            'PedidoBD'=>$pedido,
            'ProdutosBD'=>$Produtos,
            'ProdutosCadastrados'=> $produtosCadastrados
        ]);
    }

    public function produtos(){
        $produtos = Produto::all();

        return Inertia::render('Produtos/list',[
            "Produtos" => $produtos
        ]);
    }

    public function editarProduto(Request $request , string $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->update($request->all());

        return response()->json($produto);
    }
    
    public function pessoas(){
        $pessoas = Pessoa::all();
        
        return Inertia::render('Pessoas/list',[
            'Pessoas' => $pessoas
        ]);
    }

    public function editarPessoa(Request $request , string $id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->update($request->all());
    
        return response()->json($pessoa);
    }

    public function listaPedidos(){
        $sql = <<< sql
            select
                pedido_cab.id,
                pedido_cab.id_cliente,
                pessoa.nome as cliente,
                pedido_cab.id_funcionario,  
                pessoa2.nome as garcom  ,
                (select sum(pedido_det.quantidade * pedido_det.preco) from pedido_det where pedido_det.id_pedido = pedido_cab.id) as valor_total,
                pedido_cab.id_mesa,
                pedido_cab.pedido_aberto
            from pedido_cab
            join pessoas pessoa on 
                pedido_cab.id_cliente = pessoa.id
            join pessoas pessoa2 on 
                pedido_cab.id_funcionario = pessoa2.id
        sql;

        $pedidos = DB::select($sql);

        return Inertia::render('Pedidos/list',
                ['Pedidos' => $pedidos]
        );
    }

    public function inserirProdutos(Request $request , string $id)
    {
        $sql = <<< SQL
            insert into 
                pedido_det (id_produto,id_pedido,quantidade,preco) 
            values 
                (?,$id,?,?);
        SQL;

        foreach($request->request as $pedido)
        {
            DB::select($sql,[$pedido['id'],$pedido['quantidade'],$pedido['preco']]);
        }

        return response()->json('Sucesso nas inserções');
    }

    public function editarProdutoPedido(Request $request , string $id)
    {
        $sql = <<< SQL
            update 
                pedido_det 
            set
                quantidade = ? ,
                preco = ?
            where 
                id = ? and id_pedido = ?
        SQL;

        foreach($request->request as $pedido)
        {
            if(isset($pedido['id']))
                DB::update($sql,[$pedido['quantidade'],$pedido['preco'],$pedido['id'],$id]);
        }

        return response()->json('Sucesso nas alterações');
    }

    public function removerProdutosPedido(Request $request , string $id)
    {
        $sql = <<< SQL
            delete from 
                pedido_det 
            where 
                id = ? and id_pedido = ?
        SQL;

        foreach($request->request as $pedido)
        {
            if(isset($pedido['id']))
                DB::update($sql,[$pedido['id'],$id]);
        }

        return response()->json('Sucesso nas remoções');
    }

}
