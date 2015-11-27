
'use strict';
var gulp = require('gulp');
var sass = require('gulp-sass');
var notify = require('gulp-notify');
var fs = require('fs');
var path = require('path');
var rimraf = require('rimraf');

var paths = {
    devFolder: 'src/styles/',
    distFolder: 'src/styles/',

    init: function() {
        this.src = {
            sass: path.join(this.devFolder, 'scss'),
        };

        this.dist = {
            css: path.join(this.distFolder, 'css'),
        };

        return this;
    }
}.init();


gulp.task('clean:styles', function (cb) {
    rimraf(paths.dist.css, cb);
});

gulp.task('dist:styles', ['clean:styles'], function () {
    return gulp.src([
            path.join(paths.src.sass, '**/*')
        ])
        .pipe(sass({
            outputStyle: 'nested', // nested[default], expanded, compact, compressed
        }).on('error', sass.logError))
        .pipe(gulp.dest(paths.dist.css))
        .pipe(notify({message: 'dist:styles task completed', onLast: true}));
});

gulp.task('default', ['dist:styles']);
