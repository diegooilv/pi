<?php
function getMaterialIcon(string $extension): string
{
    $extension = strtolower(trim($extension));

    $base = fn(string $inner) => "
        <svg viewBox='0 0 24 24' class='material-link-icon' fill='none' stroke='currentColor' xmlns='http://www.w3.org/2000/svg' aria-label='Ícone de arquivo'>
            <path d='M6 4a2 2 0 012-2h6l5 5v13a2 2 0 01-2 2H8a2 2 0 01-2-2V4z' 
                  stroke-width='1.5' stroke-linejoin='round'/>
            
            <path d='M14 2v4a2 2 0 002 2h3' 
                  stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/>
            
            <g stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'>
                $inner
            </g>
        </svg>";

    return match ($extension) {
        
        'pdf' => $base("
            <rect x='5' y='11.5' width='14' height='6' rx='1.5' fill='currentColor' stroke='none' opacity='0.15'/>
            <text x='12' y='16' text-anchor='middle' font-size='5.5' font-weight='800' font-family='system-ui, -apple-system, sans-serif' fill='currentColor' stroke='none' letter-spacing='0.5'>PDF</text>
        "),

        'png', 'jpg', 'jpeg', 'gif', 'webp', 'svg' => $base("
            <rect x='7' y='10' width='10' height='8' rx='1.5'/>
            <circle cx='10.5' cy='12.5' r='1' fill='currentColor' stroke='none'/>
            <path d='M7 16.5l2.5-2.5a1.5 1.5 0 012 0L17 19'/>
        "),

        'doc', 'docx', 'txt', 'rtf' => $base("
            <path d='M8 11h8M8 15h8M8 19h5'/>
        "),

        'xls', 'xlsx', 'csv' => $base("
            <rect x='7' y='11' width='10' height='8' rx='1'/>
            <path d='M7 15h10M12 11v8'/>
        "),

        'ppt', 'pptx', 'key' => $base("
            <rect x='7' y='11' width='10' height='6' rx='1'/>
            <path d='M12 17v3M9 20h6'/>
            <path d='M10 14h4'/>
        "),

        'zip', 'rar', '7z', 'tar', 'gz' => $base("
            <path d='M12 8v4' stroke-dasharray='2 2'/>
            <rect x='10.5' y='12' width='3' height='3.5' rx='0.5'/>
            <path d='M12 15.5v3.5'/>
        "),

        'mp4', 'avi', 'mov', 'mp3', 'wav' => $base("
            <rect x='7' y='11' width='10' height='8' rx='1.5'/>
            <path d='M10.5 13.5l3.5 1.5-3.5 1.5v-3z' fill='currentColor' stroke='none'/>
        "),

        'php', 'js', 'html', 'css', 'json', 'xml' => $base("
            <path d='M10 12l-2 2 2 2M14 12l2 2-2 2M13 11l-2 6'/>
        "),

        default => $base("
            <path d='M8 12h8M8 16h5'/>
        "),
    };
}

function renderMaterial($materialView)
{
    $material = $materialView->getMaterial();
    $author = $materialView->getAuthor();

    $url = $material['url'] ?? '';
    $materialId = (int) ($material['id'] ?? 0);
    $title = htmlspecialchars($material['title'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($material['image'] ?? '', ENT_QUOTES, 'UTF-8');
    $description = nl2br(htmlspecialchars($material['description'] ?? '', ENT_QUOTES, 'UTF-8'));
    $safeUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    $authorImage = htmlspecialchars($author['image_url'] ?? '', ENT_QUOTES, 'UTF-8');
    $authorUsername = htmlspecialchars($author['username'] ?? '', ENT_QUOTES, 'UTF-8');
    $authorPath = rawurlencode($author['username'] ?? '');

    $extension = strtolower(
        pathinfo(
            parse_url($url, PHP_URL_PATH),
            PATHINFO_EXTENSION
        )
    );

    $icon = getMaterialIcon($extension);

    return "
    <article class='material' id='material-{$materialId}'>

        <a
            class='material-wrapper'
            href='/material/{$materialId}'
        >

            <div class='material-content'>

                <h2 class='material-title'>{$title}</h2>

                " . ($imageUrl !== '' ? "<img
                    class='material-banner'
                    src='{$imageUrl}'
                    alt='{$title}'
                >" : '') . "

                <p class='material-description'>
                    {$description}
                </p>

            </div>

        </a>

        <div class='material-content'>

            <div class='material-links'>

                " . ($safeUrl !== '' ? "<a
                    class='material-link'
                    href='{$safeUrl}'
                    target='_blank'
                    rel='noopener noreferrer'
                    title='Abrir material'
                >
                    {$icon}
                    <span>Abrir material</span>
                </a>" : '') . "

            </div>

            <div class='material-author'>

                <img
                    class='material-author-img'
                    src='{$authorImage}'
                    alt='{$authorUsername}'
                >

                <a
                    href='/user/{$authorPath}'
                    class='material-author-name'
                >
                    {$authorUsername}
                </a>

            </div>

            <a
                class='material-btn-report'
                href='/report/material/{$materialId}'
            >
                Report
            </a>

        </div>

    </article>
    ";
}
