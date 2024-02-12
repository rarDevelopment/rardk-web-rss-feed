<?php header("Content-type: application/xml; charset=utf-8");
header('X-Content-Type-Options: nosniff'); ?>
<?php echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>" ?>
<?php echo "<?xml-stylesheet href=\"/rss/rss.xsl\" type=\"text/xsl\"?>" ?>
<rss version='2.0'>
    <channel>
        <title>rardk64's Shared Links</title>
        <link>https://rardk.com/links/</link>
        <description>The links that I find interesting enough to share.</description>
        <language>en-us</language>

        <?php

        $url = "https://rardk.com/json/links.json";

        $response = file_get_contents($url);

        $json = json_decode($response);

        usort($json, function ($a, $b) {
            return strcmp($b->dateShared, $a->dateShared);
        });

        foreach ($json as $link) {
            $date = new DateTime($link->dateShared);
            echo "<item>";
            echo "<title>" . htmlentities($link->title) . "</title>";
            echo "<link>" . $link->link . "</link>";
            echo "<description>" . htmlentities($link->description) . "</description>";
            echo "<pubDate>" . $link->date->format(DateTime::RFC2822) . "</pubDate>";
            echo "</item>";
        }

        ?>
    </channel>
</rss>
