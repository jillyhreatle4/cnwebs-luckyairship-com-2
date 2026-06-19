<?php

/**
 * 站点元信息管理 - 提供描述文本生成
 */

function loadSiteMeta(): array
{
    return [
        'site_name' => 'Lucky Airship',
        'domain'    => 'https://cnwebs-luckyairship.com',
        'keywords'  => ['幸运飞艇', '飞艇预测', '实时开奖'],
        'description' => '提供最新幸运飞艇开奖结果与精准预测分析',
        'author'    => 'Meta Team',
        'version'   => '2.1.0',
    ];
}

function generateShortDescription(array $meta): string
{
    $name = htmlspecialchars($meta['site_name'] ?? 'Unknown', ENT_QUOTES | ENT_HTML5);
    $desc = htmlspecialchars($meta['description'] ?? '', ENT_QUOTES | ENT_HTML5);
    $kw   = [];

    if (!empty($meta['keywords']) && is_array($meta['keywords'])) {
        $kw = array_map(function($keyword) {
            return htmlspecialchars($keyword, ENT_QUOTES | ENT_HTML5);
        }, $meta['keywords']);
    }

    $parts = ["站点: $name"];
    if ($desc !== '') {
        $parts[] = $desc;
    }
    if (!empty($kw)) {
        $parts[] = '关键词: ' . implode(', ', $kw);
    }

    return implode(' | ', $parts);
}

$metadata = loadSiteMeta();
$metaText = generateShortDescription($metadata);

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($metadata['site_name'], ENT_QUOTES | ENT_HTML5) ?></title>
    <meta name="description" content="<?= htmlspecialchars($metadata['description'], ENT_QUOTES | ENT_HTML5) ?>">
    <meta name="keywords" content="<?= htmlspecialchars(implode(',', $metadata['keywords']), ENT_QUOTES | ENT_HTML5) ?>">
    <link rel="canonical" href="<?= htmlspecialchars($metadata['domain'], ENT_QUOTES | ENT_HTML5) ?>">
</head>
<body>
    <h1><?= htmlspecialchars($metadata['site_name'], ENT_QUOTES | ENT_HTML5) ?></h1>
    <p>元信息描述：<?= htmlspecialchars($metaText, ENT_QUOTES | ENT_HTML5) ?></p>
    <p>访问 <a href="<?= htmlspecialchars($metadata['domain'], ENT_QUOTES | ENT_HTML5) ?>" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($metadata['domain'], ENT_QUOTES | ENT_HTML5) ?></a></p>
</body>
</html>