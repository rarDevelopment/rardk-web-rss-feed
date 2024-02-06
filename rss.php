<?php header("Content-type: text/xml"); ?>
<rss version='2.0'>
    <channel>
        <title>rardk64</title>
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
            echo "<title>" . $blogPost->title . "</title>";
            echo "<link>https://rardk.com/blog/" . $blogPost->canonicalUrl . "</link>";
            echo "<description>" . $blogPost->description . "</description>";
            echo "</item>";
        }

        function getCorrectDate($item)
        {
            if (!is_null($item->originallyPublishedDate)) {
                return $item->originallyPublishedDate;
            }
            return $item->publishedAt;
        }

        ?>
    </channel>
</rss>
