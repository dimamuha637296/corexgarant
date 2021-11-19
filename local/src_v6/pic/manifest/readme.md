# Генерация иконок и манифеста

## Чем и где генерируется
Для генерации иконок используется NPM-пакет - https://www.npmjs.com/package/favicons

Логика генерация находится в файле local/src_v6/.service/tasks/manifest/manifest.js

## Настройки
Ключевые настройки генерации находятся в файле local/src_v6/gulpfile.js:35 в переменной manifsetSettings

```
manifsetSettings: {
    iconsFolder: './pic/manifest/', {required: true, default: undefined, type: String} - Папка с иконками для манифеста
    destFolder: opt.DIR + '/manifest' {required: true, default: undefined, type: String} - Конечная директория для манифеста и иконок
    mainIconName: 'main.png', {required: true, default: undefined, type: String} - Имя главной иконки на основе которой генерируются остальные
    excludeIcons: ['apple-touch-icon-1024x1024.png'] {required: false, default: [], type: Array} - Исключённые из генерации файлы
    iconsFileNames: { {required: true, default: [], type: Array} - Имена главных иконок для каждой из платформ
            android: 'android-chrome.png',
            appleIcon: 'apple-touch-icon.png',
            appleStartup: 'apple-touch-startup-image.png',
            coast: 'coast.png',
            favicons: 'favicon.png',
            firefox: 'firefox_app.png',
            windows: 'mstile.png',
            yandex: 'yandex-browser.png',
    }
},
```

## Правила генерации
* В директорию из `manifsetSettings.iconsFolder` помещается главное изображение с именем `manifsetSettings.mainIconName`
* Если в директории имеются другие изображения с именами совпадающими из списка генерируемых иконок (находится ниже) то они исключаются из процесса генерации и копируются в конечную директорию как есть
* Иконки из `manifsetSettings.excludeIcons` исключаются из процесса генерации и копирования (даже если присутствуют в директории)
  
## Пример

### Генерация на основе одной иконки
1. Помещаем в директорию local/src_v6/pic/manifest файл main.png
2. В директории local/templates/.default/manifest будет сгенерирован полный список иконок

### Генерация на основе нескольких иконок
1. Помещаем в директорию local/src_v6/pic/manifest файл main.png
2. Помещаем в директорию local/src_v6/pic/manifest файл favicon.png
3. Помещаем в директорию local/src_v6/pic/manifest файл apple-touch-icon-120x120.png
4. В директории local/templates/.default/manifest будет сгенерирован полный список иконок на основе main.png, favicon иконки будут сгенерированы на основе favicon.png и будет скопирована apple-touch-icon-120x120.png
  
## Список генерируемых иконок
Генерируемые иконки перечислены в конфигурации модуля opt.manifestGenerator.config.icons (https://github.com/itgalaxy/favicons/blob/master/src/config/icons.json)
```
{
  "android": [
    "android-chrome-36x36.png",
    "android-chrome-48x48.png",
    "android-chrome-72x72.png",
    "android-chrome-96x96.png":,
    "android-chrome-144x144.png",
    "android-chrome-192x192.png",
    "android-chrome-256x256.png",
    "android-chrome-384x384.png",
    "android-chrome-512x512.png"
  ],
  "appleIcon": [
    "apple-touch-icon-57x57.png",
    "apple-touch-icon-60x60.png",
    "apple-touch-icon-72x72.png",
    "apple-touch-icon-76x76.png",
    "apple-touch-icon-114x114.png",
    "apple-touch-icon-120x120.png",
    "apple-touch-icon-144x144.png",
    "apple-touch-icon-152x152.png",
    "apple-touch-icon-167x167.png",
    "apple-touch-icon-180x180.png",
    "apple-touch-icon-1024x1024.png",
    "apple-touch-icon.png",
    "apple-touch-icon-precomposed.png"
  ],
  "appleStartup": [
    "apple-touch-startup-image-320x460.png",
    "apple-touch-startup-image-640x920.png",
    "apple-touch-startup-image-640x1096.png",
    "apple-touch-startup-image-748x1024.png",
    "apple-touch-startup-image-750x1294.png",
    "apple-touch-startup-image-768x1004.png",
    "apple-touch-startup-image-1182x2208.png",
    "apple-touch-startup-image-1242x2148.png",
    "apple-touch-startup-image-1496x2048.png"
    "apple-touch-startup-image-1536x2008.png"
  ],
  "coast": [
    "coast-228x228.png"
  ],
  "favicons": [
    "favicon-16x16.png"
    "favicon-32x32.png"
    "favicon.ico"
  [,
  "firefox": [
    "firefox_app_60x60.png",
    "firefox_app_128x128.png",
    "firefox_app_512x512.png"
  ],
  "windows": [
    "mstile-70x70.png",
    "mstile-144x144.png",
    "mstile-150x150.png",
    "mstile-310x150.png",
    "mstile-310x310.png"
  [,
  "yandex": [
    "yandex-browser-50x50.png"
  ]
}
```