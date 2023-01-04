const sass = require('node-sass');

module.exports = function (grunt) {
  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        implementation: sass,
        sourceMap: true
      },
      dest: {
        files: {
          'dist/css/phpstyle.css': 'src/css/phpstyle.scss',
          'dist/css/user_page_style.css': 'src/css/user_page_style.scss',
          'dist/css/share.css': 'src/css/share.scss',
          'dist/css/giris.css': 'src/css/giris.scss',
          'dist/css/nedmin.css': 'src/css/nedmin.scss',
          'dist/css/contact.css': 'src/css/contact.scss'
        }
      }
    },

    autoprefixer: {
      options: {
        browsers: ['opera 12', 'ff 15', 'chrome 25']
      },

      dist: {
        files: {
          'dist/css/phpstyle.css': 'dist/css/phpstyle.css'
        }
      }
    },

    watch: {
      stylesheets: {
        files: ['src/**/*.css', 'src/**/*.scss'],
        tasks: ['sass', 'autoprefixer']
      }
    }

  });
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.registerTask('default', ['watch']);
};