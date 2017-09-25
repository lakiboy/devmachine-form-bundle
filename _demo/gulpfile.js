var gulp   = require('gulp');
var files  = require('main-bower-files');
var rename = require('gulp-rename');
var rimraf = require('gulp-rimraf');

gulp.task('default', function (cb) {

    // Remove old JS files.
    rimraf('./web/lib', cb);

    gulp.src(files(), { base: './bower_components' })
        .pipe(rename(function (path) {
            if (path.dirname.indexOf('/dist') != -1) {
                path.dirname = path.dirname.replace('/dist', '/');
            }
            if (path.dirname.indexOf('/source') != -1) {
                path.dirname = path.dirname.replace('/source', '/');
            }
            if (path.dirname.indexOf('/src') != -1) {
                path.dirname = path.dirname.replace('/src', '/');
            }
        }))
        .pipe(gulp.dest('web/lib'))
    ;
});
