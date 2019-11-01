module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        "bower-install-simple": {
            options: {
                color: true,
                directory: "public/components"
            },
            prod: {
                options: {
                    production: true
                }
            },
            dev: {
                options: {
                    production: false
                }
            }
        },
        exec: {
            composer_install: {
                cmd: 'composer install',
                exitCode: [ 0, 255 ]
            },
            server : {
                command : "php -S 0.0.0.0:8043",
                cwd : "public"
            },
        }
    });
    grunt.loadNpmTasks("grunt-bower-install-simple");
    grunt.loadNpmTasks('grunt-exec');
    grunt.task.registerTask('development',['bower-install-simple','exec']);
}
