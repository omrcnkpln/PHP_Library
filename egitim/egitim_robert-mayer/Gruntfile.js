// Gruntfile.js

// our wrapper function (required by grunt and its plugins)
// all configuration goes inside this function
const sass = require('node-sass');

module.exports = function(grunt) {

  // ===========================================================================
  // CONFIGURE GRUNT ===========================================================
  // ===========================================================================
  grunt.initConfig({

    // get the configuration info from package.json ----------------------------
    // this way we can use things like name and version (pkg.name)
    pkg: grunt.file.readJSON('package.json'),

    // all of our configuration will go here
    // configure jshint to validate js files -----------------------------------
    // jshint: {
    //   options: {
    //     reporter: require('jshint-stylish') // use jshint-stylish to make our errors look and read good
      // },

      // when this task is run, lint the Gruntfile and all js files in src
      // build: ['Gruntfile.js', 'src/**/*.js']
    // },


    // // configure uglify to minify js files -------------------------------------
    // uglify: {
    //   options: {
    //     banner: '/*\n <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> \n*/\n'
    //   },
    //   build: {
    //     files: {
    //       'dist/js/magic.min.js': 'src/js/magic.js'
    //     }
    //   }
    // },


    // // compile less stylesheets to css -----------------------------------------
    // less: {
    //   build: {
    //     files: {
    //       'dist/css/pretty.css': 'src/css/pretty.less'
    //     }
    //   }
    // },

    sass: {
        options: {
            implementation: sass,
            sourceMap: true
        },
        dist: {
            files: {
              'dist/css/style.css': 'src/css/style.scss',
              'dist/css/phpstyle.css': 'src/css/phpstyle.scss',
              'dist/css/user_page_style.css': 'src/css/user_page_style.scss',
              'dist/css/share.css': 'src/css/share.scss',
              'dist/css/giris.css': 'src/css/giris.scss',
              'dist/css/nedmin.css': 'src/css/nedmin.scss',
              'dist/css/contact.css': 'src/css/contact.scss',
              'dist/css/audio.css': 'src/css/audio.scss'
            }
        }
    },

    // // configure cssmin to minify css files ------------------------------------
    // cssmin: {
    //   options: {
    //     banner: '/*\n <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> \n*/\n'
    //   },
    //   build: {
    //     files: {
    //       'dist/css/style.min.css': 'src/css/style.css'
    //     }
    //   }
    // },

    // configure watch to auto update ----------------
    watch: {
      // for stylesheets, watch css and less files 
      // only run less and cssmin stylesheets: 
      stylesheets: {
        files: ['src/**/*.css', 'src/**/*.scss'], 
        tasks: ['sass'] ,    
      },
      
      // // for scripts, run jshint and uglify 
      // js: { 
      //   files: ['src/**/*.js'], 
      //   tasks: ['jshint', 'uglify'],
      // },

    },
    // browserSync: {
    //   dev: {
    //     bsFiles: {
    //     src : [
    //     'dist/css/*.css',
    //     'index.html'
    //     ]
    //   },
    //       options: {
    //       watchTask: true,
    //       // server: './E:\omer_files_2\Kodlar\html\Projelerim\Robert_Mayer'
    //       server: './'
    //     }
    //   }
    // }


  });


  // ===========================================================================
  // LOAD GRUNT PLUGINS ========================================================
  // ===========================================================================
  // we can only load these if they are in our package.json
  // make sure you have run npm install so our app can find these
  // grunt.registerTask('default', ['jshint', 'uglify', 'cssmin', 'less', 'sass']);
  grunt.registerTask('default', ['watch']);
  // grunt.loadNpmTasks('grunt-contrib-jshint');
  // grunt.loadNpmTasks('grunt-contrib-uglify');
  // grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-sass');
  // grunt.loadNpmTasks('grunt-contrib-cssmin');
  // grunt.loadNpmTasks('grunt-browser-sync');
  grunt.loadNpmTasks('grunt-contrib-watch');

};