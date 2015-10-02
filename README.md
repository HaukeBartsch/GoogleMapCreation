# GoogleMapCreation
Convert tiled pictures into GoogleMap API data structures

The goal of this project is to create a workflow for the conversion of tiled pyramidal file to a file structure that can be read by the Google Map API.

Build the container
===================

The GoogleMapCreation is executed inside a docker container. Here are the commands required to build and run the application: 

    docker build -t googlemapcreation .
    docker run -i -t googlemapcreation /bin/bash

