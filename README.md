# North Star

The project is built in wordpress and uses docker to serve the project.

Run `npm i` to install node dependencies.

## To run Wordpress

```
docker-compose up
```

## To edit theme files

`themes/north-star` is the theme and is mounted inside of the docker container. Here is where you should edit the theme files

## To edit the CSS

The CSS is written in SASS. All SASS files are in the `sass/` folder and are compiled into the theme.

In a seperate terminal window, run...

```
npm start
```

The project will be served at [http://localhost:8000/](http://localhost:8000/)
