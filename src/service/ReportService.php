<?php
class ReportService
{

    public function getMaterial($id)
    {
        return new MaterialModel(
            1,
            "Nietzsche",
            1,
            "Nietzsche lindo",
            "/assets/images/post.png",
            "https://pt.wikipedia.org/wiki/Friedrich_Nietzsche.doc"
        );

    }
    //
    public function getPost($id)
    {
        return new PostModel(
            1,
            1,
            1,
            "O que é realmente a realidade?",
            "Uma reflexão sobre como percebemos o mundo e se ele existe independente da nossa consciência.",
            "/assets/images/post.png",
            ["https://pt.wikipedia.org/wiki/Realidade.pdf"]
        );
    }

    public function getAuthor($id)
    {
        return new UserModel(
            1,
            "Diego",
            "diegooilv",
            "diego@noesis.com",
            "password",
            "oioi",
            "/assets/users/diego.png",
            "admin"
        );
    }
}