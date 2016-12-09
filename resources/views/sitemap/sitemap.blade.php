<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ app_url() }}/sitemap/blog</loc>
        <lastmod>{{ $blog->published_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ app_url() }}/sitemap/labels</loc>
        <lastmod>{{ $blog->published_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ app_url() }}/sitemap/pages</loc>
        <lastmod>{{ date("c", strtotime(date("Y-m-01 00:00:00"))) }}</lastmod>
    </sitemap>
</sitemapindex>