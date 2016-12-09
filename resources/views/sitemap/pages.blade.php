<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset 
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	 xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
	 >
	<url>
    	<loc>{{ app_url() }}/home</loc>
        <lastmod>{{ $lastMod }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
	</url>
	<url>
    	<loc>{{ app_url() }}/about</loc>
        <lastmod>{{ $lastMod }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
        <image:image>
         <image:loc>{{ app_url() }}/images/Eric_Scuccimarra_cropped.jpg</image:loc>
         <image:caption>Eric Scuccimarra</image:caption>
         <image:title>Eric Scuccimarra</image:title>
       </image:image>
	</url>
	<url>
    	<loc>{{ app_url() }}/about/cv</loc>
        <lastmod>{{ $lastMod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
	</url>
	<url>
    	<loc>{{ app_url() }}/about/contact</loc>
        <lastmod>{{ $lastMod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
	</url>
	<url>
    	<loc>{{ app_url() }}/blog</loc>
        <lastmod>{{ $lastMod }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
	</url>
	<url>
    	<loc>{{ app_url() }}/projects</loc>
        <lastmod>{{ $lastMod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
	</url>
	<url>
    	<loc>{{ app_url() }}/records</loc>
        <lastmod>{{ $lastMod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
	</url>
	<url>
    	<loc>{{ app_url() }}/records/api</loc>
        <lastmod>{{ $lastMod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
	</url>
	<url>
    	<loc>{{ app_url() }}/sudoku</loc>
        <lastmod>{{ $lastMod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
	</url>
</urlset>