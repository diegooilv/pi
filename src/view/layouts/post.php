<?php

function renderPost($postView)
{
    $post = $postView->getPost();
    $author = $postView->getAuthor();

    $postId = (int) ($post['id'] ?? 0);
    $title = htmlspecialchars($post['title'] ?? '', ENT_QUOTES, 'UTF-8');
    $image = htmlspecialchars($post['image'] ?? '', ENT_QUOTES, 'UTF-8');
    $body = nl2br(htmlspecialchars($post['body'] ?? '', ENT_QUOTES, 'UTF-8'));
    $authorImage = htmlspecialchars($author['image_url'] ?? '', ENT_QUOTES, 'UTF-8');
    $authorUsername = htmlspecialchars($author['username'] ?? '', ENT_QUOTES, 'UTF-8');
    $authorPath = rawurlencode($author['username'] ?? '');

    return "
    <article class='post' id='post-{$postId}'>

        <a class='post-wrapper' href='/post/{$postId}'>

            <div class='post-content'>

                <h2 class='post-title'>{$title}</h2>

                <img
                    class='post-banner'
                    src='{$image}'
                    alt='{$title}'
                >

                <p class='post-description'>
                    {$body}
                </p>

            </div>

        </a>

        <div class='post-content'>

            <div class='post-author'>

                <img
                    class='post-author-img'
                    src='{$authorImage}'
                    alt='{$authorUsername}'
                >

                <a
                    href='/user/{$authorPath}'
                    class='post-author-name'
                >
                    {$authorUsername}
                </a>

            </div>

            <a
                class='post-btn-report'
                href='/report/post/{$postId}'
            >
                Report
            </a>

        </div>

    </article>
    ";
}
