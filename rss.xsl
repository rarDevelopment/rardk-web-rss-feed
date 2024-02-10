<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="3.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">
    <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <title>
                    <xsl:value-of select="/rss/channel/title"/>
                </title>
                <meta charset="UTF-8" />
                <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1" />
                <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,shrink-to-fit=no" />
                <link rel="stylesheet" href="/rss/rss.css" />
            </head>
            <body>
                <div class="page-container">
                    <header class="page-header">
                        <div class="avatar-container">
                            <a href="/">
                                <img class="avatar" src="/assets/rarvatar.png" />
                            </a>
                        </div>
                        <h1 class="name">
                            <xsl:value-of select="/rss/channel/title"/>
                        </h1>
                        <div class="with-border">
                            <span class='bold'>To Subscribe:</span> Copy the URL from this page and paste it in your RSS reader.
                        </div>
                        <p class="feed-description">
                            <xsl:value-of select="/rss/channel/description"/>
                        </p>
                        <p class="feed-description">
                            <a hreflang="en" target="_blank">
                                <xsl:attribute name="href">
                                    <xsl:value-of select="/rss/channel/link"/>
                                </xsl:attribute>
                                <xsl:value-of select="/rss/channel/title"/>
 on my site
 &#x2192;
                            </a>
                        </p>
                    </header>
                    <main>
                        <div class="body-container">
                            <xsl:for-each select="/rss/channel/item">
                                <article class="blog-post">
                                    <div class="blog-post-summary">
                                        <h3>
                                            <a hreflang="en" target="_blank">
                                                <xsl:attribute name="href">
                                                    <xsl:value-of select="link"/>
                                                </xsl:attribute>
                                                <xsl:value-of select="title"/>
                                            </a>
                                        </h3>
                                        <p>
                                            <xsl:value-of select="description" />
                                        </p>
                                        <p class="displayed-date">
                                            <xsl:value-of select="pubDate" />
                                        </p>
                                    </div>
                                </article>
                            </xsl:for-each>
                        </div>
                    </main>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
