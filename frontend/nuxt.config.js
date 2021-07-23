// const webpack = require("webpack");
export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'project',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      // { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      // { rel: 'stylesheet', href: '/source/adminassets/assets/css/icons/icomoon/styles.css' },
      // { rel: 'stylesheet', href: '/source/adminassets/assets/css/icons/styles.min.css' },
      // { rel: 'stylesheet', href: '/source/adminassets/assets/css/core.css' },
      // { rel: 'stylesheet', href: '/source/adminassets/assets/css/components.css' },
      // { rel: 'stylesheet', href: '/source/adminassets/assets/css/colors.css' },
      // { rel: 'stylesheet', href: '/source/adminassets/assets/css/custom.css' },
      // { rel: 'stylesheet', href: '/source/adminassets/assets/js/calendar/main.css' },
      // { rel: 'stylesheet', href: 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css'},
      // { rel: 'stylesheet', href: '/main.css' }
      //calendar
      { rel: 'stylesheet', href: '/vendors/bootstrap/dist/css/bootstrap.min.css'},
      { rel: 'stylesheet', href: '/vendors/font-awesome/css/font-awesome.min.css'},
      { rel: 'stylesheet', href: '/vendors/nprogress/nprogress.css'},
      { rel: 'stylesheet', href: '/build/css/custom.min.css'},
      { rel: 'stylesheet', href: '/vendors/google-code-prettify/bin/prettify.min.css'},
      { rel: 'stylesheet', href: '/vendors/animate.css/animate.min.css'},
      { rel: 'stylesheet', href: '/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css'},
      { rel: 'stylesheet', href: '/vendors/iCheck/skins/flat/green.css'},
      { rel: 'stylesheet', href: '/vendors/bootstrap-daterangepicker/daterangepicker.css'},
      // { rel: 'stylesheet', href: '/vendors/fullcalendar/dist/fullcalendar.css'},
      // { rel: 'stylesheet', href: '/vendors/fullcalendar/dist/fullcalendar.min.css'},
      // { rel: 'stylesheet', href: '/vendors/fullcalendar/dist/fullcalendar.print.css'},
      { rel: 'stylesheet', href: '/dashboard.css'},

    ],
    script: [

      { src: '/vendors/jquery/dist/jquery.min.js'},
      { src: '/vendors/bootstrap/dist/js/bootstrap.bundle.min.js'},
      { src: '/vendors/fastclick/lib/fastclick.js'},
      { src: '/vendors/nprogress/nprogress.js'},
      { src: '/vendors/moment/min/moment.min.js'},
      // { src: '/vendors/fullcalendar/dist/fullcalendar.min.js'},
      // { src: '/vendors/fullcalendar/dist/fullcalendar.js'},
      { src: '/build/js/custom.min.js'},
      { src: '/dashboard.js'},
      { src: '/vendors/Chart.js/dist/Chart.min.js'},
      { src: '/vendors/gauge.js/dist/gauge.min.js'},
      { src: '/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js'},
      { src: '/vendors/iCheck/icheck.min.js'},
      { src: '/vendors/skycons/skycons.js'},
      { src: '/vendors/DateJS/build/date.js'},
      { src: '/vendors/jqvmap/dist/jquery.vmap.js'},
      { src: '/main.js'},

    ],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    //  '~/node_modules/bootstrap/dist/css/bootstrap.css',
    // '@/assets/css/font-awesome.css',
    // '@/assets/css/font.css',
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~/plugins/vee-validate.js',
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: {
    // true,
    dirs: [
      '~/components'
    ]
  },
  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/bootstrap
    'bootstrap-vue/nuxt',
    '@nuxtjs/axios',
    '@nuxtjs/auth'
  ],

    axios: {
      baseURL: process.env.BASE_API_URL
  },
  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    transpile: ['vee-validate/dist/rules']
  },

  // axios: {
  //   baseURL: 'http://localhost:81/api'
  // },

  auth: {
    strategies: {
      local: {
        endpoints: {
          login: { url: 'login', method: 'post', propertyName: 'data.token' },
          user: { url: 'me', method: 'get', propertyName: 'data' },
          logout: false
        }
      }
    }
  }
}
