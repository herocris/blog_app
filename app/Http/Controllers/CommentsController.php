<?php

namespace App\Http\Controllers;

use App\Events\CommentWasCreated;
use Illuminate\Http\Request;
use App\Models\Comments;
use Egulias\EmailValidator\Warning\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'email' => 'required',
                'autor' => 'required',
                'autor_email' => 'required|email',
                'body' => 'required',
                'post_id' => 'required'
            ],
            [
                'autor.required' => 'Debe ingresar su nombre.',
                'autor_email.required' => 'Debe ingresar un correo.',
                'autor_email.email' => 'Debe ingresar un correo valido.',
                'body.required' => 'El comentario no puede ir vacio.'
            ]


        );
        $comment = [
            'email' => $request->email,
            'name' => $request->email
        ];
        $body=$request->body;

        Comments::create($data); //Crea el comentario
        CommentWasCreated::dispatch($comment,$body); //envia el correo
        return redirect()->back();
    }
}
