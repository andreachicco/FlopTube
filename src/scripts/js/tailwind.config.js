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
          }
      }
    }
  }