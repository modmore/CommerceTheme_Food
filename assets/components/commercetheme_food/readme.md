Hello!

If you found this readme, you're probably looking at how to recompile the theme styling.

## Compiling styles

- Make sure node/npm are installed on your system first.
- Install the dependencies in this directory: `npm install`
- To compile styles, edit `scss/main.scss` and run `npx gulp style`
- To look for changes and automatically compile, run `npx gulp watch`

## About /dist/ and custom styling

The /dist/ directory (plus the package.json, gulpfile, etc) **will be overwritten on upgrade**. To allow you to compile custom styling, the files in /dist/ are copied when installing the package, if you check the "write assets" checkbox.

This means that you should **NOT** edit:

- `dist/scss/main.scss` - instead edit `scss/main.scss`
- `dist/css/main.css` - instead edit `scss/main.scss` and compile using the workflow described above.

When upgrading the package, and the scss/main.scss or css/main.css files exist, you can choose to overwrite them with the default. If you do that, the pre-existing files (which you may have duplicated) will be copied in the same directory with a backup suffix for safe-keeping.

