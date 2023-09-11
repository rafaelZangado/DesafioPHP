<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h1>Projeto.</h1>
<lable>
    Esse é um projeto com nivel de autenticação para o acesso via API.
</lable>

<h2> #versão do sistema</h2>
<ul>
  <li>Versão do PHP: 8.1</li>
  <li>Versão Laravel 9</li>
</ul>
<hr>
<h2> #configuração</h2>
<ol>
    <li>abra o terminal e digite o comando: <i>php artisan serve</i></li>
    <li>abra um novo terminal e digite os comandos: <i>php artisan migrate</i> para criação das tabelas </li>
    <li>Digite <i>php artisan migrate --seed</i> para criação do Admin </li>    
</ol>
<hr>
<h2> #Considerações.</h2>
<label>
    na regr de negocio da aplicação cada usuario foi definido com os esquites nives de acesso.
</label>
   <p> Nivel : 1 pode => ['editar', 'deletar', 'listar', 'register'],</p>

   <p>Nivel: 2 => ['editar', 'deletar', 'listar'],</p>

   <p>Nivel: 3 => ['listar'],</p>


 
 
