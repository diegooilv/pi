<?php
function renderHeader(
    array $items,
    string $ulClass = "header-menu",
    string $liClass = "header-item",
    string $aClass = "header-link"
) {
    $html = "<header class='header'>";
    $html .= "<a href='/' class='header-image'><img src='/assets/noesis.png' alt='Logo do Site'></a>";
    $html .= "<ul class='{$ulClass}'>";

    foreach ($items as $text => $item) {
        $link = is_array($item) ? $item['href'] : $item;
        $extraClass = is_array($item) ? $item['class'] : '';

        $link = htmlspecialchars($link);
        $text = htmlspecialchars($text);

        $html .= "
            <li class='{$liClass}'>
                <a class='{$aClass} {$extraClass}' href='{$link}'>{$text}</a>
            </li>
        ";
    }

    $html .= "</ul>";
    $html .= "</header>";

    return $html;
}