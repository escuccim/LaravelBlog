<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

 @foreach ($tags as $tag)
	<url>
    	<loc>{{ app_url() }}/blog/labels/{{ $tag->name }}</loc>
        <lastmod>{{ date("c", strtotime(date("Y-m-01 00:00:00"))) }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
	</url>
@endforeach
</urlset>