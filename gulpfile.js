const   gulp            = require('gulp'),
        sass            = require('gulp-sass'),
        concat          = require('gulp-concat'),
        uglify          = require('gulp-uglifyjs'),
        cssnano         = require('gulp-cssnano'),
        rename          = require('gulp-rename'),
        imagemin        = require('gulp-imagemin'),
        pngquant        = require('imagemin-pngquant'),
        autoprefixer    = require('gulp-autoprefixer');
        //browserSync = require('browser-sync');

gulp.task('sass', function () {
    return gulp.src('assets/sass/*.sass')
        .pipe(sass())
        .pipe(autoprefixer({overrideBrowserslist: ['last 20 versions', '> 1%', 'ie 8', 'ie 7'], cascade: false }))
        .pipe(cssnano())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/css'))
});

gulp.task('js-minify', function () {
    return gulp.src('assets/js/*.js')
        .pipe(uglify())
        .pipe(gulp.dest('public/js'));
});

gulp.task('js-libs-minify', function () {
    return gulp.src('assets/libs/*.js')
        .pipe(uglify())
        .pipe(gulp.dest('public/js'));
});

/*.pipe(concat('libs.min.js'))
.pipe(rename({suffix: '.min'}))*/

gulp.task('img', function () {
    return gulp.src('assets/img/**/*')
        .pipe(imagemin({
            interlaced: true,
            progressive: true,
            svgPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('public/img'));
});

gulp.task('build', gulp.series('sass', 'js-minify', 'js-libs-minify', 'img'));

gulp.task('watch', function () {
    gulp.watch('assets/sass/*.sass', gulp.series('sass'));
});
