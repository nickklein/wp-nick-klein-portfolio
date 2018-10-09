var gulp = require('gulp');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var eslint = require('gulp-eslint');
var browserify = require('browserify');
var babelify = require('babelify');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var argv = require('yargs').argv;
var browserSync = require('browser-sync').create();


// Variables
var build = (argv.build === undefined) ? false : true;
var theme_folder = 'nickklein';
var destination = (build) ? 'wp-content/themes/' + theme_folder : 'src'

/* 
============
Dev
============
*/



gulp.task('sass', function() {
	// Note: The order is important, it's the order for concat
	var folders = [
				'src/scss/app.scss'
	];
	gulp.src(folders)
		.pipe(concat('app.css'))
		.pipe(sass())
		.pipe(gulp.dest(destination + '/css'))
		.pipe(browserSync.reload({
			stream: true
		}));
});


// Lint JS
gulp.task('linter', function(){
  return gulp.src('src/js/**/*.js')
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
});


// Bundle all files 
gulp.task('js', function() {
	browserify(['src/js/init.js'])
		.transform(babelify)
		.bundle()
		.pipe(source('app.js'))
		.pipe(gulp.dest(destination + '/js'));		
});


gulp.task('browserSync', function() {
	browserSync.init({
		server: {
			baseDir: 'src'
		}
	});
});

gulp.task('watch', ['linter', 'browserSync', 'sass', 'js'], function() {
	gulp.watch('src/scss/**/*.scss', ['sass']);
	gulp.watch('src/js/**/*.js', ['linter','js']);
});



/* 
============
Production 
============
*/

// Compress CSS
gulp.task('minifyCSS', function() {
	return gulp.src('src/scss/**/*.scss')
		.pipe(concat('app.css'))
		.pipe(sass({outputStyle: 'compressed'}))
		.pipe(gulp.dest(destination + '/css'))
});

gulp.task('minifyJS', function() {
		// Note: The order is important, it's the order for concat
		browserify('src/js/init.js')
			.transform(babelify)
			.bundle()
			.pipe(source('src.js'))
			.pipe(buffer())
			.pipe(uglify())
			.pipe(gulp.dest(destination + '/js'));

});

gulp.task('production', ['minifyCSS', 'minifyJS']);