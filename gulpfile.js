const   gulp    = require('gulp'),
        sass    = require('gulp-sass'),
        concat  = require('gulp-concat'),
        uglify  = require('gulp-uglifyjs'),
        cssnano = require('gulp-cssnano'),
        rename  = require('gulp-rename');
        //browserSync = require('browser-sync');

gulp.task('sass', function () {
    return gulp.src('assets/sass/*.sass')
        .pipe(sass())
        .pipe(cssnano())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/css'))
});

gulp.task('watch', function () {
    gulp.watch('assets/sass/*.sass', gulp.series('sass'));
});

gulp.task('js-minify', function () {
    return gulp.src('assets/libs/jquery/dist/jquery.js')
        .pipe(concat('libs.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/js'));
});

gulp.task('build', gulp.series('sass', 'js-minify'));
