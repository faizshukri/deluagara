<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('home'));
});

// Home > People
Breadcrumbs::register('people', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('People', route('people.index'));
});


// Home > People > [User]
Breadcrumbs::register('person', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('people');
    $breadcrumbs->push($user->username, route('profile', $user->username));
});

//// Home > Blog
//Breadcrumbs::register('blog', function($breadcrumbs)
//{
//    $breadcrumbs->parent('home');
//    $breadcrumbs->push('Blog', route('blog'));
//});
//
//// Home > Blog > [Category]
//Breadcrumbs::register('category', function($breadcrumbs, $category)
//{
//    $breadcrumbs->parent('blog');
//    $breadcrumbs->push($category->title, route('category', $category->id));
//});
//
//// Home > Blog > [Category] > [Page]
//Breadcrumbs::register('page', function($breadcrumbs, $page)
//{
//    $breadcrumbs->parent('category', $page->category);
//    $breadcrumbs->push($page->title, route('page', $page->id));
//});