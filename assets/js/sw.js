
'use strict';
importScripts('sw - toolbox.js');
toolbox.precache(["hompage.php", "assets/*"]);
toolbox.router.get('/icons/ *', toolbox.cacheFirst);
toolbox.router.get('/*', toolbox.networkFirst, { networkTimeoutSeconds: 5 });