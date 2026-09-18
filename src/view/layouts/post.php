<?php

function renderPost($postView)
{
    $post = $postView->getPost();
    $author = $postView->getAuthor();

    return "
    <article class='post' id='post-{$post['id']}'>

        <a class='post-wrapper' href='/post/{$post['id']}'>

            <div class='post-content'>

                <h2 class='post-title'>{$post['title']}</h2>

                <img
                    class='post-banner'
                    src='{$post['image']}'
                    alt='{$post['title']}'
                >

                <p class='post-description'>
                    {$post['body']}
                </p>

            </div>

        </a>

        <div class='post-content'>

            <div class='post-author'>

                <img
                    class='post-author-img'
                    src='{$author['image_url']}'
                    alt='{$author['username']}'
                >

                <a
                    href='/user/{$author['username']}'
                    class='post-author-name'
                >
                    {$author['username']}
                </a>

            </div>

            <a
                class='post-btn-report'
                href='/report/post/{$post['id']}'
            >
                Report
            </a>

        </div>

    </article>
    ";
}