<?php


class CreatePostsTest extends FeatureTestCase
{
    //Test a user create a post / usuario crea post
    public function test_a_user_create_a_post()
    {
        // Having / Lo que tenemos
        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';

        //crear usuario
        $user = $this->defaultUser();

        //usuario conectado
        $this->actingAs($user);

        // When / los eventos de la prueba
        $this->visit(route('posts.create'))
            ->type($title, 'title')
            ->type($content, 'content')
            ->press('Publicar');


        // Then / resultado
        //verificacion de creacion de registro en DB
        $this->seeInDatabase('posts', [
            'title'     => $title,
            'content'   => $content,
            'pending'   => true,
            'user_id'   => $user->id,
        ]);


        // Test a user ir redirected to the post details affter creating it.
        //comprovar que el usuario fue redirigido
        $this->see($title);
        //$this->seeInElement('h1', 'Esta es una pregunta');
    }


    //Verificar restriccion de acceso y redireccion  al login
    function test_creating_a_post_requires_authentication()
    {

       // verificar si el usuario esta conectado
        $this->visit(route('posts.create'))
           ->seePageIs(route('login'));
    }


    //validacion de formulario
    function test_create_post_form_validation()
    {
        $this->actingAs($this->defaultUser())
            ->visit(route('posts.create'))
            ->press('Publicar')
            ->seePageIs(route('posts.create'));

    }
}