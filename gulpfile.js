const   gulp            = require('gulp'),
        sass            = require('gulp-sass'),
        uglify          = require('gulp-uglify-es').default,
        cssnano         = require('gulp-cssnano'),
        rename          = require('gulp-rename'),
        imagemin        = require('gulp-imagemin'),
        pngquant        = require('imagemin-pngquant'),
        autoprefixer    = require('gulp-autoprefixer');

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
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/js'));
});

gulp.task('js-libs-minify', function () {
    return gulp.src('assets/libs/*.js')
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/js'));
});

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
    gulp.watch('assets/', gulp.series('sass', 'js-minify'));
});
