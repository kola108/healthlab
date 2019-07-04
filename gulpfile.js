const   gulp = require('gulp'),
        sass = require('gulp-sass');

gulp.task('sass', function () {
    return gulp.src('assets/sass/*.sass')
        .pipe(sass())
        .pipe(gulp.dest('assets/css'))
});

gulp.task('watch', function () {
    gulp.watch('assets/sass/*.sass', gulp.series('sass'));
});

