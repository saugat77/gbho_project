module.exports = {
    purge: ["./resources/views/**/*.blade.php", "./resources/css/**/*.css"],
    theme: {
        container: {
            center: true,
            padding: {
                default: "0.75rem",
                sm: "2rem"
            }
        },
        borderWidth: {
            default: "1px",
            "0": "0",
            "2": "2px",
            "3": "3px",
            "4": "4px",
            "6": "6px",
            "8": "8px"
        },
        extend: {
            colors: {
                "blue-gray": "#f7fafc",
                // "theme-red": "#f57224",
                "theme-gray": "#f7f7f7",
                primary: "#10559a",
                secondary: "#ffba00",
                dark: "#444444",
                "navbar-color": "#142aa0",

                "main": {
                    "50": "#DFEDFC",
                    "100": "#C3DEF9",
                    "200": "#82BAF2",
                    "300": "#4699EC",
                    "400": "#1778D9",
                    "500": "#10559A",
                    "600": "#0D457D",
                    "700": "#0A335C",
                    "800": "#06213C",
                    "900": "#031220"
                },
                "sec": {
                    "50": "#FFF8E5",
                    "100": "#FFF1CC",
                    "200": "#FFE499",
                    "300": "#FFD666",
                    "400": "#FFC933",
                    "500": "#FFBA00",
                    "600": "#CC9600",
                    "700": "#997000",
                    "800": "#664B00",
                    "900": "#332500"
                }
            },
            spacing: {
                "72": "18rem",
                "80": "20rem",
                "96": "24rem"
            }
        }
    },
    variants: {},
    plugins: [
        require("@tailwindcss/custom-forms"),
        require("@tailwindcss/aspect-ratio")
    ]
};
