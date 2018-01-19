var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var sass = require('gulp-sass');

gulp.task('default', ['sass'], function(done) {
  browserSync.init({
    server: {
      baseDir: "./"
    }
  });
  
  gulp.watch("./sass/main.scss", ["sass"]);

  done();
});


gulp.task("sass", function() {
  return gulp.src("./sass/main.scss")
    .pipe(sass())
    .pipe(gulp.dest("./assets/css"))
    .pipe(browserSync.stream());
});


