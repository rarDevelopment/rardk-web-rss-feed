<?php header("Content-type: application/xml; charset=utf-8");
header('X-Content-Type-Options: nosniff'); ?>
<?php echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>" ?>
<?php echo "<?xml-stylesheet href=\"/rss/rss.xsl\" type=\"text/xsl\"?>" ?>

<?php include '../var.php'; ?>

<rss version='2.0'>
    <channel>
        <title>rardk64's Shared Links</title>
        <link><?php echo $frontendSite . "/links/" ?></link>
        <description>The links that I find interesting enough to share.</description>
        <language>en-us</language>

        <?php

        $url = $sharedSite . "/json/links.json";

        $response = file_get_contents($url);

        $json = json_decode($response);

        usort($json, function ($a, $b) {
            return strcmp($b->dateShared, $a->dateShared);
        });

        foreach ($json as $link) {
            $date = new DateTime($link->dateShared);
            echo "<item>";
            echo "<title>" . htmlentities($link->title) . "</title>";
            echo "<link>" . $frontendSite . "/links/" . $link->slug . "</link>";
            echo "<description>" . htmlentities($link->description) . "</description>";
            echo "<pubDate>" . $date->format(DateTime::RFC2822) . "</pubDate>";
            echo "<guid>" . $frontendSite . "/links/" . $link->slug . "</guid>";
            echo "</item>";
        }

        ?>
    </channel>
</rss>
