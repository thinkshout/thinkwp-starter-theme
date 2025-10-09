const {
    defineConfig,
    globalIgnores,
} = require("eslint/config");

const globals = require("globals");
const js = require("@eslint/js");

const {
    FlatCompat,
} = require("@eslint/eslintrc");

const compat = new FlatCompat({
    baseDirectory: __dirname,
    recommendedConfig: js.configs.recommended,
    allConfig: js.configs.all
});

module.exports = defineConfig([{
    extends: compat.extends("prettier"),

    languageOptions: {
        globals: {
            ...globals.node,
            ...globals.browser,
        },

        sourceType: "module",
        parserOptions: {},
    },

    rules: {},
}, globalIgnores(["**/dist/", "**/includes/"])]);
