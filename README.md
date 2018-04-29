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

## To release

A release is made when code is commited to `prod` branch. Once all code set to release is in the `master` branch, make a pull request to `prod` with the title being the version of the release and 'squash and merge'. You may need to pull from `prod` into `master` to get a smooth merge.

Once merged, a deployment will begin via a githook made to the server. You may need to purge Cloudflare to see changes.

## To rollback
Simply revert the commit in `prod` and it will automatically redeploy.
