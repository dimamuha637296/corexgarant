module.exports = {
    parserOptions: {
        "ecmaVersion": 6, // Поддерживаемая версия ECMAScript
        "ecmaFeatures": {
            "experimentalObjectRestSpread": true
        }
    },
    rules: {
        "no-dupe-args": "error", // Запрет дублирования аргументов в функциях - https://eslint.org/docs/rules/no-dupe-args
        "no-constant-condition": "error", // Запрет использования констант в условиях - https://eslint.org/docs/rules/no-constant-condition
        "no-unreachable": "error", // Запрет недостижимого кода - https://eslint.org/docs/rules/no-unreachable
        "no-duplicate-case": "error", // Запрет дублирования case с одинаковым значением - https://eslint.org/docs/rules/no-duplicate-case
        "no-dupe-keys": "error", // Запрет дублирования свойств объекта - https://eslint.org/docs/rules/no-dupe-keys
        "no-empty": "error", // Запрет пустых блоков выражений - https://eslint.org/docs/rules/no-empty
        "no-use-before-define": "error", // Запрет вызова или использования функций и перменых до их объявления - https://eslint.org/docs/rules/no-use-before-define
        "no-unused-vars": [ // Запрет использования неиспользуемых переменных - https://eslint.org/docs/rules/no-unused-vars
            "error",
            {
                "args": "all" //Все аргументы функции должны быть использованы
            }
        ],
        "no-undef-init": "error", // Запрет undefined при инициализации значения переменной - https://eslint.org/docs/rules/no-undef-init
        "no-obj-calls": "error", // Запрет вызова свойств глобальных объектов как функций - https://eslint.org/docs/rules/no-obj-calls
        "no-irregular-whitespace": [
            "error", // Запрет лишних пробелов - https://eslint.org/docs/rules/no-irregular-whitespace
            {
                "skipStrings": true, // Разрешить в строках
                "skipComments": true // Разрешить в комментариях
            }
        ],
        "strict": [ // Запрет на неиспользование "use strict" - https://eslint.org/docs/rules/strict
            "error",
            'function'
        ],
        "array-bracket-spacing": [ // Запрет лишних пробелов при инициализации массивов - https://eslint.org/docs/rules/array-bracket-spacing
            "error",
            "never"
        ],
        "brace-style": [ // Запрет на перенос открывающей фигурной скобки на следующую строку - https://eslint.org/docs/rules/brace-style
            "error",
            "1tbs",
            {
                "allowSingleLine": false //Разрешить запись без фигурных скобок в одну строку
            }
        ],
        "comma-spacing": [ // Запрет на неиспользование пробела после запятой - https://eslint.org/docs/rules/comma-spacing
            "error",
            {
                "before": false, // Разрешить пробел перед запятой
                "after": true // Разрешить пробел после запятой
            }
        ],
        "computed-property-spacing": [  // Запрет на использование лишних пробелов при обращении к элементам массива или свойствам объектов - https://eslint.org/docs/rules/computed-property-spacing
            "error",
            "never"
        ],
        "func-call-spacing": [ // Запрет на пробелы перед скобками вызова функции - https://eslint.org/docs/rules/func-call-spacing
            "error",
            "never"
        ],
        "key-spacing": [ // Запрет на использование лишних пробелов в инициализации значений свойств объектов - https://eslint.org/docs/rules/key-spacing
            "error",
            {
                "beforeColon": false, //Разрешить пробел перед ":" при присваивании значения свойству объекта
                "mode": "minimum"
            }
        ],
        "no-multiple-empty-lines": "error", // Запрет более чем двух пустых строк - https://eslint.org/docs/rules/no-multiple-empty-lines
        "one-var": [ // Запрет перечисления идентификаторов переменных через запятую при их инициализации - https://eslint.org/docs/rules/one-var
            "error",
            "never"
        ],
        "operator-assignment": [ // Запрет на неиспользование сокращённых операторов присваивания в ситуациях где их можно использовать - https://eslint.org/docs/rules/operator-assignment
            "error",
            "always"
        ],
        "semi": "error" // Запрет на неиспользование ";" - https://eslint.org/docs/rules/semi
    }
};