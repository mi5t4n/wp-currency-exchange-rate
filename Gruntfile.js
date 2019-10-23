'use strict';

module.exports = function(grunt) {
    /**
     * Configure grunt.
     */
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        options: {
            text_domain: 'wp-currency-exchange-rate'
        },
        copy: {
            dist: {
                src: 'README.txt',
                dest: 'README.md'
            }
        },
        makepot: {
            target: {
                options: {
                    mainFile: 'wp-currency-exchange-rate.php',
                    type: 'wp-plugin',
                    domainPath: 'languages',
                    exclude: [ 'deploy/.*', 'node_modules/.*', 'build/.*', 'vendor/.*'],
                    updateTimestamp: true,
                    potHeaders: {
                        poedit: true,
                        'report-msgid-bugs-to': '',
						'x-poedit-keywordslist': true,
						'language-team': '',
						'Language': 'en_US',
						'X-Poedit-SearchPath-0': '../../<%= pkg.name %>',
						'plural-forms': 'nplurals=2; plural=(n != 1);',
						'Last-Translator': 'WP Currency Exchanger Rate <mi5t4n@gmail.com>'
                    }
                }
            }
        },

        // Update textdomain.
        addtextdomain: {
            options: {
                textdomain: '<%= options.text_domain %>', // Project text domain
                updateDomains: true // Replace existing text domains.
            },
            target: {
                files: {
                    src: [
                        '*.php',
                        '**/*.php',
                        '!node_modules/**',
                        '!tests/**',
                        '!vendor/**',
                        '!deploy/**'
                    ]
                }
            }
        },

        // Check textdmain errors.
        checktextdomain: {
            options: {
                text_domain: '<%= options.text_domain %>',
                keywords: [
                    '__:1,2d',
					'_e:1,2d',
					'_x:1,2c,3d',
					'esc_html__:1,2d',
					'esc_html_e:1,2d',
					'esc_html_x:1,2c,3d',
					'esc_attr__:1,2d',
					'esc_attr_e:1,2d',
					'esc_attr_x:1,2c,3d',
					'_ex:1,2c,3d',
					'_n:1,2,4d',
					'_nx:1,2,4c,5d',
					'_n_noop:1,2,3d',
					'_nx_noop:1,2,3c,4d'
                ]
            },
            files: {
                src: [
                    '*.php',
                    '**/*.php',
                    '!node_modules/**',
                    '!tests/**',
                    '!vendor/**',
                    '!deploy/**'
                ],
                expand: true
            }
        }
    });

    // Load NPM tasks.
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-checktextdomain');
    grunt.loadNpmTasks('grunt-wp-i18n');

    grunt.registerTask('default', [
        'copy'
    ]);
}