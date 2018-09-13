/*
 After you have changed the settings at "Your code goes here",
 run this with one of these options:
  "grunt" alone creates a new, completed images directory
  "grunt clean" removes the images directory
  "grunt responsive_images" re-processes images without removing the old ones
*/

module.exports = function(grunt) {
  require("phplint").gruntPlugin(grunt);
 
  grunt.initConfig({
    phplint: {
      options: {
        limit: 10,
        phpCmd: "/home/scripts/php", // Defaults to php
        stdout: true,
        stderr: true,
        useCache: true, // Defaults to false
        tmpDir: "/custom/root/folder", // Defaults to os.tmpDir()
        cacheDirName: "custom/subfolder" // Defaults to php-lint
      },
      files: "src/**/*.php"
    }
  });
 
  grunt.registerTask("test", ["phplint"]);
};