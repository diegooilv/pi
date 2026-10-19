<?php
function renderHeader(
    array $items,
    string $ulClass = "header-menu",
    string $liClass = "header-item",
    string $aClass = "header-link"
) {
    $ulClass = htmlspecialchars($ulClass, ENT_QUOTES, 'UTF-8');
    $liClass = htmlspecialchars($liClass, ENT_QUOTES, 'UTF-8');
    $aClass = htmlspecialchars($aClass, ENT_QUOTES, 'UTF-8');
    $html = "<header class='header'>";
    $html .= "<a href='/' class='header-image'><img src='/assets/noesis.png' alt='Logo do Site'></a>";
    $html .= "<ul class='{$ulClass}'>";

    foreach ($items as $text => $item) {
        $link = is_array($item) ? $item['href'] : $item;
        $extraClass = is_array($item) ? $item['class'] : '';

        $link = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        $extraClass = htmlspecialchars($extraClass, ENT_QUOTES, 'UTF-8');

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
