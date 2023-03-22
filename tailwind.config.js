const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");
const plugin = require("tailwindcss/plugin");

module.exports = {
    theme: {
        darkMode: "class",
        extend: {
            fontFamily: {
                sans: ["Inter var", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ["active"],
        },
    },
    content: [
        "./app/**/*.php",
        "./resources/**/*.html",
        "./resources/**/*.js",
        "./resources/**/*.jsx",
        "./resources/**/*.ts",
        "./resources/**/*.tsx",
        "./resources/**/*.php",
        "./resources/**/*.vue",
        "./resources/**/*.twig",
        "./vendor/wire-elements/modal/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./app/Http/Livewire/**/*Table.php",
        "./vendor/filament/**/*.blade.php",
    ],
    safelist: [
        {
            pattern: /max-w-(sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl)/,
            variants: ["sm", "md", "lg", "xl", "2xl"],
        },
        "text-blue-600",
        "text-indigo-600",
        "border-blue-600",
    ],
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("daisyui"),
        plugin(function ({ addComponents }) {
            addComponents({
                ".filament-tables-header-cell": {
                    backgroundColor: "#98BDF7 !important",
                    border: "1px solid !important",
                },
                ".filament-tables-header-cell > button": {
                    fontWeight: "bold !important",
                    color: "#101010ee !important",
                },
                ".filament-tables-row": {
                    borderBottom: "1px solid #66686a !important",
                },
                ".filament-tables-search-input input#tableSearchInput": {
                    border: "1px solid #66686a !important",
                },
            });
        }),
    ],
};
