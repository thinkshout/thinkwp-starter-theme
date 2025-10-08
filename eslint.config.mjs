import prettier from "eslint-config-prettier";
import globals from "globals";

export default [
  {
    ignores: ["dist/", "includes/"],
  },
  {
    languageOptions: {
      ecmaVersion: 2021,
      sourceType: "module",
      globals: {
        ...globals.node,
        ...globals.browser,
      },
    },
    rules: {},
  },
  prettier,
];
