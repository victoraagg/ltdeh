const settings = {
  "name": "ltdeh-pwa",
  "state": {
    "frontity": {
      "url": "https://www.latorredestebanhambran.es",
      "title": "LTDEH Frontity",
      "description": "WordPress installation for LTDEH PWA development"
    }
  },
  "packages": [
    {
      "name": "@frontity/mars-theme",
      "state": {
        "theme": {
          "menu": [
            [
              "Inicio",
              "/"
            ],
            [
              "Información",
              "/categoria/informacion/"
            ],
            [
              "Empleo",
              "/categoria/empleo/"
            ],
            [
              "Aviso Legal",
              "/aviso-legal/"
            ]
          ],
          "featured": {
            "showOnList": false,
            "showOnPost": false
          }
        }
      }
    },
    {
      "name": "@frontity/wp-source",
      "state": {
        "source": {
          "api": "https://www.latorredestebanhambran.es/wp-json"
        }
      }
    },
    "@frontity/tiny-router",
    "@frontity/html2react"
  ]
};

export default settings;
