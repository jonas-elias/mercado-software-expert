<?php

use ExpertFramework\Http\Router\Router;

/**
 * @api api
 */
Router::get('/api', 'Api\Docs\SwaggerController@yaml');
Router::get('/api/docs', 'Api\Docs\SwaggerController@doc');

/**
 * @api produto
 */
Router::post('/api/produto', 'Api\Produto\ProdutoController@insereProduto');
Router::get('/api/produto', 'Api\Produto\ProdutoController@getProdutos');
Router::put('/api/produto/{id}', 'Api\Produto\ProdutoController@atualizaProduto');
Router::get('/api/produto/{id}', 'Api\Produto\ProdutoController@getProdutoById');
Router::delete('/api/produto/{id}', 'Api\Produto\ProdutoController@deleteProdutoById');

/**
 * @api tipoProduto
 */
Router::post('/api/tipoProduto', 'Api\Produto\TipoProdutoController@insereTipoProduto');
Router::get('/api/tipoProduto', 'Api\Produto\TipoProdutoController@getTiposProdutos');
Router::put('/api/tipoProduto/{id}', 'Api\Produto\TipoProdutoController@atualizaTipoProduto');
Router::get('/api/tipoProduto/{id}', 'Api\Produto\TipoProdutoController@getTipoProdutoById');
Router::delete('/api/tipoProduto/{id}', 'Api\Produto\TipoProdutoController@deleteTipoProdutoById');

/**
 * @api imposto
 */
Router::post('/api/imposto', 'Api\Imposto\ImpostoController@insereImposto');
Router::get('/api/imposto', 'Api\Imposto\ImpostoController@getImpostos');
Router::put('/api/imposto/{id}', 'Api\Imposto\ImpostoController@atualizaImposto');
Router::get('/api/imposto/{id}', 'Api\Imposto\ImpostoController@getImpostoById');
Router::delete('/api/imposto/{id}', 'Api\Imposto\ImpostoController@deleteImpostoById');

/**
 * @api venda | itemVenda
 */
Router::post('/api/venda', 'Api\Venda\VendaController@insereVenda');
Router::get('/api/venda', 'Api\Venda\VendaController@getVendas');
Router::post('/api/itemVenda', 'Api\Venda\ItemVendaController@insereItensVenda');
