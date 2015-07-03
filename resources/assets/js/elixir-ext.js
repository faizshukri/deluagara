var gulp = require("gulp");
var download = require("gulp-download");
var elixir = require("laravel-elixir");

elixir.extend("download", function(url, destination) {

    gulp.task("download", function() {
        return download(url).pipe(gulp.dest(destination));
    });

    return this.queueTask("download");
});