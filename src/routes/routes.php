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

