<?php header("Content-type: text/xml"); ?>
<?php echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>" ?>
<rss version='2.0'>
    <channel>
        <title>rardk64</title>
        <link>https://rardk.com/links/</link>
        <description>The links that I find interesting enough to share.</description>
        <language>en-us</language>

        <?php

        $url = "https://raw.githubusercontent.com/rarDevelopment/rardk-web-json-files/main/links.json";

        $response = file_get_contents($url);

        $json = json_decode($response);

        usort($json, function ($a, $b) {
            return strcmp($b->dateShared, $a->dateShared);
        });

        foreach ($json as $link) {
            echo "<item>";
            echo "<title>" . htmlentities($link->title) . "</title>";
            echo "<link>" . $link->link . "</link>";
            echo "<description>" . htmlentities($link->description) . "</description>";
            echo "<pubDate>" . $link->dateShared . "</pubDate>";
            echo "</item>";
        }

        ?>
    </channel>
</rss>
