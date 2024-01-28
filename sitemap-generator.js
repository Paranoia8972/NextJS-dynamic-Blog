const SitemapGenerator = require('sitemap-generator');

// create generator
const generator = SitemapGenerator('https://blog.encryptopia.dev', {
 stripQuerystring: false,
 priorityMap: [1.0, 0.8, 0.6, 0.4, 0.2, 0],
 lastMod: true
});

generator.on('done', () => {
 // sitemaps created
});

// start the crawler
generator.start();
