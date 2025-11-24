const gulp = require('gulp');
const zip = require('gulp-zip');
 
gulp.task('ziper', function() {
    return gulp.src(['./**', '!./*node_modules/**', '!./*{webpack.config.js,gulpfile.js,package-lock.json,package.json,product-enquiry-for-woocommerce.zip,.gitignore,qaconfig}'])
        .pipe(zip('product-enquiry-for-woocommerce.zip'))
        .pipe(gulp.dest('./'));
});