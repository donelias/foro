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
}