<?php header("Content-type: application/xml; charset=utf-8"); ?>
<?php echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>" ?>
<?php echo "<?xml-stylesheet href=\"/rss/rss.xsl\" type=\"text/xsl\"?>" ?>
<rss version='2.0'>
    <channel>
        <title>rardk64 Blog</title>
        <link>https://rardk.com/blog/</link>
        <description>The rardk64 blog, where I write about video games, technology, and whatever else I'm feeling.</description>
        <language>en-us</language>

        <?php

        $url = "https://rardk64-bot-api.com/api/blog/posts/";

        $response = file_get_contents($url);

        $json = json_decode($response);

        usort($json, function ($a, $b) {
            $dateToCheckA = getCorrectDate($a);
            $dateToCheckB = getCorrectDate($b);

            return strcmp($dateToCheckB, $dateToCheckA);
        });

        foreach ($json as $blogPost) {
            echo "<item>";
            echo "<title>" . htmlentities($blogPost->attributes->title) . "</title>";
            echo "<link>https://rardk.com/blog/" . $blogPost->attributes->canonicalUrl . "</link>";
            echo "<description>" . htmlentities($blogPost->attributes->description) . "</description>";
            echo "<pubDate>" . getCorrectDate($blogPost) . "</pubDate>";
            echo "</item>";
        }

        function getCorrectDate($item)
        {
            if (!is_null($item->attributes->originallyPostedDate)) {
                return $item->attributes->originallyPostedDate;
            }
            return $item->attributes->publishedAt;
        }

        ?>
    </channel>
</rss>
