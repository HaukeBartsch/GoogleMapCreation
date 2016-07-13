# Dockerfile
# run this with
#    docker build -t googlemapcreation .

FROM  ubuntu

MAINTAINER Hauke Bartsch <HaukeBartsch@gmail.com>
LABEL version=0.1
LABEL description="create a docker container with software required to run the conversion and checkout the git repository inside"

ENV HOME /root 
WORKDIR ${HOME}

RUN apt-get update && apt-get install -y git imagemagick wget tcl8.4 && git clone https://github.com/HaukeBartsch/GoogleMapCreation.git && ln -s /usr/bin/tclsh8.4 /usr/bin/tclsh
