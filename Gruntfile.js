module.exports = function(grunt) {
	
	grunt.initConfig({
		phpunit: {
			classes: {
				dir: 'src/test'
			},
			options: {
				bin: 'vendor/bin/phpunit',
				configuration: 'phpunit.xml'
			}
		},
		watch: {
			phpunit: {
				files: ['src/**/*'],
				tasks: ['phpunit']
			}
		}
	});
	
	grunt.loadNpmTasks('grunt-phpunit');
	grunt.loadNpmTasks('grunt-contrib-watch');
	
};