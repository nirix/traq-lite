var gulp       = require('gulp')
    watch      = require('gulp-watch'),
    sass       = require('gulp-sass'),
    coffee     = require('gulp-coffee'),
    concat     = require('gulp-concat'),
    sourcemaps = require('gulp-sourcemaps')
    path       = require('path');

var beSassy = function() {
    console.log('Being Sassy');

    gulp.src(['./scss/traq.scss'])
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('../assets/css'));
}

var makeCoffee = function() {
    gulp.src('./coffee/*.coffee')
        .pipe(coffee())
        .pipe(gulp.dest('../assets/js'));
}

gulp.task('compile', function(){
    gulp.src(['./scss/traq.scss'])
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('../assets/css'));

    makeCoffee();
});

// Watch for changes
gulp.task('watch', function(){
    watch('scss/*.scss', beSassy);
    watch('scss/*/*.scss', beSassy);
    watch('draper/scss/*.scss', beSassy);
    watch('draper/scss/*/*.scss', beSassy);

    //watch('./coffee/*.coffee', makeCoffee);
});

// Compile Sass
gulp.task('sass', beSassy);

// Compile CoffeeScript
gulp.task('coffee', makeCoffee);
