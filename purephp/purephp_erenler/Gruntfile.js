const { package } = require('grunt');
const sass = require('node-sass');

module.exports = function (grunt) {

  grunt.initConfig({
    sass: {
      options: {
        implementation: sass,
        sourceMap: true
      },
      dest: {
        files: {
          'src/css/main.css': 'src/scss/main.scss'
        }
      }
    },

    autoprefixer: {
      options: {
        browsers: ['opera 12', 'ff 15', 'chrome 25']
      },

      dist: {
        files: {
          'src/css/prefix/main.css': 'src/css/main.css'
        }
      }
    },

    cssmin: {
      build: {
        files: {
          'public/css/main.min.css': 'src/css/prefix/*.css'
        }
      }
    },

    // eslint: {
    //   options: {
    //     configFile: '.eslintrc.json',
    //     fix: true
    //   },
    //   target: [
    //     'src/js/akademi-slider-2.js'
    //   ]
    // },

    browserSync: {
      dev: {
        bsFiles: {
          src: [
            'public/css/*min.css',
            '*.html',
            '*.php',
            'include/*.php',
            'adminpanel/include/*.php'
          ]
        },
        options: {
          watchTask: true,
          proxy: "http://localhost/phpprojects/erenler/"
        }
      }
    },

    watch: {
      stylesheets: {
        files: ['src/scss/*.scss'],
        tasks: ['sass', 'newer:autoprefixer', 'cssmin']
      }
    }
  })

  // LOAD GRUNT PLUGINS ========================================================
  // grunt.loadNpmTasks('grunt-eslint');
  grunt.loadNpmTasks('grunt-newer');
  grunt.loadNpmTasks('grunt-browser-sync');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask('default', ['browserSync', 'watch']);
}