tailwind.config = {
    corePlugins: {
      textDecoration: false
    },
    theme: {
      extend: {
          keyframes: {
            "menu-slide-in": {
              "0%": { transform: "translateX(0)" }, 
              "100%": { transform: "translateX(-100vw)" } 
            },
            "menu-slide-out": {
              "0%": { transform: "translateX(-100vw)" }, 
              "100%": { transform: "translateX(0)" } 
            },
            "top-line-active": {
              "0%": { transform: "rotate(0) "},
              "100%": { transform: "rotate(35deg) "}
            },
            "bottom-line-active": {
              "0%": { transform: "rotate(0) "},
              "100%": { transform: "rotate(-35deg) "}
            }
          },
          animation: {
            "menu-slide-in": "menu-slide-in .2s linear forwards",
            "menu-slide-out": "menu-slide-out .2s linear forwards",
            "top-line-active": "top-line-active .2s linear forwards",
            "bottom-line-active": "bottom-line-active .2s linear forwards",
          },
          screens: {
              sm: '480px',
              md: '768px',
              lg: '976px',
              xl: '1440px',
          },
          backgroundImage: {
            "banner": "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 800 400'%3E%3Cdefs%3E%3CradialGradient id='a' cx='396' cy='281' r='514' gradientUnits='userSpaceOnUse'%3E%3Cstop offset='0' stop-color='%23DD1463'/%3E%3Cstop offset='1' stop-color='%23E52421'/%3E%3C/radialGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='400' y1='148' x2='400' y2='333'%3E%3Cstop offset='0' stop-color='%23FF9D3A' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23FF9D3A' stop-opacity='0.5'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect fill='url(%23a)' width='800' height='400'/%3E%3Cg fill-opacity='0.4'%3E%3Ccircle fill='url(%23b)' cx='267.5' cy='61' r='300'/%3E%3Ccircle fill='url(%23b)' cx='532.5' cy='61' r='300'/%3E%3Ccircle fill='url(%23b)' cx='400' cy='30' r='300'/%3E%3C/g%3E%3C/svg%3E\")"
          },
          colors: {
            "ft-red": "#e52421",
          },
          spacing: {
            "container": "90%",
            "sm-container": "95%",
            "header": "3.5rem",
            "sm-nav-links": ".3rem",
            "md-nav-links": ".4rem",
            "lg-nav-links": ".5rem",
            "burger-line-w": "1.3rem",
            "burger-line-h": "2px",
          },
          translate: {
            "minus-50%": "-50%",
          },
          fontFamily: {
            "montserrat": ["Montserrat", "sans-serif"],
          }
      }
    }
  }