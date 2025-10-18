<?php

// use Diglactic\Breadcrumbs\Facades\Breadcrumbs;
use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('categories.showAll', function ($trail) {
    $trail->parent('home');
    $trail->push('Kategori', route('categories.showAll'));
});

Breadcrumbs::for('category.show', function ($trail, $category) {
    $trail->parent('categories.showAll');
    $trail->push($category->name, route('category.show', $category->slug));
});

Breadcrumbs::for('genres.show', function ($trail, $category, $genre) {
    $trail->parent('category.show', $category);
    $trail->push($genre->name, route('category.genres', [$category->slug, $genre->slug]));
});